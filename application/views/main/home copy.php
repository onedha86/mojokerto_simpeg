<?
include_once("functions/personal.func.php");

$this->load->model("base-data/InfoData");

$reqPegawaiId= $this->pegawaiId;
$reqSatkerId= $this->input->get('reqSatkerId');

$set= new InfoData();
$set->selectbyparamspegawai(array("A.PEGAWAI_ID"=>$reqPegawaiId),-1,-1);
// echo $set->query;exit;
$set->firstRow();
$reqNIPBaru= $set->getField('NIP_BARU');
$reqNama= $set->getField('NAMA');
$reqEmail= $set->getField('EMAIL');
$reqAlamat= $set->getField('ALAMAT');
$reqPangkatTerkahir= $set->getField('PANGKAT_KODE')." (".$set->getField('PANGKAT_NAMA').")";
$reqTmtPangkat= getFormattedDateTime($set->getField('LAST_TMT_PANGKAT'), false);
$reqJabatanTerkahir= $set->getField('LAST_JABATAN');
$reqTmtJabatan= getFormattedDateTime($set->getField('LAST_TMT_JABATAN'), false);

$reqGelarDepan= $set->getField('GELAR_DEPAN');
$reqGelarBelakang= $set->getField('GELAR_BELAKANG');
$reqJurusanTerkahir= $set->getField('JURUSAN');
$reqSatker= $set->getField('NMSATKER');

$set= new InfoData();
$set->selectbyparamspendidikan(array("A.PEGAWAI_ID"=>$reqPegawaiId),-1,-1);
// echo $set->query;exit;
$set->firstRow();
$reqPendidikanTerkahir= $set->getField('PENDIDIKAN_NAMA');
$reqTahunLulus= $set->getField('TAHUN');
?>
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5">Homehaiii</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                  
                </ul>
            </div>
        </div>
    </div>
</div>

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom gutter-b" style="background: rgba(255,255,255,0.9);">
            <div class="card-body">
                <!-- <div class="mb-3">
                    test
                </div>
                <div class="mb-7">
                    test
                </div> -->
                
                <!--begin::Details-->
                <div class="d-flex mb-9">
                    <!--begin: Pic-->
                    <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                        <div class="symbol symbol-50 symbol-lg-120">
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
                        </div>
                        <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                            <span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin::Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex justify-content-between flex-wrap mt-1">
                            <div class="d-flex mr-3">
                                <a href="#" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3"><?=$reqGelarDepan?> <?=$reqNama?> <?=$reqGelarBelakang?></a>
                                <a href="#">
                                    <i class="flaticon2-correct text-success font-size-h5"></i>
                                </a>
                            </div>
                        </div>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <div class="d-flex flex-wrap justify-content-between mt-1">
                            <div class="d-flex flex-column flex-grow-1 pr-8">
                                <div class="d-flex flex-wrap mb-4">
                                    <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                        <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i><?=$reqNIPBaru?>
                                    </a>
                                    <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                        <i class="flaticon2-new-email mr-2 font-size-lg"></i><?=$reqEmail?>
                                    </a>
                                    <a href="#" class="text-dark-50 text-hover-primary font-weight-bold">
                                        <i class="flaticon2-placeholder mr-2 font-size-lg"></i>
                                        <?=$reqAlamat?>
                                    </a>
                                </div>
                                <!-- <span class="font-weight-bold text-dark-50"><?=$reqSatker?></span> -->
                            </div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Details-->
                <div class="separator separator-solid"></div>
                <!--begin::Items-->
                <div class="d-flex align-items-center flex-wrap mt-8" style="border: 1px solid rgba(0,0,0,0.1); border-radius: 4px; background: #FFFFFF; padding: 15px;">
                    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                        <span class="mr-4">
                            <i class="flaticon-confetti display-4 text-muted font-weight-bold"></i>
                        </span>
                        <div class="d-flex flex-column text-dark-75">
                            <span class="font-weight-bolder font-size-sm">Pangkat Terakhir</span>
                            <span class="font-weight-bolder font-size-h5">
                                <span class="text-dark-50 font-weight-bold">
                                    <?=$reqPangkatTerkahir?>
                                </span>
                                <br/>TMT : <?=$reqTmtPangkat?>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                        <span class="mr-4">
                            <i class="flaticon-file-2 display-4 text-muted font-weight-bold"></i>
                        </span>
                        <div class="d-flex flex-column flex-lg-fill">
                            <span class="font-weight-bolder font-size-sm">Pendidikan Terakhir</span>
                            <span class="font-weight-bolder font-size-h5">
                                <span class="text-dark-50 font-weight-bold">
                                    <?=$reqPendidikanTerkahir?>
                                </span>
                                <br/>Tahun Lulus : <?=$reqTahunLulus ?>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                        <span class="mr-4">
                            <i class="flaticon-confetti display-4 text-muted font-weight-bold"></i>
                        </span>
                        <div class="d-flex flex-column text-dark-75">
                            <span class="font-weight-bolder font-size-sm">Jabatan Terakhir</span>
                            <span class="font-weight-bolder font-size-h5">
                                <span class="text-dark-50 font-weight-bold">
                                <?=$reqJabatanTerkahir?> 
                                </span>
                                <br/>TMT : <?=$reqTmtJabatan?>
                            </span>
                        </div>
                    </div>
                </div>
                <!--begin::Items-->
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->