<?php 
namespace App\Controllers\Page;
use App\Controllers\BaseController;
use Config\Services;
use App\Models\Mdpemilik;
class Pemilik extends BaseController
{
    public function index()
    {
        $data=
        [
            'title'=>'Halaman Akun Pemilik Sistem Pencarian Kosan'
        ];
        return view('Pemilik/Vdata',$data);
    }

    public function ambildata()
    {
        if($this->request->isAJAX())
        {
            $data =
            [
                'tampildata' => $this->pemilik->findAll()
            ];
            $msg =
            [
                'data' =>view('Pemilik/Data',$data)
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
        $datamodel = new Mdpemilik($request);
        if ($request->getMethod(true)=='POST'){
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list){
                $kode_akun=$list->akun;
                $query_cekuser=$this->db->query("SELECT * from tbl_akun  WHERE kode_akun='$kode_akun'");
                $row=$query_cekuser->getRow();
                $status=$row->status;
                $tomboledit = "<button  id=\"edit\" type=\"button\" class=\"btn btn-info btn-sm\"data-toggle=\"modal\" data-target=\"#modalEdit\" 
                data-akun=\"$list->akun\">
                <i class=\"fa fa-tags\" ></i></button>";
                $no++;
                $row=[];   
                $row[]=$no;
                $row[]=$list->nama;
                $row[]=$list->no_hp;
                $row[]=$list->alamat_pemilik;
                $row[]=$list->jenkel;
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

    public function update()
    {
        $this->db= \config\Database::connect();
        if ($this->request->isAJAX()){
            $validation = \config\Services::validation();
            $valid = $this->validate([
                'status'=>[
                    'label'=>'Status Akun',
                    'rules'=> 'required',
                    'errors'=>[
                        'required' =>'{field} harus di pilih'
    
                    ]
                ],
                
            ]);
            if(!$valid) 
            {
                $msg = [
                    'error' => [
                        'status' => $validation->getError('status'),        
                    ]
                ];
            }else
            {
                $simpandata = $this->request->getPost('status');
                $kode_akun=$this->request->getPost('akun');
                $query_cekuser=$this->db->query("UPDATE `tbl_akun` SET `status`='$simpandata' WHERE kode_akun = $kode_akun");
               
                $msg = [
                    'sukses' => 'Berhasil di update'
                ];
            }
            echo json_encode($msg);
        }else{
            exit('Maaf Data Tidak di Temukan');
        }
    }

    
}
?>