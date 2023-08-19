<?php 
namespace App\Controllers\Page;
use App\Controllers\BaseController;
use Config\Services;
use App\Models\Mdkelolapesanan;
class Kelola_pesanan extends BaseController
{
    public function index()
    {
        $data=
        [
            'title'=>'Halaman Pesanan Kosan Sistem Pencarian Kosan'
        ];
        return view('Kelola_pesanan/Vdata',$data);
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
                'data' =>view('Kelola_pesanan/Data',$data)
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
        $request = Services::request();
        $datamodel = new Mdkelolapesanan($request);
        if ($request->getMethod(true)=='POST'){
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list){
                $no++;
                $row=[];   
                $row[]=$no;
                $row[]=$list->nama_kosan;
                $row[]=$list->nama;
                $row[]=$list->waktu;
                $row[]=$list->verifikasi;
                $row[]=$list->lama_waktu;
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

    public function insert_pesanan()
    {
        if($this->request->isAJAX()){
            $validation = \config\Services::validation();
            $this->db =\config\Database::connect();
            $session = \config\Services::session();
            $kode_akun=$session->get('kode_akun');
            $valid = $this->validate([
                'bukti_bayar'=>[
                    'label'=>'Bukti Pembayaran',
                    'rules'=>'uploaded[bukti_bayar]|mime_in[bukti_bayar,image/png,image/jpeg]|is_image[bukti_bayar]',
                    'errors'=>[
                        'uploaded' =>'tidak ada file yang di pilih',
                        'mime_in' => 'Harus dalam bentuk gambar, jangan file yang lain'

                    ]
                ],
                'lama_waktu'=>[
                    'label'=>'Lama Waktu',
                    'rules'=> 'required',
                    'errors'=>[
                        'required' =>'{field} Wajib di isi'

                    ]
                ],
            ]);
            if(!$valid){
                $msg = [
                    'error' => [
                        'bukti_bayar' => $validation->getError('bukti_bayar'),
                        'lama_waktu' => $validation->getError('lama_waktu'),
                    ]
                ];
            }else{
                if(empty($kode_akun)){
                    $msg = [
                        'error' => [
                            'pesan' => 'Harus Login dulu untuk dapat memesan kosan'
                        ]
                    ];
                }else{
                    $filefoto = $this->request->getFile('bukti_bayar');
                    $filefoto->move('assets/images/kosan');
                    $namafoto = $filefoto->getName();
                    $query_cekuser=$this->db->query("SELECT * from tbl_user  WHERE kodkun='$kode_akun'");
                            $row=$query_cekuser->getRow();
                            $kode_user=$row->kode_user;
                            $simpandata = [
                                'kosan' => $this->request->getPost('kosan'),
                                'user' => $kode_user,
                                'waktu' => date('d-m-Y'),
                                'bukti_bayar' =>$namafoto,
                                'verifikasi' =>'Belum Terverifikasi',
                                'lama_waktu' =>$this->request->getPost('lama_waktu'),
                            ];
                            $this->pesanan->insert($simpandata);
                            $update_kosan=[
                                'status'=>'Sudah Dipesan',
                            ];
                            $kode_kos= $this->request->getPost('kosan');
                            $this->db->query("UPDATE `tbl_kosan` SET `status` = 'Sudah Dipesan' WHERE `tbl_kosan`.`kode_kos` = '$kode_kos' ");
                            $msg = [
                                'sukses' => 'Data Pesanan berhasil di tambahkan'
                            ];
                }
            }
        echo json_encode($msg);
        }else{
            exit('Maaf Data Tidak di Temukan');
        }
        

    }
    
}
?>