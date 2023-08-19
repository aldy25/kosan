<?php
namespace App\Models;
use CodeIgniter\Model;
class Mkosan extends model
{
    protected $table ='tbl_kosan';
    protected $primaryKey ='id_kosan';
    protected $allowedFields = ['','nama_kosan','alamat','harga','jumlah_kamar','status','map','gambar','kode_kos','pemilik'];
}