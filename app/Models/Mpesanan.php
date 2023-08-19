<?php
namespace App\Models;
use CodeIgniter\Model;
class Mpesanan extends model
{
    protected $table ='tbl_pesanan';
    protected $primaryKey ='id_pesanan ';
    protected $allowedFields = ['','kosan','user','waktu','bukti_bayar','verifikasi','lama_waktu'];
}