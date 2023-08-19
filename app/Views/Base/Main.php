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

        <link rel="shortcut icon" href="<?=base_url();?>/assets/images/favicon.ico">

        <link href="<?=base_url();?>/assets/plugins/morris/morris.css" rel="stylesheet">
        <link href="<?=base_url();?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url();?>/assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url();?>/assets/css/style.css" rel="stylesheet" type="text/css">
        <script src="<?=base_url();?>/assets/js/jquery.min.js"></script>
        <link href="<?=base_url()?>/assets/plugins/package/dist/sweetalert2.min.css" rel="stylesheet" type="text/css">
        <script src="<?=base_url()?>/assets/plugins/package/dist/sweetalert2.all.min.js"></script>
    </head>


    <body>

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container-fluid">

                    <!-- Logo container-->
                    <div class="logo">
                        <!-- Text Logo -->
                        <!--<a href="index.html" class="logo">-->
                        <!--Annex-->
                        <!--</a>-->
                        <!-- Image Logo -->
                        <a href="index.html" class="logo">
                            <img src="<?=base_url();?>/assets/images/logo-sm.png" alt="" height="22" class="logo-small">
                            <img src="<?=base_url();?>/assets/images/logo.png" alt="" height="16" class="logo-large">
                        </a>

                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras topbar-custom">

                        <ul class="list-inline float-right mb-0">
                            
                            

                            
                            <!-- User-->
                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <img src="assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5>Seting</h5>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <?php
                                        $session = \config\services::session();
                                        $login=$session->get('login');
                                        if(empty($login)){
                                    ?>
                                        <a class="dropdown-item" href="<?=base_url()?>/Login"><i class="mdi mdi-logout m-r-5 text-muted"></i> Login</a>
                                    <?php
                                        }
                                        else
                                        {
                                    ?>
                                      <a class="dropdown-item" href="<?=base_url()?>/Logout"><i class="mdi mdi-logout m-r-5 text-muted"></i>Logout</a>
                                    <?php
                                        }
                                    ?>
                                    </div>
                            </li>
                            <li class="menu-item list-inline-item">
                                <!-- Mobile menu toggle-->
                                <a class="navbar-toggle nav-link">
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                                <!-- End mobile menu toggle-->
                            </li>

                        </ul>
                    </div>
                    <!-- end menu-extras -->

                    <div class="clearfix"></div>

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->

            <!-- MENU Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">
                            <?=$this->rendersection('Menu')?>
                        </ul>
                        <!-- End navigation menu -->
                    </div> <!-- end #navigation -->
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->


        <div class="wrapper">
            <div class="container-fluid">
                <?=$this->rendersection('Konten')?>
            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        © 2018 Annex by Mannatthemes.
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->


        <!-- jQuery  -->
       
        <script src="<?=base_url();?>/assets/js/popper.min.js"></script>
        <script src="<?=base_url();?>/assets/js/bootstrap.min.js"></script>
        <script src="<?=base_url();?>/assets/js/modernizr.min.js"></script>
        <script src="<?=base_url();?>/assets/js/waves.js"></script>
        <script src="<?=base_url();?>/assets/js/jquery.slimscroll.js"></script>
        <script src="<?=base_url();?>/assets/js/jquery.nicescroll.js"></script>
        <script src="<?=base_url();?>/assets/js/jquery.scrollTo.min.js"></script>

        <script src="<?=base_url();?>/assets/plugins/skycons/skycons.min.js"></script>
        <script src="<?=base_url();?>/assets/plugins/raphael/raphael-min.js"></script>
        <script src="<?=base_url();?>/assets/plugins/morris/morris.min.js"></script>
    
        <script src="<?=base_url();?>/assets/pages/dashborad.js"></script>

        <!-- App js -->
        <script src="<?=base_url();?>/assets/js/app.js"></script>
        <script>
            /* BEGIN SVG WEATHER ICON */
            if (typeof Skycons !== 'undefined'){
           var icons = new Skycons(
               {"color": "#fff"},
               {"resizeClear": true}
               ),
                   list  = [
                       "clear-day", "clear-night", "partly-cloudy-day",
                       "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                       "fog"
                   ],
                   i;

               for(i = list.length; i--; )
               icons.set(list[i], list[i]);
               icons.play();
           };

       // scroll

       $(document).ready(function() {
       
       $("#boxscroll").niceScroll({cursorborder:"",cursorcolor:"#cecece",boxzoom:true});
       $("#boxscroll2").niceScroll({cursorborder:"",cursorcolor:"#cecece",boxzoom:true}); 
       
       });
       </script>



    </body>
</html>