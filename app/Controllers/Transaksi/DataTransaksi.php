<?php

namespace App\Controllers\Transaksi;
    
use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\Transaksi\TransaksiModel;
use App\Models\Referensi\Anggota\AnggotaModel;
use App\Models\Referensi\Buku\BukuModel;

class DataTransaksi extends BaseController
{
    function __construct()
    {
        $this->transaksi = new TransaksiModel();
        $this->buku = new BukuModel();
        $this->anggota = new AnggotaModel();
    }

    public function index()
    {
        
        $this->data['titlehead'] = "Data Transaksi";
        return view('transaksi/v_transaksi_list', $this->data);
    }

    public function lists()
    {
        $start          = $this->request->getPost('start');
        $limit          = $this->request->getPost('length');
        $filters        = $this->request->getPost('filter');
        $order          = $this->request->getPost('sort');

        $results                      = $this->transaksi->getData(null, $start, $limit, $order, $filters);
        $totalfiltered                = $this->transaksi->getDataCnt($filters);
        $totaldata                    = $this->transaksi->getDataCnt();
        $maxpage                      = ceil($totalfiltered / $limit);

        $build_array    = array(
            "last_page"                   => $maxpage,
            "recordsTotal"                => $totaldata,
            "recordsFiltered"             => $totalfiltered,
            "data" => array(),

        );

        foreach ($results as $row) {

            $transaksi_id = encrypt($row->transaksi_id);
            $string = "'$transaksi_id'";
            $html = '<div class="table-data-feature">
                        <a type="button" href="/transaksi/edit/'. $transaksi_id . '">
                            <span class="badge badge-pill gradient-3">
                                <i class="icon-pencil text-white"></i>
                            </span>
                        </a>
                        <a onclick="hapus('. $string. ');">
                            <span class="badge badge-pill gradient-2">
                                <i class="icon-trash text-white"></i>
                            </span>
                        </a>
            
                        </div>';
            
            if($row->status){
                $status = '<a onclick="updateStatus('. $string. ', 0);" ><span class="badge badge-pill gradient-1">Sudah Di Kembalikan</span></a>';
            }else{
                $status = '<a onclick="updateStatus('. $string. ', 1);" ><span class="badge badge-pill gradient-2">Belum Di Kembalikan</span></a>';
            }
            
            array_push($build_array["data"],
                array(
                    "aksi" => $html,
                    "isbn" => $row->isbn,
                    "judul" => $row->judul,
                    "penulis" => $row->penulis,
                    "nama_lengkap" => $row->nama_lengkap,
                    "no_hp_wa" => $row->no_hp_wa,
                    "alamat" => $row->alamat,
                    "tgl_peminjaman" => date('Y-m-d', strtotime($row->tgl_peminjaman)),
                    "tgl_pengembalian" => date('Y-m-d', strtotime($row->tgl_pengembalian)) ,
                    "status" => $status,
                )
            );
        }
        
        return $this->response->setJSON($build_array);
    }

    public function form()
    {
        $id = 0;
        $this->data['transaksi_id'] = current_url(true)->getSegment(4);
        if (trim($this->data['transaksi_id']) != ""){
            $id = decrypt($this->data['transaksi_id']);
            $this->data['titlehead'] = "Edit Transaksi";
        }else{
            $this->data['titlehead'] = "Input Transaksi";
        }

        $this->data['list_buku']      = $this->buku->getBuku();
        $this->data['list_anggota']   = $this->anggota->getAnggota();

        //validate form input
        $this->validation->setRules([
            'judul'             => ['label' => 'Judul', 'rules' => 'required|trim'],
            'nama_lengkap'      => ['label' => 'Nama Lengkap', 'rules' => 'required|trim'],
            'tgl_peminjaman'    => ['label' => 'Tanggal Peminjaman', 'rules' => 'required|trim'],
            'tgl_pengembalian'  => ['label' => 'Tanggal Pengembalian', 'rules' => 'required|trim'],
        ]);

        if( $id > 0 AND !$this->request->getPost('transaksi_id')) {
            // retrieve data for edit
            $transaksi = $this->transaksi->getTransaksi($id); 
            $this->data['transaksi']  = $transaksi;    
            $this->data['buku_id']    = $transaksi->buku_id;
            $this->data['anggota_id'] = $transaksi->anggota_id;
        }else{
            $transaksi = new \stdClass();            
            $transaksi->buku_id           = '';
            $transaksi->anggota_id        = '';                                   
            $transaksi->tgl_peminjaman    = date('Y-m-d');                                   
            $transaksi->tgl_pengembalian  = date('Y-m-d');                                   
            
            $this->data['transaksi']  = $transaksi;   
            $this->data['buku_id']    = $transaksi->buku_id;
            $this->data['anggota_id'] = $transaksi->anggota_id;
        }

        if (isset($_POST) && !empty($_POST))
        {
            $judul               = $this->request->getPost('judul');
            $nama_lengkap        = $this->request->getPost('nama_lengkap');
            $tgl_peminjaman      = $this->request->getPost('tgl_peminjaman');
            $tgl_pengembalian    = $this->request->getPost('tgl_pengembalian');

            $data = array (
                'buku_id'           => $judul,
                'anggota_id'        => $nama_lengkap,               
                'tgl_peminjaman'    => $tgl_peminjaman,               
                'tgl_pengembalian'  => $tgl_pengembalian,               
            );

             //check to see if we are updating
            if( $id > 0 AND !$this->request->getPost('transaksi_id') ) { // update
                $data['updated_by'] = 1;
                $data['updated_date'] = date('Y-m-d H:i:s');
                if ($this->validation->withRequest($this->request)->run() === TRUE )
                {       
                    $this->transaksi->update($id, $data);
                    $this->session->setFlashdata('message', "Update data transaksi berhasil.." );
                    return redirect()->to(base_url('transaksi'));
                }else{
                    //set the flash data error message if there is one
                    $this->data['errmsg'] = $this->validation->listErrors();
                    $this->data['message'] = $this->session->getFlashdata('message');
                    $this->session->setFlashdata('err', $this->data['errmsg']); 
                    
                }
            }else { // insert
                $data['status'] = 0;
                $data['created_by'] = 1;
                $data['created_date'] = date('Y-m-d H:i:s');

                if ($this->validation->withRequest($this->request)->run() === TRUE  )
                    {
                        $this->transaksi->insert($data);
                        $this->session->setFlashdata('message', "Tambah data transaksi berhasil..");
                        return redirect()->to(base_url('transaksi'));
                    }else{
                        //set the flash data error message if there is one
                        $this->data['errmsg'] = $this->validation->listErrors();
                        $this->data['message'] = $this->session->getFlashdata('message');
                        $this->session->setFlashdata('err', $this->data['errmsg']);     
                        // return redirect()->to("/data_buku");  

                    } 
                }
        }

        // $this->data['csrf'] = $this->_get_sess_csrf();
        return view('transaksi/form_transaksi', $this->data);
    }

    public function delete()
    {
        $id = decrypt(current_url(true)->getSegment(4));

        $transaksi = $this->transaksi->getTransaksi($id); 
        $this->transaksi->delete($id);    
    }

    public function upateStatus()
    {
        
        $id = decrypt(current_url(true)->getSegment(4));
        $status = current_url(true)->getSegment(5);

        $data = array (
            'status'    => $status,               
        );

        $this->transaksi->update($id, $data);
    }

}