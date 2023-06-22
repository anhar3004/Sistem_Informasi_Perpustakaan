<?php

namespace App\Models\Referensi\Anggota;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table = "tb_anggota";
    protected $_data = null;
    protected $primaryKey = 'anggota_id';
	protected $mauth = null;

     /**
     * allowed Field
     */
    protected $allowedFields = [
        'anggota_id',
        'nama_lengkap',
        'no_hp_wa',
        'email',
        'alamat',
        'created_by',
        'created_date',
        'updated_by',
        'updated_date',

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
		$builder->orderBy('a.nama_lengkap', 'ASC');


        if ($id == null OR $id == "") {
            if (!empty($filters)) {
                if (is_array($filters) && count($filters) >= 1) {
                    $builder->groupStart();
					$builder->like('a.nama_lengkap', $filters[0]['value']);
					$builder->orLike('a.no_hp_wa', $filters[0]['value']);
					$builder->orLike('a.email', $filters[0]['value']);
					$builder->orLike('a.alamat', $filters[0]['value']);
                    $builder->groupEnd();
                }
            }

            if (!empty($order)) {
                $builder->orderBy($order[0]['field'], $order[0]['dir'], TRUE);
            } else {
                $builder->orderBy('a.anggota_id');
            }

            if (empty($offset)) $offset = 0;
            if (empty($limit)) $limit = 10;

            $builder->limit($limit, $offset);

            $this->_data = $builder->get()->getResult();

        } else {

            $builder->where("a.anggota_id", $id);

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
                $builder->like('nama_lengkap', $filters[0]['value']);
                $builder->orLike('no_hp_wa', $filters[0]['value']);
                $builder->orLike('email', $filters[0]['value']);
                $builder->orLike('alamat', $filters[0]['value']);
                $builder->groupEnd();
            }
        }

        $this->_data = $builder->get()->getRow()->_cnt;
        return $this->_data;
    }

    function getAnggota($id = null)
    {
		$builder = $this->db->table($this->table);

        if ($id) {
            $builder->where('anggota_id', $id);
            $this->_data = $builder->get()->getRow();
        } else {
            $builder->orderBy('nama_lengkap ASC');
            $this->_data = $builder->get()->getResult();
        }
        
        return $this->_data;
    }

    
}
