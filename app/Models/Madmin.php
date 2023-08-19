<?php
namespace App\Models;
use CodeIgniter\Model;
class Madmin extends model
{
    protected $table ='tbl_admin';
    protected $primaryKey ='id_data ';
    protected $allowedFields = ['','kodkun','nama','alamat'];
}