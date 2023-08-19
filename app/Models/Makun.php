<?php
namespace App\Models;
use CodeIgniter\Model;
class Makun extends model
{
    protected $table ='tbl_akun';
    protected $primaryKey ='id_data ';
    protected $allowedFields = ['','kode_akun','username','password','status','level'];
}