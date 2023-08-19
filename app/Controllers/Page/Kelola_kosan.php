<?php 
namespace App\Controllers\Page;
use App\Controllers\BaseController;
use Config\Services;
use App\Models\Mdkelolakosan;

class Kelola_kosan extends BaseController
{
    public function index()
    {
        $data=
        [
            'title'=>'Halaman Kelola Kosan Sistem Pencarian Kosan'
        ];
        return view('Kelola_kosan/Vdata',$data);
    }

    public function ambildata()
    {
        if($this->request->isAJAX())
        {
            $data =
            [
                'tampildata' => $this->kosan->findAll()
            ];
            $msg =
            [
                'data' =>view('Kelola_kosan/Data',$data)
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
        $datamodel = new Mdkelolakosan($request);
        if ($request->getMethod(true)=='POST'){
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list){
                 $tombolhapus = " <button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"hapus('". $list->id_kosan.
                 "')\"><i class=\"fa fa-trash\"></i></button>";
                $no++;
                $row=[];
                $row[]=$no;
                $row[]=$list->nama_kosan;
                $row[]=$list->alamat;
                $row[]=$list->harga;
                $row[]=$list->status;
                $row[]=$list->nama;
                $row[]=$tombolhapus;
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

    public function insert_kosan()
    {
        if ($this->request->isAJAX()){
            $validation = \config\Services::validation();
            $valid = $this->validate([
                'nama_kosan'=>[
                    'label'=>'Nama Kosan ',
                    'rules'=> 'required',
                    'errors'=>[
                        'required' =>'{field} Wajib di isi'

                    ]
                ],
                'alamat'=>[
                    'label'=>'Alamat',
                    'rules'=> 'required',
                    'errors'=>[
                        'required' =>'{field} Wajib di isi'

                    ]
                ],
                'harga'=>[
                    'label'=>'Harga',
                    'rules'=> 'required',
                    'errors'=>[
                        'required' =>'{field} Wajib di isi'

                    ]
                ],
                'jumlah_kamar'=>[
                    'label'=>'Jumlah kamar',
                    'rules'=> 'required',
                    'errors'=>[
                        'required' =>'{field} Wajib di isi'

                    ]
                ],
                'map'=>[
                    'label'=>'Map',
                    'rules'=> 'required',
                    'errors'=>[
                        'required' =>'{field} Wajib di isi'

                    ]
                ],
                'gambar'=>[
                    'label'=>'Gambar Kosan',
                    'rules'=> 'uploaded[gambar]|mime_in[gambar,image/png,image/jpeg]|is_image[gambar]',
                    'errors'=>[
                        'uploaded' =>'tidak ada file yang di pilih',
                        'mime_in' => 'Harus dalam bentuk gambar, jangan file yang lain'
                    ]
                ], 
           

            ]);
            if(!$valid) {
                $msg = [
                    'error' => [
                        'nama_kosan' => $validation->getError('nama_kosan'),
                        'alamat' => $validation->getError('alamat'),
                        'harga' => $validation->getError('harga'),
                        'jumlah_kamar' => $validation->getError('jumlah_kamar'),
                        'map' => $validation->getError('map'),
                        'gambar' => $validation->getError('gambar'),
                       
                    ]
                ];
            }else{
                $filefoto = $this->request->getFile('gambar');
                $filefoto->move('assets/images/kosan');
                $namafoto = $filefoto->getName();
                $this->db =\config\Database::connect();
                $session = \config\Services::session();
                $kode_akun=$session->get('kode_akun');
                $query_cekuser=$this->db->query("SELECT * from tbl_pemilik  WHERE akun='$kode_akun'");
                $result=$query_cekuser->getRow();
                $pemilik=$result->kode_pemilik;
                $kode_kos=rand(100,30000000);
                $simpandata = [
                    'nama_kosan' => $this->request->getPost('nama_kosan'),
                    'alamat' => $this->request->getPost('alamat'),
                    'harga' => $this->request->getPost('harga'),
                    'jumlah_kamar' =>$this->request->getPost('jumlah_kamar'),
                    'status' =>'ready',
                    'map' =>$this->request->getPost('map'),
                    'gambar' =>$namafoto,
                    'kode_kos' =>$kode_kos,
                    'pemilik' =>$pemilik,
                ];
                $this->kosan->insert($simpandata);
                $msg = [
                    'sukses' => 'Data Kosan berhasil di tambahkan'
                ];

            }
            echo json_encode($msg);
        }else{
            exit('Maaf Data Tidak di Temukan');
        }
    }

    public function search()
    {
        $alamat=$this->request->getPost('alamat');
        $hargamax=$this->request->getPost('max');
        $hargamin=$this->request->getPost('min');
        $this->db =\config\Database::connect();
        $query=$this->db->query("SELECT * FROM `tbl_kosan` WHERE alamat LIKE '%$alamat%' AND harga >='$hargamin' AND harga <= '$hargamax'");
        $kosan=$query->getResult();
        if(count($kosan)>0)
        {
            $data=[
                'title'=>'Hasil Search',
                'pesan'=>'Berikut Hasil Yang Anda Cari',
                'kosan'=>$kosan
            ];
        }else{
            $data=[
                'title'=>'Hasil Search',
                'pesan'=>'Tidak Ada Hasil Pencarian',
                'kosan'=>$kosan
            ];
        }
        return view('Hasil_search',$data);
       
    }

    public function lihat()
    {
        $this->db =\config\Database::connect();
        $query=$this->db->query("SELECT * FROM tbl_kosan");
        $data = [
            'title'=>'Lihat Semua Kosan',
            'kosan'=>$query->getResult()
        ];
        return view('Lihat_kosan',$data);
    }
    public function hapus()
    {
        if ($this->request->isAJAX()){
            $id=$this->request->getVar('id_kosan');
            $this->kosan->delete($id);
            $msg=[
                'sukses'=>'Data Berhasil di hapus'
            ];
            echo json_encode($msg);
        }else{
           echo "Maaf Pergerakan Anda Mencurigakan";
        }


    }
}
?>