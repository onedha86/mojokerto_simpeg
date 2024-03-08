<?php
include_once("functions/date.func.php");
$this->load->model("base-app/Satker");

$reqId= $this->input->get('reqId');
$reqKeterangan= $this->input->get('reqKeterangan');
$reqValidasi= $this->input->get('reqValidasi');
$reqBulan= $this->input->get('reqBulan');
$reqTahun= $this->input->get('reqTahun');
$reqSatuanKerja= $this->input->get('reqSatuanKerja');

$arrdata= array(
    array("label"=>"Group", "field"=> "GROUP_NAMA", "display"=>"1",  "width"=>"")
    , array("label"=>"Satker", "field"=> "SATKER", "display"=>"",  "width"=>"")
    , array("label"=>"Perubahan", "field"=> "FORM_FIP", "display"=>"",  "width"=>"")
    , array("label"=>"Status Proses", "field"=> "TIPE_PERUBAHAN_DATA", "display"=>"",  "width"=>"")
    , array("label"=>"Status Validasi", "field"=> "VALIDASI_INFO", "display"=>"",  "width"=>"")
    , array("label"=>"Tanggal Proses", "field"=> "TANGGAL_PROSES", "display"=>"",  "width"=>"")
    , array("label"=>"Tanggal Validasi", "field"=> "TANGGAL_VALIDASI", "display"=>"",  "width"=>"")
    // untuk dua ini kunci, data akhir id, data sebelum akhir untuk order
    , array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"")
    , array("label"=>"fieldid", "field"=> "PEGAWAI_ID", "display"=>"1", "width"=>"")
);

$arrBulan=setBulanLoop();
$arrTahun= setTahunLoop(1,1);

if($reqBulan == "")
    $reqBulan= date("m");
elseif($reqBulan == "x")
    $reqBulan= "";
    
if($reqTahun == "")
    $reqTahun= date("Y");

$tempSatuanKerjaParent= 0;
$satker= new Satker();
$statement= " AND A.SATKER_ID IN  (
                SELECT C.SATKER_ID 
                FROM validasi.anak A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.bahasa A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.cuti A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.diklat_fungsional A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.diklat_struktural A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.diklat_teknis A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.gaji_riwayat A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.hukuman A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.jabatan_riwayat A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.kursus A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.organisasi_riwayat A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.pangkat_riwayat A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.penataran A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.pendidikan_riwayat A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.pengalaman A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.penghargaan A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.penilaian A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.potensi_diri A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.prestasi_kerja A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.saudara A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.seminar A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.sk_cpns A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.sk_pns A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.tambahan_masa_kerja A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.suami_istri A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.orang_tua A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.mertua A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.tugas A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                UNION ALL
                SELECT C.SATKER_ID 
                FROM validasi.PEGAWAI A
                INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
                INNER JOIN SATKER C ON SUBSTR(B.SATKER_ID, 1, 2) = C.SATKER_ID 
                WHERE A.VALIDASI IS NULL GROUP BY C.SATKER_ID
                )";
$satker->selectByParams(array("SATKER_ID_PARENT"=>$tempSatuanKerjaParent),-1,-1, $statement);
// echo $satker->query;exit;

$arr_json = array();
// if($reqMode == "filter")
// {
    $arr_json[0]['id'] = "-1";
    $arr_json[0]['text'] = "Semua Satker";
    $i = 1;
// }
// else
//     $i = 0;

function getChild($id)
{
    $satker= new Satker();
    $satker->selectByParams(array('SATKER_ID_PARENT' => $id), -1, -1);
    
    $arr_json = array();
    $j=0;
    while($satker->nextRow())
    {
        $arr_json[$j]['id'] = $satker->getField("SATKER_ID");
        $arr_json[$j]['text'] = $satker->getField("NAMA");
        
        $set= new Satker();
        $record= $set->getCountByParams(array('SATKER_ID_PARENT' => $satker->getField("SATKER_ID")));
        unset($set);
        
        if($record > 0)
            $arr_json[$j]['children'] = getChild($satker->getField("SATKER_ID"));
            
        $j++;
    }
    return $arr_json;
}

while($satker->nextRow())
{
    $arr_json[$i]['id'] = $satker->getField("satker_id");
    $arr_json[$i]['text'] = $satker->getField("nama");
    //$arr_json[$i]['children'] = getChild($satker->getField("SATKER_ID"));
    $i++;
}
// print_r($arr_json);exit;
?>
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Menu</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Data Validator</a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>

<div class="d-flex flex-column-fluid">
    <div class="container">

        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-notepad text-primary"></i>
                    </span>
                    <h3 class="card-label">Validator</h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline mr-2">
                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="svg-icon svg-icon-md"></span>Aksi
                        </button>

                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <ul class="navi flex-column navi-hover py-2">
                                <li class="navi-item">
                                    <a id="btnUbahData" class="navi-link">
                                        <span class="navi-icon"><i class="la la-edit"></i></span>
                                        <span class="navi-text">Lihat Perubahan</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-body">

                <div class="mb-15">
                    <div class="row mb-8">
                        <div class="col-lg-3 mb-lg-0 mb-6">
                            <label>Status:</label>
                            <select name="reqValidasi" id="reqValidasi" class="form-control datatable-input">
                                <option value="" <? if($reqValidasi == "") echo "selected";?>>Belum divalidasi</option>
                                <option value="0" <? if($reqValidasi == "0") echo "selected";?>>Ditolak</option>
                                <option value="1" <? if($reqValidasi == "1") echo "selected";?>>Validasi</option>
                            </select>
                        </div>
                        <div class="col-lg-3 mb-lg-0 mb-4">
                            <label>Bulan:</label>
                            <select name="reqBulan" id="reqBulan" class="form-control datatable-input">
                                <option value="x">Semua</option>
                                <?
                                for($i=0;$i<count($arrBulan);$i++)
                                {
                                ?>
                                   <option value="<?=$arrBulan[$i]?>" <? if(generateZeroDate($reqBulan, 2) == $arrBulan[$i]) { ?> selected <? } ?>><?=getNameMonth($arrBulan[$i])?></option>
                                <?    
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-3 mb-lg-0 mb-4">
                            <label>&nbsp;</label>
                            <select name="reqTahun" id="reqTahun" class="form-control datatable-input">
                                <option value="x">Semua</option>
                                <?
                                for($tahun=0;$tahun < count($arrTahun);$tahun++)
                                {
                                ?>
                                <option value="<?=$arrTahun[$tahun]?>" <? if($reqTahun == $arrTahun[$tahun]) echo "selected";?>><?=$arrTahun[$tahun]?></option>
                                <?
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-8">
                        <div class="col-lg-12 mb-lg-0 mb-6">
                            <label>Satuan Kerja:</label>
                            <select name="reqSatuanKerja" id="reqSatuanKerja" class="form-control datatable-input">
                                <?
                                for($i=0; $i < count($arr_json); $i++)
                                {
                                    $infoid= $arr_json[$i]['id'];
                                    $infotext= $arr_json[$i]['text'];
                                ?>
                                <option value="<?=$infoid?>" <? if($infoid == $reqSatuanKerja) echo "selected";?>><?=$infotext?></option>
                                <?
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                    <thead>
                        <tr>
                            <?php
                            foreach($arrdata as $valkey => $valitem) 
                            {
                                echo "<th>".$valitem["label"]."</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
</div>

<!-- <link href="https://cdn.datatables.net/rowgroup/1.0.2/css/rowGroup.dataTables.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.datatables.net/rowgroup/1.0.2/js/dataTables.rowGroup.min.js"></script> -->
    
<a href="#" id="triggercari" style="display:none" title="triggercari">triggercari</a>
<script type="text/javascript">
var datanewtable;
var infotableid= "kt_datatable";
var carijenis= jsonurl= "";
var arrdata= <?php echo json_encode($arrdata); ?>;
var indexfieldid= arrdata.length - 1;
var valinfoid = '';
function popupnew(url, width, height) {
    var leftPosition, topPosition;
    //Allow for borders.
    leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
    //Allow for title and status bars.
    topPosition = (window.screen.height / 2) - ((height / 2) + 50);
    //Open the window.
    window.open(url, "Window2",
    "status=no,height=" + height + ",width=" + width + ",resizable=yes,left="
    + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY="
    + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no");
}

jQuery(document).ready(function() {
    $("#reqSatuanKerja,#reqValidasi,#reqBulan,#reqTahun").change(function() {
      var reqSatuanKerja= $("#reqSatuanKerja").val();
      var cari = ''; //$('div.dataTables_filter input').val();
      var reqBulan= $("#reqBulan").val();
      var reqTahun= $("#reqTahun").val();
      var reqValidasi= $("#reqValidasi").val();

      jsonurl= "json-admin/validator_json/json?reqBulan="+reqBulan+"&reqTahun="+reqTahun+"&reqValidasi="+reqValidasi+"&reqSatuanKerja="+reqSatuanKerja;
      // datanewtable.DataTable().filter.reqValidasi = 1;
      // datanewtable.DataTable().draw();
      datanewtable.DataTable().ajax.url(jsonurl).load();

      // document.location.href = "admin/index/validator.php?reqBulan="+bulan+'&reqTahun='+tahun+"&reqValidasi="+$("#reqValidasi").val()+"&reqSatuanKerja="+satuanKerja;
    });

    jsonurl= "json-admin/validator_json/json?reqBulan=<?=$reqBulan?>&reqTahun=<?=$reqTahun?>&reqValidasi=<?=$reqValidasi?>&reqSatuanKerja=<?=$reqSatuanKerja?>";
    ajaxserverselectsingle.init(infotableid, jsonurl, arrdata, 1);

    var infoid= [];
    $('#'+infotableid+' tbody').on( 'click', 'tr', function () {
        // untuk pilih satu data, kalau untuk multi comman saja
        $('#'+infotableid+' tbody tr').removeClass('selected');

        var el= $(this);
        el.addClass('selected');

        var dataselected= datanewtable.DataTable().row(this).data();
        // console.log(dataselected);
        // console.log(Object.keys(dataselected).length);

        fieldinfoid= arrdata[indexfieldid]["field"];
        if(typeof dataselected == 'undefined')
        {
            valinfoid= "";
        }
        else
        {
            valinfoid= dataselected[fieldinfoid];
        }

        if (valinfoid == null)
        {
            valinfoid = '';
        }
    });

    $("#btnAdd,#btnUbahData").on("click", function () {
        btnid= $(this).attr('id');

        // var infourl= "admin/index/master_user_group_add";
        if(btnid == "btnAdd"){}
        else
        {
            if(valinfoid == "")
            {
                Swal.fire({
                    text: "Pilih salah satu data terlebih dahulu.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                });
                return false;
            }

            // infourl= infourl+"?reqId="+valinfoid;
        }
        // console.log(valinfoid);

        $.ajax({
            url: "admin/setpegawai?reqId="+valinfoid,
            processData: false,
            contentType: false,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                // console.log(response); return false;
                // document.location.href = "app/index";
                popupnew('app/index', 1000, 700);
            },
            error: function(xhr, status, error) {
                // var err = JSON.parse(xhr.responseText);
                // Swal.fire("Error", err.message, "error");
            },
            complete: function () {
                KTUtil.btnRelease(formSubmitButton);
            }
        });

        // window.location.href = infourl;
    });
    
    $('#'+infotableid+' tbody').on( 'dblclick', 'tr', function () {
      $("#btnUbahData").click();    
    });

    $("#buttoncaridetil").on("click", function () {
        carijenis= "2";
        calltriggercari();
    });

    $("#triggercari").on("click", function () {
        // kt_tree_6= $("#kt_tree_6").jstree().get_selected("id")[0];
        // console.log(kt_tree_6);return false;

        if(carijenis == "1")
        {
            pencarian= $('#'+infotableid+'_filter input').val();
            datanewtable.DataTable().search( pencarian ).draw();
        }
        else
        {
            
        }
    });

});

function calltriggercari()
{
    $(document).ready( function () {
      $("#triggercari").click();      
    });
}

</script>