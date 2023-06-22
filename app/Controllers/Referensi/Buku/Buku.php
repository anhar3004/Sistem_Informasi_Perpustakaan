<?php

namespace App\Controllers\Referensi\Buku;
    
use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\Referensi\Buku\BukuModel;

class Buku extends BaseController
{
    function __construct()
    {
        $this->buku = new BukuModel();
    }

    public function index()
    {
        $this->data['titlehead'] = "Data Buku";
        return view('referensi/buku/v_buku_list', $this->data);
    }

    public function lists()
    {
        $start          = $this->request->getPost('start');
        $limit          = $this->request->getPost('length');
        $filters        = $this->request->getPost('filter');
        $order          = $this->request->getPost('sort');

        $results                      = $this->buku->getData(null, $start, $limit, $order, $filters);
        $totalfiltered                = $this->buku->getDataCnt($filters);
        $totaldata                    = $this->buku->getDataCnt();
        $maxpage                      = ceil($totalfiltered / $limit);

        $build_array    = array(
            "last_page"                   => $maxpage,
            "recordsTotal"                => $totaldata,
            "recordsFiltered"             => $totalfiltered,
            "data" => array(),

        );

        foreach ($results as $row) {

            $buku_id = encrypt($row->buku_id);
            $string = "'$buku_id'";
            $html = '<div class="table-data-feature">
                        <a type="button" href="/data_buku/edit/'. $buku_id . '">
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

            array_push($build_array["data"],
                array(
                    "aksi" => $html,
                    "isbn" => $row->isbn,
                    "judul" => $row->judul,
                    "penulis" => $row->penulis,
                    "penerbit" => $row->penerbit,
                    "tahun_terbit" => $row->tahun_terbit,
                    "jumlah_halaman" => $row->jumlah_halaman,
                )
            );
        }
        
        return $this->response->setJSON($build_array);
    }

    public function form()
    {
        $id = 0;
        $this->data['buku_id'] = current_url(true)->getSegment(4);
        if (trim($this->data['buku_id']) != ""){
            $id = decrypt($this->data['buku_id']);
            $this->data['titlehead'] = "Edit Data Buku";
        }else{
            $this->data['titlehead'] = "Input Data Buku";
        }

        //validate form input
        $this->validation->setRules([
            'isbn'              => ['label' => 'ISBN', 'rules' => 'required|trim'],
            'judul'             => ['label' => 'Judul', 'rules' => 'required|trim'],
            'penulis'           => ['label' => 'Penulis', 'rules' => 'required|trim'],
            'penerbit'          => ['label' => 'Penerbit', 'rules' => 'required|trim'],
            'tahun_terbit'      => ['label' => 'Tahun Terbit', 'rules' => 'required|trim|numeric'],
            'jumlah_halaman'    => ['label' => 'Jumlah Halaman', 'rules' => 'required|trim|numeric'],
        ]);

        if( $id > 0 AND !$this->request->getPost('buku_id')) {
            // retrieve data for edit
            $buku = $this->buku->getBuku($id); 
            $this->data['buku'] = $buku;     
        }else{
            $buku = new \stdClass();            
            $buku->isbn           = '';
            $buku->judul          = '';                                   
            $buku->penulis        = '';                                   
            $buku->penerbit       = '';                                   
            $buku->tahun_terbit   = '';                                   
            $buku->jumlah_halaman = '';  
            
            $this->data['buku'] = $buku;   
        }

        if (isset($_POST) && !empty($_POST))
        {
            $isbn               = $this->request->getPost('isbn');
            $judul              = $this->request->getPost('judul');
            $penulis            = $this->request->getPost('penulis');
            $penerbit           = $this->request->getPost('penerbit');
            $tahun_terbit       = $this->request->getPost('tahun_terbit');
            $jumlah_halaman     = $this->request->getPost('jumlah_halaman');

            $data = array (
                'isbn'             => $isbn,
                'judul'            => $judul,               
                'penulis'          => $penulis,               
                'penerbit'         => $penerbit,               
                'tahun_terbit'     => $tahun_terbit,               
                'jumlah_halaman'   => $jumlah_halaman,               
            );

             //check to see if we are updating
            if( $id > 0 AND !$this->request->getPost('buku_id') ) { // update
                $data['updated_by'] = 1;
                $data['updated_date'] = date('Y-m-d H:i:s');
                if ($this->validation->withRequest($this->request)->run() === TRUE )
                {       
                    $this->buku->update($id, $data);
                    $this->session->setFlashdata('message', "Update data buku berhasil.." );
                    return redirect()->to(base_url('data_buku'));
                }else{
                    //set the flash data error message if there is one
                    $this->data['errmsg'] = $this->validation->listErrors();
                    $this->data['message'] = $this->session->getFlashdata('message');
                    $this->session->setFlashdata('err', $this->data['errmsg']); 
                    
                }
            }else { // insert
                $data['created_by'] = 1;
                $data['created_date'] = date('Y-m-d H:i:s');

                if ($this->validation->withRequest($this->request)->run() === TRUE  )
                    {

                        $this->buku->insert($data);
                        $this->session->setFlashdata('message', "Tambah data buku berhasil..");
                        return redirect()->to(base_url('data_buku'));
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
        return view('referensi/buku/form_buku', $this->data);
    }

    public function delete()
    {
        $id = decrypt(current_url(true)->getSegment(4));

        $buku = $this->buku->getBuku($id); 
        $this->buku->delete($id);    
    }

}