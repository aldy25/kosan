<?php
namespace App\Controllers\Auth;
use App\Controllers\BaseController;
use config\Services;

class Login extends BaseController
{
    public function index()
    {
        $data=[
            'title'=>'Halaman Login Sistem Pencarian Kosan'
        ];
        return view('Auth/Login',$data);
    }

    public function cek_login(){
        $this->db= \config\Database::connect();
        if ($this->request->isAJAX())
        {
            $this->db= \config\Database::connect();
            $username=$this->request->getVar('username');
            $password=$this->request->getVar('password');
            $validation = \config\Services::validation();
            $valid = $this->validate([
                'username'=>[
                    'label'=>'Username',
                    'rules'=> 'required',
                    'errors'=>[
                        'required' =>'{field} tidak boleh kosong'

                    ]
                ],
                'password'=> [
                    'label'=>'password',
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'{field} wajib diisi'
                    ]
                ]
            ]);
    
            if(!$valid) {
                $msg = [
                    'error' => [
                        'username' => $validation->getError('username'),
                        'password' => $validation->getError('password')
                    ]
                ];
            }else{
              
                $query_cekuser=$this->db->query("SELECT * from tbl_akun  WHERE username='$username'");
                $result=$query_cekuser->getResult();
                if(count($result)>0){
                    $row=$query_cekuser->getRow();
                    $password_user=$row->password;
                    if (password_verify($password,$password_user)){
                        $status=$row->status;
                        if($status==='block'){
                            $msg=[
                                'error'=>[
                                    'pesan'=>"Mohon maaf, Akun ini di block"
                                ]
                            ];
                             }else{
                                $simpan_session =[
                                    'login' => 'true',
                                    'kode_akun'=>$row->kode_akun,
                                    'level'=>$row->level,
                                ];
                                session()->set($simpan_session);
                                  
                    
                        $msg=[
                            'sukses'=>[
                                'sukses' => 'Login Berhasil'
                            ]
                        ];
                             }
                    
                    }else{
                        $msg=[
                            'error'=>[
                                'password'=>"Password salah!!"
                            ]
                        ];
                    }
                }else{
                    $msg=[
                        'error'=>[
                            'username'=>'maaf username tidak ditemukan'
                        ]
                    ];
                }
            }
            echo json_encode($msg);
        }else{
            exit('Maaf Data Tidak di Temukan');
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/Login');
    }
} 
?>