<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title><?=$title?></title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Mannatthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="<?=base_url()?>/assets/images/favicon.ico">

        <link href="<?=base_url()?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>/assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>/assets/css/style.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>/assets/plugins/package/dist/sweetalert2.min.css" rel="stylesheet" type="text/css">
        <script src="<?=base_url()?>/assets/plugins/package/dist/sweetalert2.all.min.js"></script>
        <script src="<?=base_url()?>/assets/js/jquery.min.js"></script>
    </head>


    <body>

        
        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    <h3 class="text-center mt-0 m-b-15">
                        <a href="index.html" class="logo logo-admin"><img src="assets/images/logo.png" height="24" alt="logo"></a>
                    </h3>   
                    <div class="p-3">
                        <?=form_open('Auth\Reg_user\reg_user',['class'=>'formtambah']) ?>
                        <?=csrf_field();?>

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" name="username" id="username" type="text" required="" placeholder="Username">
                                    <div  class="invalid-feedback errorusername">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" name="password" id="password" type="password" required="" placeholder="Password">
                                    <div  class="invalid-feedback errorpassword">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" name="nama" id="nama" type="text" required="" placeholder="Nama">
                                    <div  class="invalid-feedback errornama">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <textarea class="form-control" name="alamat" id="alamat" required="" >Alamat</textarea>
                                    <div  class="invalid-feedback erroralamat">
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group text-center row m-t-20">
                                <div class="col-12">
                                    <button class="btn btn-primary btn-block waves-effect waves-light btn-simpan" type="submit">Log In</button>
                                </div>
                            </div>

                            <div class="form-group m-t-10 mb-0 row">
                                <div class="col-sm-7 m-t-20">
                                    <a href="<?=base_url()?>/Login" class="text-muted"><i class="mdi mdi-lock"></i> <small>Login</small></a>
                                </div>
                                <div class="col-sm-5 m-t-20">
                                    <a href="<?=base_url()?>/Reg-Pemilik" class="text-muted"><i class="mdi mdi-account-circle"></i> <small>Daftar Pemilik Kos</small></a>
                                </div>
                            </div>
                            <?=form_close()?>
                    </div>
                </div>
            </div>
        </div>

    <script>
         $(document).ready(function(){
            $(".formtambah").submit(function(e){
                e.preventDefault();
                let form = $('.formtambah')[0];
                let data = new FormData(form);
                $.ajax({
                    type: "post",
                    url: "<?=base_url('Create_user')?>",
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
                        $('.btn-simpan').html('Log In');
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
                                text: response.sukses.text,
                            })
                            window.location.href="<?=base_url()?>/Login";
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

        <!-- jQuery  -->
      
        <script src="<?=base_url()?>/assets/js/popper.min.js"></script>
        <script src="<?=base_url()?>/assets/js/bootstrap.min.js"></script>
        <script src="<?=base_url()?>/assets/js/modernizr.min.js"></script>
        <script src="<?=base_url()?>/assets/js/waves.js"></script>
        <script src="<?=base_url()?>/assets/js/jquery.slimscroll.js"></script>
        <script src="<?=base_url()?>/assets/js/jquery.nicescroll.js"></script>
        <script src="<?=base_url()?>/assets/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="<?=base_url()?>/assets/js/app.js"></script>

    </body>
</html>