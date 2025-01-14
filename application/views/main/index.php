<?php
include_once("functions/string.func.php");
include_once("functions/date.func.php");

$this->load->model("base-data/InfoData");
$this->load->library('globalmenu');

$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;
$reqId= $this->input->get('reqId');

// if(!empty($userpegawaimode))
//     $reqPegawaiId= $this->userpegawaimode;
// else
//     $reqPegawaiId= $this->pegawaiId;

$reqPegawaiId= $this->userpegawaimode;
// echo  $this->input->get("reqPegawaiHard");exit;

$formulaid= $this->input->get("formulaid");
$reqPegawaiHard= $this->input->get("reqPegawaiHard");
$rencanasuksesiid= $this->input->get("rencanasuksesiid");
$set= new InfoData();
$set->selectbyparamspegawai(array("A.PEGAWAI_ID"=>$reqPegawaiId),-1,-1);
$set->firstRow();
// echo $set->query; exit;
$reqNama= $set->getField('NAMA');
$reqSatker= $set->getField('NMSATKER');
$reqEmail= $set->getField('EMAIL');
$reqLogo= substr($reqNama, 0, 1);

// untuk kondisi file
$vfpeg= new globalmenu();

$index_set=0;
$arrMenu= [];
$arrparam= ["mode"=>"personal", "formulaid"=>$formulaid, "rencanasuksesiid"=>$rencanasuksesiid];
// $arrMenu= harcodemenu($userstatuspegId);
$arrMenu= $vfpeg->harcodemenu($arrparam);
// print_r($arrMenu);exit;

$arrparam= ["pg"=>$pg, "arrMenu"=>$arrMenu];
$arrcarimenuparent= $vfpeg->cariparentmenu($arrparam);
// echo $arrcarimenuparent;exit;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="<?=base_url()?>">
        <meta charset="utf-8" />
        <title>Aplikasi Manajemen Talenta</title>
        <meta name="description" content="User profile block example" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/custom/jstree/jstree.bundle.css" rel="stylesheet" type="text/css" />

        <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

        <link href="assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/themes/layout/brand/light.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/themes/layout/aside/light.css" rel="stylesheet" type="text/css" />

        <link rel="shortcut icon" href="assets/media/logos/favicon.png" />
        <link href="assets/css/new-style.css" rel="stylesheet" type="text/css" />

        <script src="assets/plugins/global/plugins.bundle.js"></script>
        <script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
        <script src="assets/js/scripts.bundle.js"></script>

        <!-- easy ui -->
        <link rel="stylesheet" type="text/css" href="lib/easyui/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="lib/easyui/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="lib/easyui/demo/demo.css">

        <script type="text/javascript" src="lib/easyui/jquery-easyui-1.4.2/jquery.min.js"></script>
        <script type="text/javascript" src="lib/easyui/jquery-easyui-1.4.2/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="lib/easyui/breadcrum.js"></script>
        <!-- easy ui -->
    
        <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
        <script src="assets/js/valsix-serverside.js"></script>
        <script src="assets/plugins/custom/jstree/jstree.bundle.js"></script>

        <script src="assets/emodal/eModal.min.js"></script>
        <script>
            function openAdd(pageUrl) {
                eModal.iframe(pageUrl, 'Aplikasi')
            }
        </script>

        <!-- <script script type="text/javascript" src="js/highcharts.js"></script> -->
        <!-- <script src="lib/highcharts/jquery-3.1.1.min.js"></script> -->
        <script src="lib/highcharts/highcharts-spider.js"></script>
        <script src="lib/highcharts/highcharts-more.js"></script>
        <script src="lib/highcharts/exporting-spider.js"></script>
        <script src="lib/highcharts/export-data.js"></script>
        <script src="lib/highcharts/accessibility.js"></script>

        <style type="text/css">
            .brand {
                padding-left: 0px;
            }
            .card.card-custom {
              margin-top: 0%;
            }
        </style>

        <link rel="stylesheet" type="text/css" href="assets/css/gaya.css">
        
    </head>

    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!-- <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable aside-minimize"> -->
        <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">

            <a href="app">
                <img alt="Logo" src="images/logo.png" />
            </a>

            <div class="d-flex align-items-center">
                <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                    <span></span>
                </button>

                <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                    <span class="svg-icon svg-icon-xl">

                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                            </g>
                        </svg>

                    </span>
                </button>
            </div>

        </div>

        <div class="d-flex flex-column flex-root">

            <div class="d-flex flex-row flex-column-fluid page">

                <?
                // echo $pg ;
                if($pg == "login"){} else { ?>
                <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">

                    <div class="brand flex-column-auto" id="kt_brand">

                        <a href="app" class="brand-logo">
                            <img alt="Logo" src="images/logo-aplikasi.png" />
                        </a>

                        <button class="brand-toggle btn btn-sm px-0 active" id="kt_aside_toggle">
                            <span class="svg-icon svg-icon svg-icon-xl">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                                        <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                                    </g>
                                </svg>

                            </span>
                        </button>
                    </div>

                    <?if ($pg=='pegawai_data_fip' || $pg=='lokasi_kerja'|| $pg=='pengalaman_kerja'|| $pg=='sk_pns'|| $pg=='sk_cpns'|| $pg=='riwayat_pangkat'|| $pg=='riwayat_jabatan'|| $pg=='riwayat_tugas_tambahan'|| $pg=='riwayat_gaji'|| $pg=='pendidikan_umum'|| $pg=='pelatihan_kepemimpinan'|| $pg=='pelatihan_fungsional'|| $pg=='diklat_lpj'|| $pg=='pelatihan_teknis'|| $pg=='seminar_workshop'|| $pg=='pelatihan_non_klasikal'|| $pg=='orang_tua'|| $pg=='mertua'|| $pg=='suami_istri'|| $pg=='anak'|| $pg=='saudara'|| $pg=='organisasi'|| $pg=='penghargaan'|| $pg=='penilaian_potensi_diri'|| $pg=='catatan_prestasi'|| $pg=='hukuman'|| $pg=='cuti'|| $pg=='tambah_masa_kerja'|| $pg=='ijin_belajar'|| $pg=='sertifikat_pendidikan'|| $pg=='sertifikat_prestasi'|| $pg=='pak'|| $pg=='skp'|| $pg=='kinerja'|| $pg=='komparasi_data'){?>                    
                        <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                            <!--begin::Menu Container-->
                            <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500" style="border: 0px solid red; margin-top: 0px !important; margin-bottom: 0px !important;">
                                <!--begin::Menu Nav-->
                                <ul class="menu-nav">
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="app/index/pegawai" class="menu-link menu-toggle">
                                            <span class="menu-text"><i class="fa fa-arrow-left" aria-hidden="true" style="color: #FFFFFF; margin-right: 10px;"></i>Kembali</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" style="background-color: white;">
                                        <a disabled class="menu-link menu-toggle" style="cursor: context-menu;">
                                            <span class="menu-text" style="color: #bd1007;">FIP - 01</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='lokasi_kerja'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/lokasi_kerja?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Lokasi Kerja</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='pegawai_data_fip'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/pegawai_data_fip?reqId=<?=$reqId?>"  class="menu-link menu-toggle">
                                            <span class="menu-text">Identitas Pegawai</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover"<?if($pg=='pengalaman_kerja'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/pengalaman_kerja?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Pengalaman Kerja</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='sk_cpns'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/sk_cpns?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">SK CPNS</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='sk_pns'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/sk_pns?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">SK PNS</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" style="background-color: white;">
                                        <a disabled class="menu-link menu-toggle" style="cursor: context-menu;">
                                            <span class="menu-text" style="color: #bd1007;">FIP - 02</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='riwayat_pangkat'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/riwayat_pangkat?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Riwayat Pangkat</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='riwayat_jabatan'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/riwayat_jabatan?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Riwayat Jabatan</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='riwayat_tugas_tambahan'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/riwayat_tugas_tambahan?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Riwayat Tugas Tambahan</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='riwayat_gaji'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/riwayat_gaji?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Riwayat Gaji</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='pendidikan_umum'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/pendidikan_umum?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Pendidikan Umum</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='pelatihan_kepemimpinan'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/pelatihan_kepemimpinan?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Pelatihan Kepemimpinan</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='pelatihan_fungsional'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/pelatihan_fungsional?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Pelatihan Fungsional</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='diklat_lpj'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/diklat_lpj?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Diklat Lpj</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='pelatihan_teknis'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/pelatihan_teknis?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Pelatihan Teknis</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='seminar_workshop'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/seminar_workshop?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Seminar/Workshop</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='pelatihan_non_klasikal'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/pelatihan_non_klasikal?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Pelatihan Non Klasikal</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='orang_tua'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/orang_tua?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Orang Tua</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='mertua'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/mertua?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Mertua</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='suami_istri'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/suami_istri?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Suami Istri</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='anak'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/anak?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Anak</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='saudara'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/saudara?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Saudara</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='organisasi'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/organisasi?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Organisasi</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='penghargaan'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/penghargaan?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Penghargaan</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='penilaian_potensi_diri'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/penilaian_potensi_diri?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Penilaian Potensi Diri</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='catatan_prestasi'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/catatan_prestasi?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Catatan Prestasi</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='hukuman'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/hukuman?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Hukuman</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='cuti'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/cuti?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Cuti</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='penguasaan_bahasa'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/penguasaan_bahasa?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Penguasaan Bahasa</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='nikah'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/Nikah?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Nikah</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='tambah_masa_kerja'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/tambah_masa_kerja?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Tambahan Masa Kerja</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='ijin_belajar'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/ijin_belajar?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Ijin Belajar</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='sertifikat_pendidikan'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/sertifikat_pendidikan?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Sertifikat Pendidikan</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='sertifikat_prestasi'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/sertifikat_prestasi?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Sertifikat Profesi</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='pak'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/pak?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">P.A.K</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='skp'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/skp?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">SKP</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='kinerja'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/kinerja?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Kinerja</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='komparasi_data'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/komparasi_data?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Komparasi Data SIMPEG & SIASN</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?} else{?>
                        <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                            <!--begin::Menu Container-->
                            <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500" style="border: 0px solid red; margin-top: 0px !important; margin-bottom: 0px !important;">
                                <!--begin::Menu Nav-->
                                <ul class="menu-nav">
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="app/index/home" class="menu-link menu-toggle">
                                            <span class="menu-text"><i class="fa fa-home" aria-hidden="true" style="color: #FFFFFF;margin-right: 10px;"></i> Home</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="app/index/pegawai_dashboard" class="menu-link menu-toggle">
                                            <span class="menu-text">Dashboard Personal</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <span class="menu-text">Kelengkapan (bantuan)</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <span class="menu-text">Validator</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <span class="menu-text">Dynaport</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <span class="menu-text">Rekap Pensiun</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <span class="menu-text">Ultah</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <span class="menu-text">Pensiun</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <span class="menu-text">KP</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <span class="menu-text">KGB</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <span class="menu-text">DUK</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <span class="menu-text">Statistik</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='pegawai'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/pegawai" class="menu-link menu-toggle">
                                            <span class="menu-text">Pegawai</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <span class="menu-text">Anjab</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <span class="menu-text">Profil Kompetensi</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                        

                                        <? /* ?>
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">

                                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                                <span class="menu-text">Data Utama</span>
                                                <i class="menu-arrow"></i>
                                                <!-- <i class="fa fa-address-book" aria-hidden="true"></i> -->
                                            </a>
                                            <div class="menu-submenu">
                                                <i class="menu-arrow"></i>
                                                <ul class="menu-subnav">
                                                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                                                        <span class="menu-link">
                                                            <span class="menu-text">Data Utama</span>
                                                        </span>
                                                    </li>

                                                                                    <li class="menu-item " aria-haspopup="true">
                                            <a href="app/index/pegawai_data" class="menu-link">
                                                <i class="menu-bullet menu-bullet-line">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Identitas Pegawai</span>
                                            </a>
                                        </li>
                                                                                    
                                                </ul>
                                            </div>
                                        </li>
                                                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">

                                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                                <span class="menu-text">Data Riwayat</span>
                                                <i class="menu-arrow"></i>
                                                <!-- <i class="fa fa-address-book" aria-hidden="true"></i> -->
                                            </a>
                                            <div class="menu-submenu">
                                                <i class="menu-arrow"></i>
                                                <ul class="menu-subnav">
                                                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                                                        <span class="menu-link">
                                                            <span class="menu-text">Data Riwayat</span>
                                                        </span>
                                                    </li>

                                                                                    <li class="menu-item " aria-haspopup="true">
                                            <a href="app/index/pegawai_pendidikan_umum" class="menu-link">
                                                <i class="menu-bullet menu-bullet-line">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Pendidikan Umum</span>
                                            </a>
                                        </li>
                                                                        <li class="menu-item " aria-haspopup="true">
                                            <a href="app/index/pegawai_skp" class="menu-link">
                                                <i class="menu-bullet menu-bullet-line">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">SKP</span>
                                            </a>
                                        </li>
                                                                        <li class="menu-item " aria-haspopup="true">
                                            <a href="app/index/pegawai_huknis" class="menu-link">
                                                <i class="menu-bullet menu-bullet-line">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Riwayat Huknis</span>
                                            </a>
                                        </li>
                                                                        <li class="menu-item " aria-haspopup="true">
                                            <a href="app/index/pegawai_assesment" class="menu-link">
                                                <i class="menu-bullet menu-bullet-line">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Riwayat Assesment</span>
                                            </a>
                                        </li>
                                                                        <li class="menu-item " aria-haspopup="true">
                                            <a href="app/index/pegawai_penghargaan" class="menu-link">
                                                <i class="menu-bullet menu-bullet-line">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Riwayat Penghargaan</span>
                                            </a>
                                        </li>
                                                                                    
                                                </ul>
                                            </div>
                                        </li>
                                        <? */ ?>
                                        

                                    </ul>

                                    <? /* ?>
                                <ul class="menu-nav" style="display: none;">

                                    <?
                                    function getMenuByParent($id_induk, $arrMenu, $tempParentNama, $formulaid, $rencanasuksesiid, $pg, $reqPegawaiHard)
                                    {
                                        $arrayKey= [];
                                        $arrayKey= in_array_column($id_induk, "MENU_PARENT_ID", $arrMenu);
                                        if(!empty($arrayKey))
                                        {
                                            for($index_detil=0; $index_detil < count($arrayKey); $index_detil++)
                                            {
                                                $index_row= $arrayKey[$index_detil];
                                                $tempMenuId= $arrMenu[$index_row]["MENU_ID"];
                                                $arrMenu[$index_row]["MENU_PARENT_ID"];
                                                $tempNama= $arrMenu[$index_row]["NAMA"];
                                                $tempLinkFile= $arrMenu[$index_row]["LINK_FILE"];
                                                $tempAkses= $arrMenu[$index_row]["AKSES"];
                                                $tempJumlahChild= $arrMenu[$index_row]["JUMLAH_CHILD"];
                                                $tempJumlahMenu= $arrMenu[$index_row]["JUMLAH_MENU"];
                                                $tempJumlahDisable= $arrMenu[$index_row]["JUMLAH_DISABLE"];
                                                $tempInfoNama= $tempParentNama.";".$tempNama;

                                                $menuopen= "";
                                                if($pg == $tempLinkFile)
                                                    $menuopen= "menu-item-open";

                                                if(!empty($formulaid))
                                                    $tempLinkFile.= "?formulaid=".$formulaid."&reqPegawaiHard=".$reqPegawaiHard;
                                                else if(!empty($rencanasuksesiid))
                                                    $tempLinkFile.= "?rencanasuksesiid=".$rencanasuksesiid;
                                    ?>
                                    <li class="menu-item <?=$menuopen?>" aria-haspopup="true">
                                        <a href="app/index/<?=$tempLinkFile?>" class="menu-link">
                                            <i class="menu-bullet menu-bullet-line">
                                                <span></span>
                                            </i>
                                            <span class="menu-text"><?=$tempNama?></span>
                                        </a>
                                    </li>
                                    <?
                                            }
                                        }
                                    }
                                    ?>

                                    <?
                                    $arrayKey= [];
                                    $arrayKey= in_array_column("0", "MENU_PARENT_ID", $arrMenu);
                                    // print_r($arrayKey);exit;
                                    if(!empty($arrayKey))
                                    {
                                        for($index_detil=0; $index_detil < count($arrayKey); $index_detil++)
                                        {
                                            $index_row= $arrayKey[$index_detil];
                                            $tempMenuId= $arrMenu[$index_row]["MENU_ID"];
                                            $arrMenu[$index_row]["MENU_PARENT_ID"];
                                            $tempNama= $arrMenu[$index_row]["NAMA"];
                                            $tempLinkFile= $arrMenu[$index_row]["LINK_FILE"];
                                            $tempAkses= $arrMenu[$index_row]["AKSES"];
                                            $tempJumlahChild= $arrMenu[$index_row]["JUMLAH_CHILD"];
                                            $tempJumlahMenu= $arrMenu[$index_row]["JUMLAH_MENU"];
                                            $tempJumlahDisable= $arrMenu[$index_row]["JUMLAH_DISABLE"];

                                            $menuopen= "";
                                            // if($index_detil == 0 && $pg == "home")
                                            if($tempMenuId == $arrcarimenuparent)
                                                $menuopen= "menu-item-open";

                                            // .$menuopen.$pg
                                            // $arrayKey= in_array_column($id_induk, "MENU_PARENT_ID", $arrMenu);
                                    ?>
                                    <li class="menu-item menu-item-submenu <?=$menuopen?> menu-item-here" aria-haspopup="true" data-menu-toggle="hover">

                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <span class="menu-text"><?=$tempNama?></span>
                                            <i class="menu-arrow"></i>
                                            <!-- <i class="fa fa-address-book" aria-hidden="true"></i> -->
                                        </a>
                                        <div class="menu-submenu">
                                            <i class="menu-arrow"></i>
                                            <ul class="menu-subnav">
                                                <li class="menu-item menu-item-parent" aria-haspopup="true">
                                                    <span class="menu-link">
                                                        <span class="menu-text"><?=$tempNama?></span>
                                                    </span>
                                                </li>

                                                <?
                                                if($tempJumlahChild > 0)
                                                {
                                                    getMenuByParent($tempMenuId, $arrMenu, $tempNama, $formulaid, $rencanasuksesiid, $pg, $reqPegawaiHard);
                                                ?>
                                                <?
                                                }
                                                ?>

                                            </ul>
                                        </div>
                                    </li>
                                    <?
                                        }
                                    }
                                    ?>
                                </ul>
                                <? */ ?>
                                <!--end::Menu Nav-->
                            </div>
                            <!--end::Menu Container-->
                        </div>
                        <!--end::Aside Menu-->
                    <?}?>
                </div>
                <? } ?>
                <!--end::Aside-->
                <!--begin::Wrapper-->
                <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper" <? if($pg == "login"){ ?> style="padding-left: 0px;"<? } ?>>
                    

                    <div id="kt_header" class="header header-fixed">
                        <div class="container-fluid d-flex align-items-stretch justify-content-between">
                            <div class="logo-header"><img src="images/logo-aplikasi-hide.png" height="70"></div>
                            <?
                            if($pg == "login"){} else { 
                            ?>
                            <!-- <div class="area-pencarian-header">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                <input type="text" class="form-control" placeholder="Pencarian Nama Pegawai">
                            </div> -->
                            <? } ?>
                            

                            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                                <?
                                // echo $pg ;
                                if($pg == "pegawai_data_fip"){ 
                                ?>
                                <div class="area-menu-fip">
                                    <nav class="navbar navbar-default">
                                        <div class="container-fluid">
                                            <div class="navbar-header">
                                                <button type="button" class="navbar-toggle collapsed btn btn-warning" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i class="fa fa-id-card" aria-hidden="true"></i> <span>Menu&nbsp;FIP</span>
                                                    <span class="sr-only">Toggle navigation</span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                </button>
                                            </div>
                                            <div id="navbar" class="navbar-collapse collapse">

                                                <div class="panel-group" id="accordion">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">FIP 01</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse1" class="panel-collapse collapse in">
                                                            <div class="panel-body">
                                                                <ul class="nav navbar-nav">
                                                                    <li><a href="#">Lokasi Kerja</a></li>
                                                                    <li><a href="#">Identitas Pegawai</a></li>
                                                                    <li><a href="#">Pengalaman Kerja</a></li>
                                                                    <li><a href="#">SK PNS</a></li>
                                                                    <li><a href="#">SK CPNS</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">FIP 02</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse2" class="panel-collapse collapse">
                                                            <div class="panel-body">
                                                                <ul class="nav navbar-nav">
                                                                    <li><a href="#">Riwayat Pangkat</a></li>
                                                                    <li><a href="#">Riwayat Jabatan</a></li>
                                                                    <li><a href="#">Riwayat Tugas Tambahan</a></li>
                                                                    <li><a href="#">Riwayat Gaji</a></li>
                                                                    <li><a href="#">Pendidikan Umum</a></li>
                                                                    <li><a href="#">Pelatihan Kepemimpinan</a></li>
                                                                    <li><a href="#">Pelatihan Fungsional</a></li>
                                                                    <li><a href="#">Diklat Lpj</a></li>
                                                                    <li><a href="#">Pelatihan Teknis</a></li>
                                                                    <li><a href="#">Seminar/Workshop</a></li>
                                                                    <li><a href="#">Pelatihan Non Klasikal</a></li>
                                                                    <li><a href="#">Orang Tua</a></li>
                                                                    <li><a href="#">Mertua</a></li>
                                                                    <li><a href="#">Suami Istri</a></li>
                                                                    <li><a href="#">Anak</a></li>
                                                                    <li><a href="#">Saudara</a></li>
                                                                    <li><a href="#">Organisasi</a></li>
                                                                    <li><a href="#">Penghargaan</a></li>
                                                                    <li><a href="#">Penilaian Potensi Diri</a></li>
                                                                    <li><a href="#">Catatan Prestasi</a></li>
                                                                    <li><a href="#">Hukuman</a></li>
                                                                    <li><a href="#">Cuti</a></li>
                                                                    <li><a href="#">Tambahan Masa Kerja</a></li>
                                                                    <li><a href="#">Ijin Belajar</a></li>
                                                                    <li><a href="#">Sertifikat Pendidik</a></li>
                                                                    <li><a href="#">Sertifikat Profesi</a></li>
                                                                    <li><a href="#">P.A.K</a></li>
                                                                    <li><a href="#">SKP</a></li>
                                                                    <li><a href="#">Kinerja</a></li>
                                                                    <li><a href="#">Komparasi Data SIMPEG & SIASN</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </nav>    
                                </div>
                                <? } ?>
                                <div class="header-menu header-menu-mobile header-menu-layout-default"></div>
                            </div>
                            <?
                            if($pg == "login"){} else { 
                            ?>
                            
                            <div class="topbar">
                                <div class="topbar-item">
                                    <div class="xxxtes btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                                        <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1"></span>
                                        <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"><?=$reqNama?></span>
                                        <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                                            <span class="symbol-label font-size-h5 font-weight-bold">
                                            <!--     <?=$reqLogo?> -->
                                                <i class="fa fa-user" aria-hidden="true" style="color: #FFFFFF;"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <? } ?>
                        </div>
                    </div>

                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="background: url(images/bg-login.jpg); background-size: 100% 100%; padding-bottom: 0px;">
                        <?=$content?>
                    </div>
                    <!--end::Content-->
                    <!--begin::Footer-->
                    <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
                        <!--begin::Container-->
                        <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <!--begin::Copyright-->
                            <div class="text-dark order-2 order-md-1">
                                <span class="text-muted font-weight-bold mr-2">© 2024</span>
                                <a class="text-dark-75 text-hover-primary">Pemerintah Kabupaten Mojokerto</a>
                            </div>
                            <!--end::Copyright-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
        <!--end::Main-->

        <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
            <!--begin::Header-->
            <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
                <h3 class="font-weight-bold m-0">User Profile
                <small class="text-muted font-size-sm ml-2"></small></h3>
                <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
                    <i class="ki ki-close icon-xs text-muted"></i>
                </a>
            </div>
            <!--end::Header-->
            <!--begin::Content-->
            <div class="offcanvas-content pr-5 mr-n5">
                <!--begin::Header-->
                <div class="d-flex align-items-center mt-5">
                    <div class="symbol symbol-100 mr-5">
                        <? 
                        $file_name_direktori ='C:\xampp\htdocs\simpeg_v2\uploads\pegawai\FOTO_BLOB-'.$reqPegawaiId.'.jpg';
						$file_name_url= 'http://220.247.172.178:7179/simpeg_v2/uploads/pegawai/FOTO_BLOB-'.$reqPegawaiId.'.jpg';
                        if (file_exists($file_name_direktori)) 
                        {
                            ?>
                            <img src="\simpeg_v2\uploads\pegawai\FOTO_BLOB-<?=$reqPegawaiId?>.jpg" alt="image" />
                            <? 
                        }
                        else
                        {
                            ?>
                            <div class="symbol-label" style="background-image:url('assets/media/users/blank.png')"></div>
                            <?
                        }
                        ?>
                        <i class="symbol-badge bg-success"></i>
                    </div>
                    <div class="d-flex flex-column">
                        <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?=$reqNama?></a>
                        <div class="text-muted mt-1"><?=$reqSatker?></div>
                        <div class="navi mt-2">
                            <a href="#" class="navi-item">
                                <span class="navi-link p-0 pb-2">
                                    <span class="navi-icon mr-1">
                                        <span class="svg-icon svg-icon-lg svg-icon-primary">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
                                                    <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <span class="navi-text text-muted text-hover-primary"><?=$reqEmail?></span>
                                </span>
                            </a>
                            <?
                            if(!empty($reqPegawaiId))
                            {
                                if(!empty($userpegawaimode) && !empty($adminuserid)){}
                                else
                                {
                            ?>
                            <a href="app/logout" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>
                            <?
                                }
                            }
                            else
                            {
                            ?>
                            <a href="javascript:void(0);" onclick="setkembali()" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Kembali</a>
                            <?  
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Separator-->
                <div class="separator separator-dashed mt-8 mb-5"></div>
                <!--end::Separator-->
                <!--begin::Nav-->
                <div class="navi navi-spacer-x-0 p-0">
                    <!--begin::Item-->
                    <a class="navi-item">
                        <div class="navi-link">
                            <div class="navi-text">
                                <div class="font-weight-bold">My Profile</div>
                                <div class="text-muted">Account settings and more
                            </div>
                        </div>
                    </a>
                    <!--end:Item-->
                </div>
                <!--end::Nav-->
            </div>
            <!--end::Content-->
        </div>
        <!-- end::User Panel-->

        <?
        if(!empty($reqPegawaiId))
        {
        ?> 
        <script type="text/javascript">
            function setkembali()
            {
                $.ajax({
                    url: "admin/unsetpegawai",
                    processData: false,
                    contentType: false,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        // console.log(response); return false;
                        document.location.href = "admin/index";
                    },
                    error: function(xhr, status, error) {
                        // var err = JSON.parse(xhr.responseText);
                        // Swal.fire("Error", err.message, "error");
                    },
                    complete: function () {
                        KTUtil.btnRelease(formSubmitButton);
                    }
                });
            }
        </script>
        <?
        }
        ?>

    </body>
</html>