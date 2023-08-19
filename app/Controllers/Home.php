<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use config\Services;
class Home extends BaseController
{
    public function index()
    {
        $this->db =\config\Database::connect();
        $kosan=$this->db->query("SELECT * from tbl_kosan  LIMIT 8");
        $data=[
            'title'=>'Selamat Datang di Sistem Pencarian Kosan',
            'kosan'=> $kosan->getResult()
        ];
        return view('Beranda',$data);
    }
}
