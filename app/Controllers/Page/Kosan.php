<?php

namespace App\Controllers\Page;
use App\Controllers\BaseController;
use config\Services;
class Kosan extends BaseController
{
    public function detail($kode_kos)
    {
        $this->db =\config\Database::connect();
        $kosan=$this->db->query("SELECT * from tbl_kosan  WHERE kode_kos='$kode_kos'");
        $row=$kosan->getRow();
        $data=[
            'title'=>'Detail Kosan',
            'map'=> $row->map,
            'nama_kosan'=> $row->nama_kosan,
            'alamat'=> $row->alamat,
            'harga'=> $row->harga,
            'jumlah_kamar'=> $row->jumlah_kamar,
            'status'=> $row->status,
            'gambar'=> $row->gambar,
            'kode_kos'=> $row->kode_kos,
            'pemilik'=> $row->pemilik,        
        ];
        return view('Detail',$data);
    }
}
