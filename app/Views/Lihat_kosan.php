<?=$this->extend('Base/Main')?>
<?=$this->extend('Base/Menu')?>
<?=$this->section('Konten')?>
<div class="col-sm-12">
    <div class="card m-b-30">   
        <h4 class="card-header mt-0">Cari Kosan di Sini</h4>
        <div class="card-body">
        <small>Cari berdasarkan alamat/hargamax/min</small> 
          
            <p class="card-text">
            <div class="alert alert-info">
              <form action="<?=base_url()?>/Search_kosan" method="post">
                <div class="form-group row">
                    <div class="col-sm-3">
                        <input class="form-control mt-2" type="text" name="alamat" required placeholder="alamat">
                    </div>
                    <div class="col-sm-3">
                        <input class="form-control mt-2" type="number" name="max" required placeholder="harga max">
                    </div>
                    <div class="col-sm-3">
                        <input class="form-control mt-2" type="number" name="min" required placeholder="harga min">
                    </div>
                    <div class="col-sm-3">
                        <button  class="btn btn-primary form-control mt-2" type="submit"> Cari</button>
                    </div>
                </div>
               </form>
            </div>
            </p>
        </div>
    </div>
</div>
<div class="row"> <h4> Data Kosan</h4></div>
<div class="row">
  
 <?php 
  foreach($kosan as $row) 
  {
 ?>
  
    <div style="background-color: #eff3f6; padding-top: 20px;" class="col-md-3">
        <div class="card" style="width: 96%;text-align:center; ">
            <img style="height: auto; width: 100%;" src="<?=base_url()?>/assets/images/kosan/<?=$row->gambar?>" class="card-img-top img-fluid" alt="...">
            <div class="card-body">
              <h4 class="card-title fw-bold"><?=$row->nama_kosan?></h4>
              <a href="<?=base_url();?>/Detail/<?=$row->kode_kos?>" class="card-text">Lihat Detail</a>  
              <p class="card-text">
                Rp, <?=number_format($row->harga)?>/ Bulan
              </p> 
              <small style="font-style:italic;">Alamat : <?=$row->alamat?></small>
            </div>
        </div> 
     </div>   

     <?php }
     ?>
     
</div>
    <?=$this->endsection()?>