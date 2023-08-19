<?=$this->extend('Base/Main')?>
<?=$this->extend('Base/Menu')?>
<?=$this->section('Konten')?>
<!-- DataTables -->
<link href="<?=base_url()?>https://cdn.datatable.net/rowreoder/1.2.7/css/rowreoder.datatable.min.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>https://cdn.datatable.net/responsive/2.2.5/css/responsive.datatable.min.css" rel="stylesheet" type="text/css" />

<link href="<?=base_url()?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<script src="<?=base_url()?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<div class="col-sm-12">
    <div class="page-title-box">
        <h4 class="page-title">Kelola Kosan </h4>
    </div>
</div>
<div class="col-sm-12">
    <div class="card m-b-30">

        <div class="card-body">
            <div class="card-title">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-plus-circle"></i>Tambah Kosan
                </button>
            </div>
            <p class="card-text viewdata">

            </p>

        </div>
    </div>
</div>

<!-- modal tambah kosan -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black;" class="modal-title" id="exampleModalLabel">Tambah Kosan Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('' , ['class' =>'formsimpan'])?>
            <div class="modal-body">
                <div class="form-group row">
                    <label style=" color:black;" for="nama_kosan" class="col-sm-2 col-form-label">Nama Kosan</label>
                    <div class="col-sm-8">
                        <input style="color:black;" type="text" name="nama_kosan" id="nama_kosan" class="form-control">
                        <div  class="invalid-feedback errornama_kosan">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <textarea style="color:black;" name="alamat" id="alamat" class="form-control"></textarea>
                        <div  class="invalid-feedback erroralamat">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="harga" class="col-sm-2 col-form-label">Harga/kamar</label>
                    <div class="col-sm-8">
                        <input style="color:black;" type="number" name="harga" id="harga" class="form-control">
                        <div  class="invalid-feedback errorharga">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label style=" color:black;" for="jumlah_kamar" class="col-sm-2 col-form-label">Jumlah Kamar</label>
                    <div class="col-sm-8">
                        <input style="color:black;" type="number" name="jumlah_kamar" id="jumlah_kamar" class="form-control">
                        <div  class="invalid-feedback errorjumlah_kamar">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="map" class="col-sm-2 col-form-label">Map</label>
                    <div class="col-sm-8">
                        <textarea style="color:black;" name="map" id="map" class="form-control"></textarea>
                        <div  class="invalid-feedback errormap">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-8">
                        <input style="color:black;" type="file" name="gambar" id="gambar" class="form-control">
                        <div  class="invalid-feedback errorgambar">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-simpan">Simpan</button>
                    <button type="button"class="btn btn-danger" data-dismiss="modal">close</button>
                </div>
                <?=form_close()?>
            </div>
        </div>
    </div>

</div>

<!-- end modal tambah kosan  -->

<script>
    function dataAdmin(){
        $.ajax({
            url:"<?=Base_url('datatabel_kelolakos')?>",
            dataType: "json",
            success: function (response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
    $(document).ready(function () {
        dataAdmin();

        $(".formsimpan").submit(function(e){
            e.preventDefault();
            let form = $('.formsimpan')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: "<?=base_url('Tambah_Kosan')?>",
                data:data,
                processData:false,
                contentType:false,
                cache:false,
                enctype:'multipart/form-data',
                dataType: "json",
                beforeSend:function(){
                    $('.btn-simpan').attr('disable','disabled');
                    $('.btn-simpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete:function(){
                    $('.btn-simpan').removeAttr('disable',);
                    $('.btn-simpan').html('Simpan');
                },
                success:function(response){
                    if(response.error){
                        if(response.error.nama_kosan){
                            $('#nama_kosan').addClass('is-invalid');
                            $('.errornama_kosan').html(response.error.nama_kosan);
                        }else {
                            $('#nama_kosan').removeClass('is-invalid');
                            $('.errornama_kosan').html('');
                        }
                        if(response.error.alamat){
                            $('#alamat').addClass('is-invalid');
                            $('.erroralamat').html(response.error.alamat);
                        }else {
                            $('#alamat').removeClass('is-invalid');
                            $('.erroralamat').html('');
                        }
                        if(response.error.harga){
                            $('#harga').addClass('is-invalid');
                            $('.errorharga').html(response.error.harga);
                        }else {
                            $('#harga').removeClass('is-invalid');
                            $('.errorharga').html('');
                        }

                        if(response.error.jumlah_kamar){
                            $('#jumlah_kamar').addClass('is-invalid');
                            $('.errorjumlah_kamar').html(response.error.jumlah_kamar);
                        }else {
                            $('#jumlah_kamar').removeClass('is-invalid');
                            $('.errorjumlah_kamar').html('');
                        }

                        if(response.error.map){
                            $('#map').addClass('is-invalid');
                            $('.errormap').html(response.error.map);
                        }else {
                            $('#map').removeClass('is-invalid');
                            $('.errormap').html('');
                        }
                        if(response.error.gambar){
                            $('#gambar').addClass('is-invalid');
                            $('.errorgambar').html(response.error.gambar);
                        }else {
                            $('#gambar').removeClass('is-invalid');
                            $('.errorgambar').html('');
                        }

                    }else{
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses
                        })
                        $('#exampleModal').modal('hide');
                        dataAdmin();
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
<?= $this->endsection()?>
