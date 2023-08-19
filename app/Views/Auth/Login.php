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
                        <?=form_open('',['class'=>'formlogin']) ?>
                        <?=csrf_field();?>
                            <div class="form-group row">
                                <div class="col-12">
                                    <input style="display:none;" class="form-control " type="text" placeholder="pesan" name="pesan" id="pesan">
                                    <div style="text-align:center; font-size:15px;font-style:italic;"  class="invalid-feedback errorpesan">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" type="text" required="" name="username" id="username" placeholder="Username">
                                    <div  class="invalid-feedback errorusername">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" type="password" required="" name="password" id="password" placeholder="Password">
                                    <div  class="invalid-feedback errorpassword">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center row m-t-20">
                                <div class="col-12">
                                    <button class="btn btn-primary btn-block waves-effect waves-light btnlogin" type="submit">Log In</button>
                                </div>
                            </div>

                            <div class="form-group m-t-10 mb-0 row">
                                <div class="col-sm-7 m-t-20">
                                    <a href="<?=base_url()?>/Reg-User" class="text-muted"><i class="mdi mdi-lock"></i> <small>Daftar Sebagai Pengguna</small></a>
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
            $(".formlogin").submit(function(e){
                e.preventDefault();
                let form = $('.formlogin')[0];
                let data = new FormData(form);
                $.ajax({
                    type: "post",
                    url: "<?=base_url('Ceklogin')?>",
                    data:data,
                    processData:false,
                    contentType:false,
                    cache:false,
                    enctype:'multipart/form-data',
                    dataType: "json",
                    beforeSend:function(){
                        $('.btnlogin').attr('disable','disabled');
                        $('.btnlogin').html('<i class="fa fa-spin fa-spinner"></i>');
                    },
                    complete:function(){
                        $('.btnlogin').removeAttr('disable',);
                        $('.btnlogin').html('Log In');
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
                                text: response.sukses.text,
                            })
                            window.location.href="<?=base_url()?>";
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