<?php

namespace App\Controllers\Referensi\Anggota;
    
use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\Referensi\Anggota\AnggotaModel;

class Anggota extends BaseController
{
    function __construct()
    {
        $this->anggota = new AnggotaModel();
    }

    public function index()
    {
        $this->data['titlehead'] = "Data Anggota";
        return view('referensi/anggota/v_anggota_list', $this->data);
    }

    public function lists()
    {
        $start          = $this->request->getPost('start');
        $limit          = $this->request->getPost('length');
        $filters        = $this->request->getPost('filter');
        $order          = $this->request->getPost('sort');

        $results                      = $this->anggota->getData(null, $start, $limit, $order, $filters);
        $totalfiltered                = $this->anggota->getDataCnt($filters);
        $totaldata                    = $this->anggota->getDataCnt();
        $maxpage                      = ceil($totalfiltered / $limit);

        $build_array    = array(
            "last_page"                   => $maxpage,
            "recordsTotal"                => $totaldata,
            "recordsFiltered"             => $totalfiltered,
            "data" => array(),

        );

        foreach ($results as $row) {

            $anggota_id = encrypt($row->anggota_id);
            $string = "'$anggota_id'";
            $html = '<div class="table-data-feature">
                        <a type="button" href="/data_anggota/edit/'. $anggota_id . '">
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
                    "nama_lengkap" => $row->nama_lengkap,
                    "no_hp_wa" => $row->no_hp_wa,
                    "email" => $row->email,
                    "alamat" => $row->alamat,
                )
            );
        }
        
        return $this->response->setJSON($build_array);
    }

    public function form()
    {
        $id = 0;
        $this->data['anggota_id'] = current_url(true)->getSegment(4);
        if (trim($this->data['anggota_id']) != ""){
            $id = decrypt($this->data['anggota_id']);
            $this->data['titlehead'] = "Edit Data Anggota";
        }else{
            $this->data['titlehead'] = "Input Data Anggota";
        }

        //validate form input
        $this->validation->setRules([
            'nama_lengkap'    => ['label' => 'Nama Lengkap', 'rules' => 'required|trim'],
            'no_hp_wa'        => ['label' => 'No Hadphone', 'rules' => 'required|trim|numeric'],
            'email'           => ['label' => 'Email', 'rules' => 'required|trim'],
            'alamat'          => ['label' => 'Alamat', 'rules' => 'required|trim'],
        ]);

        if( $id > 0 AND !$this->request->getPost('anggota_id')) {
            // retrieve data for edit
            $anggota = $this->anggota->getAnggota($id); 
            $this->data['anggota'] = $anggota;     
        }else{
            $anggota = new \stdClass();            
            $anggota->nama_lengkap = '';
            $anggota->no_hp_wa     = '';                                   
            $anggota->email        = '';                                   
            $anggota->alamat       = '';                                   
            
            $this->data['anggota'] = $anggota;   
        }

        if (isset($_POST) && !empty($_POST))
        {
            $nama_lengkap     = $this->request->getPost('nama_lengkap');
            $no_hp_wa         = $this->request->getPost('no_hp_wa');
            $email            = $this->request->getPost('email');
            $alamat           = $this->request->getPost('alamat');

            $data = array (
                'nama_lengkap'   => $nama_lengkap,
                'no_hp_wa'       => $no_hp_wa,               
                'email'          => $email,               
                'alamat'         => $alamat,               
            );


             //check to see if we are updating
            if( $id > 0 AND !$this->request->getPost('anggota_id') ) { // update
                $data['updated_by'] = 1;
                $data['updated_date'] = date('Y-m-d H:i:s');
                if ($this->validation->withRequest($this->request)->run() === TRUE )
                {       
                    $this->anggota->update($id, $data);
                    $this->session->setFlashdata('message', "Update data anggota berhasil.." );
                    return redirect()->to(base_url('data_anggota'));
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

                        $this->anggota->insert($data);
                        $this->session->setFlashdata('message', "Tambah data anggota berhasil..");
                        return redirect()->to(base_url('data_anggota'));
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
        return view('referensi/anggota/form_anggota', $this->data);
    }

    public function delete()
    {
        $id = decrypt(current_url(true)->getSegment(4));

        $anggota = $this->anggota->getAnggota($id); 
        $this->anggota->delete($id);    
    }

}