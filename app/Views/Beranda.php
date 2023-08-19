<?=$this->extend('Base/Main')?>
<?=$this->extend('Base/Menu')?>
<?=$this->section('Konten')?>
<div class="col-sm-12">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.2430697600753!2d103.51898483664661!3d-1.6100901184384253!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2588f48ba4d2f3%3A0x3595db7f5bb6e995!2sUniversitas%20Jambi!5e0!3m2!1sid!2sid!4v1657127826385!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
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
<div style="text-align:center;" class="col-md-12">
    <h6 style="text-align:center"><a href="<?=base_url()?>/Lihat_Kosan">Lihat Semua Kosan</a></h6>
</div>
    <?=$this->endsection()?>