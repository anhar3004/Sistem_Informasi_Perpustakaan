<?php

namespace App\Models\Transaksi;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = "tb_transaksi";
    protected $_data = null;
    protected $primaryKey = 'transaksi_id';
	protected $mauth = null;

    /**
     * allowed Field
     */
    protected $allowedFields = [
        'transaki_id',
        'buku_id',
        'anggota_id',
        'tgl_peminjaman',
        'tgl_pengembalian',
        'status',
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
		$builder->select('a.*, b.isbn, b.judul, b.penulis, b.penerbit, b.tahun_terbit, b.jumlah_halaman, c.nama_lengkap, c.no_hp_wa, c.email, c.alamat');
        $builder->join("tb_buku b", "b.buku_id=a.buku_id", "inner");
        $builder->join("tb_anggota c", "c.anggota_id=a.anggota_id", "inner");
		$builder->orderBy('a.tgl_peminjaman', 'ASC');

        if ($id == null OR $id == "") {
            if (!empty($filters)) {
                if (is_array($filters) && count($filters) >= 1) {
                    $builder->groupStart();
					$builder->like('c.nama_lengkap', $filters[0]['value']);
					$builder->orLike('c.no_hp_wa', $filters[0]['value']);
					$builder->orLike('c.alamat', $filters[0]['value']);
					$builder->orLike('b.isbn', $filters[0]['value']);
					$builder->orLike('b.judul', $filters[0]['value']);
					$builder->orLike('b.penulis', $filters[0]['value']);
					$builder->orLike('a.status', $filters[0]['value']);
                    $builder->groupEnd();
                }
            }

            if (!empty($order)) {
                $builder->orderBy($order[0]['field'], $order[0]['dir'], TRUE);
            } else {
                $builder->orderBy('a.tgl_peminjaman', 'ASC');
            }

            if (empty($offset)) $offset = 0;
            if (empty($limit)) $limit = 10;

            $builder->limit($limit, $offset);

            $this->_data = $builder->get()->getResult();

        } else {

            $builder->where("a.transaksi_id", $id);

            $this->_data = $builder->get()->getRow();

        }

        return $this->_data;

    }

    function getDataCnt($filters = null)
    {
        $builder = $this->db->table($this->table . ' a');
        $builder->select('count(*) as _cnt');
        $builder->join("tb_buku b", "b.buku_id=a.buku_id", "inner");
        $builder->join("tb_anggota c", "c.anggota_id=a.anggota_id", "inner");

        if (!empty($filters)) {
            if (is_array($filters) && count($filters) >= 1) {
                $builder->groupStart();
                $builder->like('c.nama_lengkap', $filters[0]['value']);
                $builder->orLike('c.no_hp_wa', $filters[0]['value']);
                $builder->orLike('c.alamat', $filters[0]['value']);
                $builder->orLike('b.isbn', $filters[0]['value']);
                $builder->orLike('b.judul', $filters[0]['value']);
                $builder->orLike('b.penulis', $filters[0]['value']);
                $builder->orLike('a.status', $filters[0]['value']);
                $builder->groupEnd();
            }
        }

        $this->_data = $builder->get()->getRow()->_cnt;
        return $this->_data;
    }

    function getTransaksi($id = null)
    {
		$builder = $this->db->table($this->table);

        if ($id) {
            $builder->where('transaksi_id', $id);
            $this->_data = $builder->get()->getRow();
        } else {
            $builder->orderBy('tgl_peminjaman ASC');
            $this->_data = $builder->get()->getResult();
        }
        
        return $this->_data;
    }
}
