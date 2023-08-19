<?php
namespace App\Models;
use CodeIgniter\Model;
class Muser extends model
{
    protected $table ='tbl_user';
    protected $primaryKey ='id_user';
    protected $allowedFields = ['','kodkun','kode_user','nama','alamat'];
}