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
        <h4 class="page-title">Data Akun Admin</h4>
    </div>
</div>
<div class="col-sm-12">
    <div class="card m-b-30">

        <div class="card-body">
            <div class="card-title">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-plus-circle"></i>Tambah Admin
                </button>
            </div>
            <p class="card-text viewdata">

            </p>

        </div>
    </div>
</div>

<!--modal edit-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Status Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('' , ['class' =>'formupdate'])?>
            <div class="modal-body" id="modal-d">
            <div class="form-group row" style="display: none;">
                    <div class="col-sm-8">
                        <input type="text" name="akun" id="akun" class="form-control">        
                    </div>
                </div>

            <div class="form-group row">
                <label style=" color:black;" for="status" class="col-sm-2 col-form-label">Status Akun </label>
                <div class="col-sm-8">
                        <select name="status" id="stat" class="form-control">
                            <option style="color:black;" value="">--Pilih--</option>
                            <option style="color:black;" value="block">Block</option>
                            <option style="color:black;" value="Allow">Allow</option>
                        </select>
                    <div  class="invalid-feedback errorstatus">
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
<!--end modal edit-->

<!--modal tambah-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black;" class="modal-title" id="exampleModalLabel">Tambah Data Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('Back/Akun/simpandata' , ['class' =>'formsimpan'])?>
            <div class="modal-body">

          
                <div class="form-group row">
                    <label style=" color:black;" for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-8">
                        <input style="color:black;" type="text" name="username" id="username" class="form-control">
                        <div  class="invalid-feedback errorusername">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style="color:black;" for="password" class="col-sm-2 col-form-label">Password </label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="password" name="password" id="password" class="form-control">
                        <div  class="invalid-feedback errorpassword">
                        </div>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label style="color:black;" for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="text" name="nama" id="nama" class="form-control">
                        <div  class="invalid-feedback errornama">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style="color:black;" for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="text" name="alamat" id="alamat" class="form-control">
                        <div  class="invalid-feedback erroralamat">
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
    function dataAdmin(){
        $.ajax({
            url:"<?=Base_url('datatabel_admin')?>",
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
        $(document).on('click', '#edit', function(){
            $('#modal-d #akun').val($(this).data('akun'));
        });

        $('.formupdate').submit(function(e){
            e.preventDefault();
            let form = $('.formupdate')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: "<?=base_url('Update_status_akun')?>",
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
                success: function(response) {
                    if(response.error){
                        if(response.error.status){
                            $('#stat').addClass('is-invalid');
                            $('.errorstatus').html(response.error.status);
                        }else {
                            $('#stat').removeClass('is-invalid');
                            $('.errorstatus').html('');
                        }       
                    }else{
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses

                        })
                        $('#modalEdit').modal('hide');
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

        $(".formsimpan").submit(function(e){
            e.preventDefault();
            let form = $('.formsimpan')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: "<?=base_url('Create_admin')?>",
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
                        
                        if(response.error.username){
                            $('#username').addClass('is-invalid');
                            $('.errorusername').html(response.error.username);
                        }else {
                            $('#username').removeClass('is-invalid');
                            $('.errorusername').html('');
                        }
                        if(response.error.password){
                            $('#password').addClass('is-invalid');
                            $('.errorpassword').html(response.error.password);
                        }else {
                            $('#password').removeClass('is-invalid');
                            $('.errorpassword').html('');
                        }

                        if(response.error.nama){
                            $('#nama').addClass('is-invalid');
                            $('.errornama').html(response.error.nama);
                        }else {
                            $('#nama').removeClass('is-invalid');
                            $('.errornama').html('');
                        }

                        if(response.error.alamat){
                            $('#alamat').addClass('is-invalid');
                            $('.erroralamat').html(response.error.alamat);
                        }else {
                            $('#alamat').removeClass('is-invalid');
                            $('.erroralamat').html('');
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
