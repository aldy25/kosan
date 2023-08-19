<?=$this->extend('Base/Main')?>
<?=$this->section('Menu')?>
<?php 
 $session = \config\services::session();
 $level=$session->get('level');
 $kode_akun=$session->get('kode_akun');
 if($level=='admin'){
?>
    <li class="has-submenu">
        <a href="<?=base_url()?>"><i class="mdi mdi-airplay"></i>Dashboard</a>
    </li>
    <li class="has-submenu">
        <a href="#"><i class="mdi mdi-account "></i>Lihat Akun</a>
        <ul class="submenu">
            <li><a href="<?=base_url()?>/Admin">Admin</a></li>
            <li><a href="<?=base_url()?>/User">User</a></li>
            <li><a href="<?=base_url()?>/Pemilik">Pemilik</a></li>
        </ul>
    </li>
    <li class="has-submenu">
        <a href="<?=base_url()?>/Pesanan"><i class="mdi mdi-border-all "></i>Pesanan Kosan</a>
    </li>
<?php
}elseif($level=='pemilik')
{
?>
    <li class="has-submenu">
        <a href="<?=base_url()?>"><i class="mdi mdi-airplay"></i>Dashboard</a>
    </li>
    <li class="has-submenu">
        <a href="<?=base_url()?>/Kelola-Kos"><i class="mdi mdi-table"></i>Kelola Kosan</a>
    </li>
<?php 
}
elseif($level=='user')
{
?>
    <li class="has-submenu">
        <a href="<?=base_url()?>"><i class="mdi mdi-airplay"></i>Dashboard</a>
    </li>
    <li class="has-submenu">
        <a href="<?=base_url()?>/Lihat_Kosan"><i class="mdi mdi-table "></i>Lihat Kosan</a>
    </li>
    <li class="has-submenu">
        <a href="<?=base_url()?>/Pesanan_kosan"><i class="mdi mdi-border-all"></i>Lihat Pesanan Kosan</a>
    </li>
<?php
}else{
    ?>
  <li class="has-submenu">
        <a href="<?=base_url()?>"><i class="mdi mdi-airplay"></i>Dashboard</a>
    </li>
    <li class="has-submenu">
        <a href="<?=base_url()?>/Lihat_Kosan"><i class="mdi mdi-table"></i>Lihat Kosan</a>
    </li>
<?php
}
?>

                           
<?=$this->endsection()?>
