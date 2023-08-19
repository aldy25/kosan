<?php 
namespace App\Controllers\Page;
use App\Controllers\BaseController;
use Config\Services;
use App\Models\Mdadmin;
class Admin extends BaseController
{
    public function index()
    {
        $data=
        [
            'title'=>'Halaman Akun Admin Sistem Pencarian Kosan'
        ];
        return view('Admin/Vdata',$data);
    }

    public function ambildata()
    {
        if($this->request->isAJAX())
        {
            $data =
            [
                'tampildata' => $this->admin->findAll()
            ];
            $msg =
            [
                'data' =>view('Admin/Data',$data)
            ];
            echo json_encode($msg);
        }
        else
        {
            exit('Maaf data tidak ditemukan');
        }
    }

    public function listdata()
    {
        $this->db= \config\Database::connect();
        $request = Services::request();
        $datamodel = new Mdadmin($request);
        if ($request->getMethod(true)=='POST'){
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list){
                $kode_akun=$list->kodkun;
                $query_cekuser=$this->db->query("SELECT * from tbl_akun  WHERE kode_akun='$kode_akun'");
                $row=$query_cekuser->getRow();
                $status=$row->status;
                $tomboledit = "<button  id=\"edit\" type=\"button\" class=\"btn btn-info btn-sm\"data-toggle=\"modal\" data-target=\"#modalEdit\" 
                data-akun=\"$list->kodkun\">
                <i class=\"fa fa-tags\" ></i></button>";
                $no++;
                $row=[];   
                $row[]=$no;
                $row[]=$list->nama;
                $row[]=$list->alamat;
                $row[]=$status;
                $row[]=$tomboledit;
                $data[]=$row;
            }
            $output = [
                "draw"=> $request->getPost('draw'),
                "recordsTotal"=> $datamodel->count_all(),
                "recordsFiltered" => $datamodel->count_filtered(),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }
    public function create_admin()
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
                    'level' => 'admin',
                ];
                $this->akun->insert($simpandata_akun);

                $query_cekuser=$this->db->query("SELECT * from tbl_akun  WHERE username='$username'");
                $result=$query_cekuser->getRow();
                $kodkun=$result->kode_akun;
                $dataadmin = [
                    'kodkun' => $kodkun,
                    'nama' => $nama,
                    'alamat' => $alamat,
                ];
                $this->admin->insert($dataadmin);
                $msg = [
                    'sukses' => 'Admin Berhasil Di Tambahkan'
                ];
            }
            echo json_encode($msg);
        }else{
            exit('Maaf Data Tidak di Temukan');
        }

    }

    

    
}
?>