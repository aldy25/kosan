<?=$this->extend('Base/Main')?>
<?=$this->extend('Base/Menu')?>
<?=$this->section('Konten')?>
<div class="row" style="margin-top:10px;">
<h4 style="margin-left:20px;">Maps</h4>
<div class="col-md-12">
<iframe src="<?=$map?>" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>  
</div>
</div>


<div class="row" style="margin-top:30px;"> 
    <h4 style="margin-left:20px;">Informasi Kosan</h4>
    <div class="col-md-12" style="margin-top:30px;">
        <div class="card m-b-30">
            <img class="card-img-top img-fluid" src="<?=base_url()?>/assets/images/kosan/<?=$gambar?>" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title font-20 mt-0"><?=$nama_kosan?></h4>
                <p class="card-text"> Harga : Rp,<?=number_format($harga)?> / Tahun</p>
            </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Jumlah Kamar : <?=$jumlah_kamar?></li>
                    <li class="list-group-item">Status Kosan : <?=$status?></li>
                </ul>
            <div class="card-body">
               <small class="card-link" style="font-style:italic;">
                    Alamat : <?=$alamat?>
               </small>
               <a id="tambah" data-toggle="modal" data-target="#modaltambah"  data-kode_kos="<?=$kode_kos?>"  class="card-link" href="">Ajukan Pesanan Kos</a>
            </div>
        </div>

    </div><!-- end col -->
   
</div> 



<div style="text-align:center;" class="col-md-12">
    <h6 style="text-align:center"><a href="<?=base_url()?>/Lihat_Kosan">Lihat Semua Kosan</a></h6>
</div>


<!--modal tambah-->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black;" class="modal-title" id="exampleModalLabel">Ajukan Pesanan Kosan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('' , ['class' =>'formsimpan'])?>
            <div class="modal-body">
            <input style="display:none;" class="form-control " type="text" placeholder="pesan" name="pesan" id="pesan">
                        <div style="text-align:center; font-size:25px; "  class="invalid-feedback errorpesan">
                        </div>
            <div class="form-group row" style="display: none;">
                    <div class="col-sm-8">
                        <input type="text" name="kosan" id="kode_kos" class="form-control">        
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="bukti_bayar" class="col-sm-2 col-form-label">Bukti Pembayaran</label>
                    <div class="col-sm-8">
                        <input type="file" name="bukti_bayar" id="bukti_bayar" class="form-control"> 
                        <small style="font-style:italic; color:blue;">Rekening : 23457809678 (BRI/Aldy Nifratama)</small> 
                        <div  class="invalid-feedback errorbukti_bayar">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="lama_waktu" class="col-sm-2 col-form-label">Lama Sewa/Tahun</label>
                    <div class="col-sm-8">
                        <input style="color:black;" type="number" name="lama_waktu"  id="lama_waktu" class="form-control">
                        <div  class="invalid-feedback errorlama_waktu">
                        </div>
                    </div>
                </div>   
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan">Simpan</button>
                    <button type="button"class="btn btn-danger" data-dismiss="modal">close</button>
                </div>
                <?=form_close()?>
            </div>
        </div>
    </div>

</div>
<!--end modal tambah-->

<script>
 $(document).ready(function () {
    $(document).on('click', '#tambah', function(){
            $('.modal-body #kode_kos').val($(this).data('kode_kos'));
    });

    $(".formsimpan").submit(function(e){
            e.preventDefault();
            let form = $('.formsimpan')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: "<?=base_url('Create_pesanan')?>",
                data:data,
                processData:false,
                contentType:false,
                cache:false,
                enctype:'multipart/form-data',
                dataType: "json",
                beforeSend:function(){
                    $('.btnsimpan').attr('disable','disabled');
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete:function(){
                    $('.btnsimpan').removeAttr('disable',);
                    $('.btnsimpan').html('Simpan');
                },
                success:function(response){
                    if(response.error){
                        if(response.error.bukti_bayar){
                            $('#bukti_bayar').addClass('is-invalid');
                            $('.errorbukti_bayar').html(response.error.bukti_bayar);
                        }else {
                            $('#bukti_bayar').removeClass('is-invalid');
                            $('.errorbukti_bayar').html('');
                        }
                        if(response.error.lama_waktu){
                            $('#lama_waktu').addClass('is-invalid');
                            $('.errorlama_waktu').html(response.error.lama_waktu);
                        }else {
                            $('#lama_waktu').removeClass('is-invalid');
                            $('.errorlama_waktu').html('');
                        }
                        if(response.error.pesan){
                            $('#pesan').addClass('is-invalid');
                            $('.errorpesan').html(response.error.pesan);
                        }else {
                            $('#pesan').removeClass('is-invalid');
                            $('.errorpesan').html('');
                        }
                       
                    }else{
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses

                        })
                        $('#modaltambah').modal('hide');
                        $("input").val("");
                        $("select").val("");
                        $("textarea").val("");

                    }
                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    
 });
</script>
<?=$this->endsection()?>