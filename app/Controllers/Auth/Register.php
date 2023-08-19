<?php
namespace App\Controllers\Auth;
use App\Controllers\BaseController;
use config\Services;

class Register extends BaseController
{
    public function user()
    {
        $data=[
            'title'=>'Halaman Registrasi User Sistem Pencarian Kosan'
        ];
        return view('Auth/Reg_user',$data);
    }
    public function reg_user()
    {
        if ($this->request->isAJAX()){
            $this->db= \config\Database::connect();
            $validation = \config\Services::validation();
            $valid = $this->validate([
                'username'=>[
                    'label'=>'Username',
                    'rules'=> 'required|is_unique[tbl_akun.username]',
                    'errors'=>[
                        'required' =>'{field} tidak boleh kosong',
                        'is_unique'=>'{field} Akun Sudah Ada' 
                    ]
                ],
                'password'=>[
                    'label'=>'Password',
                    'rules'=> 'required|min_length[8]',
                    'errors'=>[
                        'required' =>'{field} tidak boleh kosong',
                        'min_length'=>'{field} Minimal 8 Karakter' 

                    ]
                ],
                'nama'=>[
                    'label'=>'Nama',
                    'rules'=> 'required',
                    'errors'=>[
                        'required' =>'{field} tidak boleh kosong'

                    ]
                ],
                'alamat'=> [
                    'label'=>'Alamat',
                    'rules'=>'required',
                    'errors'=>[
                        'required' =>'{field} tidak boleh kosong'
                    ]
                ]
            ]);


            if(!$valid) {
                $msg = [
                    'error' => [
                        'username' => $validation->getError('username'),
                        'password' => $validation->getError('password'),
                        'nama' => $validation->getError('nama'),
                        'alamat' => $validation->getError('alamat'),
                    ]
                ];

            }
            else
            {
                
                $username=$this->request->getPost('username');
                $password=$this->request->getPost('password');
                $password_hash=password_hash($password,PASSWORD_DEFAULT);
                $nama=$this->request->getPost('nama');
                $alamat=$this->request->getPost('alamat');
                $kode_akun=rand(100,30000000);
                $simpandata_akun = [
                    'kode_akun'=>$kode_akun,
                    'username' => $username,
                    'password' => $password_hash,
                    'status' => 'allow',
                    'level' => 'user',
                ];
                $this->akun->insert($simpandata_akun);

                $query_cekuser=$this->db->query("SELECT * from tbl_akun  WHERE username='$username'");
                $result=$query_cekuser->getRow();
                $kodkun=$result->kode_akun;
                $kode_user=rand(100,30000000);
                $datauser = [
                    'kodkun' => $kodkun,
                    'kode_user'=>$kode_user,
                    'nama' => $nama,
                    'alamat' => $alamat,
                ];
                $this->user->insert($datauser);
                $msg = [
                    'sukses' => 'Registrasi Sukses'
                ];
            }
            echo json_encode($msg);
        }else{
            exit('Maaf Data Tidak di Temukan');
        }
    }

    public function pemilik()
    {
        $data=[
            'title'=>'Halaman Registrasi Pemilik Sistem Pencarian Kosan'
        ];
        return view('Auth/Reg_pemilik',$data);
    }
    public function reg_pemilik()
    {
        if ($this->request->isAJAX()){
            $this->db= \config\Database::connect();
            $validation = \config\Services::validation();
            $valid = $this->validate([
                'username'=>[
                    'label'=>'Username',
                    'rules'=> 'required|is_unique[tbl_akun.username]',
                    'errors'=>[
                        'required' =>'{field} tidak boleh kosong',
                        'is_unique'=>'{field} Akun Sudah Ada' 
                    ]
                ],
                'password'=>[
                    'label'=>'Password',
                    'rules'=> 'required|min_length[8]',
                    'errors'=>[
                        'required' =>'{field} tidak boleh kosong',
                        'min_length'=>'{field} Minimal 8 Karakter' 

                    ]
                ],
                'nama'=>[
                    'label'=>'Nama',
                    'rules'=> 'required',
                    'errors'=>[
                        'required' =>'{field} tidak boleh kosong'

                    ]
                ],
                'no_hp'=>[
                    'label'=>'Nomor Handphone',
                    'rules'=> 'required',
                    'errors'=>[
                        'required' =>'{field} tidak boleh kosong'

                    ]
                ],
                'alamat'=> [
                    'label'=>'Alamat',
                    'rules'=>'required',
                    'errors'=>[
                        'required' =>'{field} tidak boleh kosong'
                    ]
                ],
                'jenkel'=> [
                    'label'=>'Jenis Kelamin',
                    'rules'=>'required',
                    'errors'=>[
                        'required' =>'{field} tidak boleh kosong'
                    ]
                ]
            ]);


            if(!$valid) {
                $msg = [
                    'error' => [
                        'username' => $validation->getError('username'),
                        'password' => $validation->getError('password'),
                        'nama' => $validation->getError('nama'),
                        'no_hp' => $validation->getError('no_hp'),
                        'alamat' => $validation->getError('alamat'),
                        'jenkel' => $validation->getError('jenkel'),
                    ]
                ];

            }
            else
            {
                
                $username=$this->request->getPost('username');
                $password=$this->request->getPost('password');
                $password_hash=password_hash($password,PASSWORD_DEFAULT);
                $nama=$this->request->getPost('nama');
                $no_hp=$this->request->getPost('no_hp');
                $alamat=$this->request->getPost('alamat');
                $jenkel=$this->request->getPost('jenkel');
                $kode_akun=rand(100,30000000);
                $simpandata_akun = [
                    'kode_akun'=>$kode_akun,
                    'username' => $username,
                    'password' => $password_hash,
                    'status' => 'allow',
                    'level' => 'pemilik',
                ];
                $this->akun->insert($simpandata_akun);
                $query_cekuser=$this->db->query("SELECT * from tbl_akun  WHERE username='$username'");
                $result=$query_cekuser->getRow();
                $kodkun=$result->kode_akun;
                $kode_pemilik=rand(100,30000000);
                $datauser = [
                    'akun' => $kodkun,
                    'nama' => $nama,
                    'no_hp'=> $no_hp,
                    'alamat_pemilik' => $alamat,
                    'jenkel' => $jenkel,
                    'kode_pemilik'=>$kode_pemilik
                ];
                $this->pemilik->insert($datauser);
                $msg = [
                    'sukses' => 'Registrasi Sukses'
                ];
            }
            echo json_encode($msg);
        }else{
            exit('Maaf Data Tidak di Temukan');
        }
    }
} 
?>