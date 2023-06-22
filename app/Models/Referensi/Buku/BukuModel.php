<?php

namespace App\Models\Referensi\Buku;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table = "tb_buku";
    protected $_data = null;
    protected $primaryKey = 'buku_id';
	protected $mauth = null;

     /**
     * allowed Field
     */
    protected $allowedFields = [
        'buku_id',
        'isbn',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'jumlah_halaman',
    ];

    public function __construct()
    {
        parent::__construct();
        // $this->mauth = new \IonAuth\Models\IonAuthModel();

    }

    function getData($id = null, $offset = null, $limit = null, $order = null, $filters = null )
    {
        
        $builder = $this->db->table($this->table . ' a');
		$builder->select('a.*');
		$builder->orderBy('a.judul', 'ASC');


        if ($id == null OR $id == "") {
            if (!empty($filters)) {
                if (is_array($filters) && count($filters) >= 1) {
                    $builder->groupStart();
					$builder->like('a.isbn', $filters[0]['value']);
					$builder->orLike('a.judul', $filters[0]['value']);
					$builder->orLike('a.penulis', $filters[0]['value']);
					$builder->orLike('a.penerbit', $filters[0]['value']);
					$builder->orLike('a.tahun_terbit', $filters[0]['value']);
					$builder->orLike('a.jumlah_halaman', $filters[0]['value']);
                    $builder->groupEnd();
                }
            }

            if (!empty($order)) {
                $builder->orderBy($order[0]['field'], $order[0]['dir'], TRUE);
            } else {
                $builder->orderBy('a.buku_id');
            }

            if (empty($offset)) $offset = 0;
            if (empty($limit)) $limit = 10;

            $builder->limit($limit, $offset);

            $this->_data = $builder->get()->getResult();

        } else {

            $builder->where("a.buku_id", $id);

            $this->_data = $builder->get()->getRow();

        }

        return $this->_data;

    }

    function getDataCnt($filters = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('count(*) as _cnt');

        if (!empty($filters)) {
            if (is_array($filters) && count($filters) >= 1) {
                $builder->groupStart();
                $builder->like('isbn', $filters[0]['value']);
                $builder->orLike('judul', $filters[0]['value']);
                $builder->orLike('penulis', $filters[0]['value']);
                $builder->orLike('penerbit', $filters[0]['value']);
                $builder->orLike('tahun_terbit', $filters[0]['value']);
                $builder->orLike('jumlah_halaman', $filters[0]['value']);
                $builder->groupEnd();
            }
        }

        $this->_data = $builder->get()->getRow()->_cnt;
        return $this->_data;
    }

    function getBuku($id = null)
    {
		$builder = $this->db->table($this->table);

        if ($id) {
            $builder->where('buku_id', $id);
            $this->_data = $builder->get()->getRow();
        } else {
            $builder->orderBy('judul ASC');
            $this->_data = $builder->get()->getResult();
        }
        
        return $this->_data;
    }
}
