<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class Mdkelolakosan extends Model
{
    protected $table = "tbl_kosan";
    protected $column_order = array(NULL,'nama_kosan','alamat','harga','status','nama');
    protected $column_search = array('nama_kosan','alamat','harga','status','nama');
    protected $order = array('id_kosan ' => 'desc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request)
    {
        $session=\config\services::session();
        $kode_akun=$session->get('kode_akun');
        $this->db =\config\Database::connect();
        $query_cekuser=$this->db->query("SELECT * from tbl_pemilik  WHERE akun='$kode_akun'");
        $result=$query_cekuser->getRow();
        $pemilik=$result->kode_pemilik;
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $p='pemilik';
        $this->dt = $this->db->table($this->table)->like($p,$pemilik)->join('tbl_pemilik','kode_pemilik=pemilik');
    }
    private function _get_datatables_query()
    {
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }
    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered()
    {
        $this->_get_datatables_query();
        return $this->dt->countAllResults();
    }
    public function count_all()
    {
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }
}