<?php 
namespace App\Controllers\Page;
use App\Controllers\BaseController;
use Config\Services;
use App\Models\Mduser;
class User extends BaseController
{
    public function index()
    {
        $data=
        [
            'title'=>'Halaman Akun User Sistem Pencarian Kosan'
        ];
        return view('User/Vdata',$data);
    }

    public function ambildata()
    {
        if($this->request->isAJAX())
        {
            $data =
            [
                'tampildata' => $this->user->findAll()
            ];
            $msg =
            [
                'data' =>view('User/Data',$data)
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
        $datamodel = new Mduser($request);
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

    

    
}
?>