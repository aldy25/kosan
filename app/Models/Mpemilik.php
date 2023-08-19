<?php
namespace App\Models;
use CodeIgniter\Model;
class Mpemilik extends model
{
    protected $table ='tbl_pemilik';
    protected $primaryKey ='id_data';
    protected $allowedFields = ['','akun','nama','no_hp','alamat_pemilik','jenkel','kode_pemilik'];
}