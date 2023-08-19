<?php 
namespace App\Controllers\Page;
use App\Controllers\BaseController;
use Config\Services;
use App\Models\Mdpesanan;
class Pesanan extends BaseController
{
    public function index()
    {
        $data=
        [
            'title'=>'Halaman Pesanan Kosan Sistem Pencarian Kosan'
        ];
        return view('Pesanan/Vdata',$data);
    }

    public function ambildata()
    {
        if($this->request->isAJAX())
        {
            $data =
            [
                'tampildata' => $this->pesanan->findAll()
            ];
            $msg =
            [
                'data' =>view('Pesanan/Data',$data)
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
        $datamodel = new Mdpesanan($request);
        if ($request->getMethod(true)=='POST'){
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list){
                $kode_kos=$list->kosan;
                $query_cekuser=$this->db->query("SELECT * from tbl_kosan  WHERE kode_kos='$kode_kos'");
                $row=$query_cekuser->getRow();
                $nama_kosan=$row->nama_kosan;
                $user=$list->user;
                $query_cekuser=$this->db->query("SELECT * from tbl_user  WHERE kode_user='$user'");
                $row=$query_cekuser->getRow();
                $nama=$row->nama;
                $tomboledit = "<button  id=\"edit\" type=\"button\" class=\"btn btn-info btn-sm\"data-toggle=\"modal\" data-target=\"#modalEdit\" 
                data-id_pesanan=\"$list->id_pesanan\"
                data-kosan=\"$list->kosan\">
                <i class=\"fa fa-tags\" ></i></button>";
                $no++;
                $row=[];   
                $row[]=$no;
                $row[]=$nama;
                $row[]=$nama_kosan;
                $row[]=$list->waktu;
                $row[]=$list->verifikasi;
                $row[]=$list->lama_waktu;
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
        if($this->request->isAJAX()){
            $validation = \config\Services::validation();
            $this->db =\config\Database::connect();
            $valid = $this->validate([
                'status'=>[
                    'label'=>'Status Verifikasi',
                    'rules'=>'required',
                    'errors'=>[
                        'required' =>'{field} Wajib di isi'

                    ]
                ],
            ]);
            if(!$valid){
                $msg = [
                    'error' => [
                        'status' => $validation->getError('status'),
                        
                    ]
                ];
            }else{
                
                $status=$this->request->getPost('status');
                $id=$this->request->getPost('id_pesanan');
                $kode_kos=$this->request->getPost('kosan');
                 $this->db->query("UPDATE `tbl_pesanan` SET `verifikasi` = '$status' WHERE `id_pesanan` = $id");
                 $update_kosan=[
                     'status'=>'Soldout',
                 ];

                 $this->db->query("UPDATE `tbl_kosan` SET `status` = 'Soldout' WHERE `kode_kos` = $kode_kos");
                 $msg = [
                     'sukses' => 'Status Verifikasi Berhasil di ubah'
                 ];
                
            }
        echo json_encode($msg);
        }else{
            exit('Maaf Data Tidak di Temukan');
        }
        

    }
    
}
?>