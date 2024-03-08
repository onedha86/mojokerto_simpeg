<?
include_once("functions/personal.func.php");

$this->load->model("base-data/InfoData");
$this->load->model("base-data/FormulaPenilaian");
$this->load->library('globalmenu');

$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;

if(!empty($userpegawaimode) && !empty($adminuserid))
    $reqPegawaiId= $userpegawaimode;
else
    $reqPegawaiId= $this->pegawaiId;

$set= new InfoData();
$set->selectbyparamspegawai(array("A.PEGAWAI_ID"=>$reqPegawaiId),-1,-1);
// echo $set->query;exit;
$set->firstRow();
$reqNipBaru= $set->getField('NIP_BARU');
$reqNama= $set->getField('NAMA');
$reqEmail= $set->getField('EMAIL');
$reqAlamat= $set->getField('ALAMAT');
$reqPangkatTerkahir= $set->getField('PANGKAT_KODE')." (".$set->getField('PANGKAT_NAMA').")";
$reqTmtPangkat= getFormattedDateTime($set->getField('LAST_TMT_PANGKAT'), false);
$reqJabatanTerkahir= $set->getField('LAST_JABATAN');
$reqJabatanEselonId= $set->getField('LAST_ESELON_ID');
$reqJabatanEselon= $set->getField('ESELON_NAMA');
$reqJabatanTipePegawai= $set->getField('TIPE_PEGAWAI_NAMA');
$reqTmtJabatan= getFormattedDateTime($set->getField('LAST_TMT_JABATAN'), false);
$reqJenjangNama= $set->getField('JENJANG_NAMA');

$reqMode="update";
// $reqMode="insert";
$readonly = "readonly";

// ------------------
$reqId= $this->input->get("rencanasuksesiid");

$statement= " AND A.PEGAWAI_ID = ".$reqPegawaiId." AND RSP.RENCANA_SUKSESI_ID = ".$reqId;
$set= new InfoData();
$set->selectbyparamsrencanasuksesipegawai(array(), -1, -1, $statement);
// echo $set->query;exit;
$set->firstRow();
$kodekuadran= $set->getField("KODE_KUADRAN");
$penilaianid= $set->getField("PENILAIAN_ID");
// echo $penilaianid;exit;
// echo $kodekuadran;exit;
if(empty($penilaianid))
	$penilaianid= -1;

$statement= "
AND A.FORMULA_PENILAIAN_ID IN
(
	SELECT INFOVAL::NUMERIC FROM data.rencana_suksesi_detil A
	WHERE RENCANA_SUKSESI_ID = ".$reqId." AND INFOKEY = 'formulaid'
)";
$set= new FormulaPenilaian();
$set->selectbyparamsformulapenilaiannineboxstandart(array(), -1,-1, $statement);
$set->firstRow();
// echo $set->query;exit;
$reqSkpX0= $set->getField("SKP_X0");
$reqSkpY0= $set->getField("SKP_Y0");
$reqGmX0= $set->getField("GM_X0");
$reqGmY0= $set->getField("GM_Y0");
$reqSkpX1= $set->getField("SKP_X1");
$reqSkpY1= $reqSkpX0+1;
$reqGmX1= $set->getField("GM_X1");
$reqGmY1= $set->getField("GM_Y1");
$reqSkpX2= $set->getField("SKP_X2");
$reqSkpY2= $reqSkpX1+1;
$reqGmX2= $set->getField("GM_X2");
$reqGmY2= $set->getField("GM_Y2");

if($reqSkpY0 == "") $reqSkpY0= 0;
if($reqGmX0 == "") $reqGmX0= 0;
if($reqSkpY1 == "") $reqSkpY1= 0;
if($reqGmX1 == "") $reqGmX1= 0;
if($reqSkpY2 == "") $reqSkpY2= 0;
if($reqGmX2 == "") $reqGmX2= 0;

$jadwaltesid= -1;
$arrDataPotensi= [];
$arrDataKompetensi= [];
$statement=" AND B.PEGAWAI_ID = ".$reqPegawaiId." AND B.PENILAIAN_ID IN (".$penilaianid.")";
$arrDataPotensi= array();
$index= 0;
$set= new InfoData();
$set->selectspiderpotensikompetensi(array(), -1, -1, $statement);
// echo $set->query;exit;
while($set->nextRow())
{
	$aspekid= $set->getField("ASPEK_ID");
	$jadwaltesid= $set->getField("JADWAL_TES_ID");

	$arrdata= [];
	$arrdata["NAMA"]= $set->getField("NAMA");
	$arrdata["NILAI"]= $set->getField("NILAI");
	$arrdata["NILAI_STANDAR"]= $set->getField("NILAI_STANDAR");

	if($aspekid == "1")
	{
		$jumlahDataPotensi++;
		array_push($arrDataPotensi, $arrdata);
	}
	else if($aspekid == "2")
	{
		$jumlahDataKompetensi++;
		array_push($arrDataKompetensi, $arrdata);
	}
}
// $jumlahDataPotensi= $index;
// print_r($arrDataPotensi);exit;
// print_r($arrDataKompetensi);exit;

// DESKRIPSI
$statement= " AND A.PEGAWAI_ID = ".$reqPegawaiId." AND A.JADWAL_TES_ID = ".$jadwaltesid;
$set= new InfoData();
$set->selectpenilaianrekomendasi(array(), -1,-1, $statement);
// echo $set->query;exit();
$set->firstRow();
$saranpengembangan= $set->getField("KETERANGAN");
// echo $saranpengembangan;exit;
if(empty($saranpengembangan) || $saranpengembangan == "<br>")
	$saranpengembangan= "Tidak ada";
?>
<style type="text/css">
	   select[readonly].select2-hidden-accessible + .select2-container {
        pointer-events: none;
        touch-action: none;
    }

    select[readonly].select2-hidden-accessible + .select2-container .select2-selection {
        background: #F3F6F9;
        box-shadow: none;
    }

    select[readonly].select2-hidden-accessible + .select2-container .select2-selection__arrow, select[readonly].select2-hidden-accessible + .select2-container .select2-selection__clear {
        display: none;
    }

</style>

<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<div class="d-flex align-items-center flex-wrap mr-1">
			<div class="d-flex align-items-baseline flex-wrap mr-5">
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item text-muted">
						<a class="text-muted">Data Pegawai</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a class="text-muted">Informasi Pegawai</a>
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
                    <h3 class="card-label">Informasi Pegawai</h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
	        	<div class="card-body">
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">NIP</label>
	        			<label class="col-form-label col-lg-10 col-sm-12"><?=$reqNipBaru?></label>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Nama</label>
	        			<label class="col-form-label col-lg-10 col-sm-12"><?=$reqNama?></label>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Pangkat/Gol</label>
	        			<label class="col-form-label col-lg-10 col-sm-12"><?=$reqPangkatTerkahir?></label>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Jabatan</label>
	        			<label class="col-form-label col-lg-10 col-sm-12"><?=$reqJabatanTerkahir?></label>
	        		</div>
					<?
					if($reqJabatanEselonId !== "99")
					{
					?>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Eselon</label>
	        			<label class="col-form-label col-lg-10 col-sm-12"><?=$reqJabatanEselon?></label>
	        		</div>
	        		<?
	        		}
	        		?>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Jenis Jabatan</label>
	        			<label class="col-form-label col-lg-10 col-sm-12"><?=$reqJabatanTipePegawai?></label>
	        		</div>
	        		<?
	        		if(!empty($reqJenjangNama))
	        		{
	        		?>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Jenjang Jabatan</label>
	        			<label class="col-form-label col-lg-10 col-sm-12"><?=$reqJenjangNama?></label>
	        		</div>
	        		<?
	        		}
	        		?>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Kuadran</label>
	        			<label class="col-form-label col-lg-10 col-sm-12"><?=$kodekuadran?></label>
	        		</div>

	        		<div class="container" style="width: 80%; padding: 0 0;">
						<table style="font-size: 10pt; width: 100%;">
							<tr>
								<td colspan="2" style="width: 100%; text-align: center;">
								<!-- <td style="width: 100%; text-align: center;"> -->
									POSISI QUADRAN TALENT POOL SAAT INI
									<div id="kontenidgrafik" style="width:100%; height: calc(60vh - 10px)"> </div>
				        			<input type="hidden" id="reqInfoSkpY0" value="<?=$reqSkpY0?>" />
				        			<input type="hidden" id="reqInfoSkpX0" value="<?=$reqSkpX0?>" />
				        			<input type="hidden" id="reqInfoGmX0" value="<?=$reqGmX0?>" />
				        			<input type="hidden" id="reqInfoGmY0" value="<?=$reqGmY0?>" />
				        			<input type="hidden" id="reqInfoSkpY1" value="<?=$reqSkpY1?>" />
				        			<input type="hidden" id="reqInfoSkpX1" value="<?=$reqSkpX1?>" />
				        			<input type="hidden" id="reqInfoGmX1" value="<?=$reqGmX1?>" />
				        			<input type="hidden" id="reqInfoGmY1" value="<?=$reqGmY1?>" />
				        			<input type="hidden" id="reqInfoSkpY2" value="<?=$reqSkpY2?>" />
				        			<input type="hidden" id="reqInfoSkpX2" value="<?=$reqSkpX2?>" />
				        			<input type="hidden" id="reqInfoGmX2" value="<?=$reqGmX2?>" />
				        			<input type="hidden" id="reqInfoGmY2" value="<?=$reqGmY2?>" />
								</td>
							</tr>
							<tr>
								<td style="width: 50%; text-align: center;">
								<!-- <td style="width: 100%; text-align: center;"> -->
									GRAFIK GAMBARAN KOMPETENSI SAAT INI
									<div id="containerkompetensi"></div>
								</td>
							<!-- </tr> -->
							<!-- <tr> -->
								<td style="width: 50%; text-align: center;">
								<!-- <td style="width: 100%; text-align: center;"> -->
									GRAFIK GAMBARAN POTENSI SAAT INI
									<div id="containerpotensi"></div>
								</td>
							</tr>
						</table>
					</div>

					<div class="form-group row">
						<h3 class="card-label col-lg-12 col-sm-12">Saran Pengembangan</h3>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label col-lg-12 col-sm-12"><?=$saranpengembangan?></label>
	        		</div>

	        	</div>

	        </form>
        </div>
    </div>
</div>

<script type="text/javascript">

var vgrafik= "potensikompetensisuksesi";
setGrafik("json-data/info_admin_json/formulapenilaiangrafik?pegawaiid=<?=$reqPegawaiId?>&reqId=<?=$reqId?>&m="+vgrafik);

function setModal(target, link_url)
{
    var s_url= link_url;
    var request = $.get(s_url);
    
    request.done(function(msg)
    {
        if(msg == ''){}
        else
        {
            $('#'+target).html(msg);
            // $.messager.progress('close');
        }
    });
}

chartkompetensi = new Highcharts.chart({
	chart: {
		renderTo: 'containerkompetensi',
		polar: true,
		type: 'line'
	},
	
	title: {
		text: '',
		x: -80
	},

	pane: {
		size: '80%'
	},

	xAxis: {
		labels: {
			rotation: 1,
			step: 1
		},
		categories: [
		<?
		for($index_data=0; $index_data < $jumlahDataKompetensi; $index_data++)
		{
			if($index_data > 0)
				echo ",";
		?>
			'<?=$arrDataKompetensi[$index_data]["NAMA"]?>'
		<?
		}
		?>
		],
		tickmarkPlacement: 'on',
		lineWidth: 0
	},

	credits: {
      enabled: false
    },

	yAxis: {
		gridLineInterpolation: 'polygon',
		lineWidth: 0,
		min: 0,
		labels: {
            enabled: false
        }
	},

	tooltip: {
		shared: true,
		pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
	},

	legend: {
		align: 'right',
		verticalAlign: 'middle',
		layout: 'vertical'
	},

	series: [
	{
		name: 'Capaian',
		data: [
		<?
		for($index_data=0; $index_data < $jumlahDataKompetensi; $index_data++)
		{
			if($index_data > 0)
				echo ",";
		?>
			<?=$arrDataKompetensi[$index_data]["NILAI"]?>
		<?
		}
		?>
		],
		pointPlacement: 'on',
		color: "#0F0",
		dataLabels: {
			// inside: true,
			enabled: true
			// , style: {
			// 	color: 'white'
			// }
		}
	}
	, 
	{
		name: 'Nilai Standar',
		data: [
		<?
		for($index_data=0; $index_data < $jumlahDataKompetensi; $index_data++)
		{
			if($index_data > 0)
				echo ",";
		?>
			<?=$arrDataKompetensi[$index_data]["NILAI_STANDAR"]?>
		<?
		}
		?>
		],
		pointPlacement: 'on',
		color: "#FF0000",
		dataLabels: {
			// inside: true,
			enabled: true
			// , style: {
			// 	color: 'white'
			// }
		}
	}
	],

	responsive: {
		rules: [{
			condition: {
				maxWidth: 500
			},
			chartOptions: {
				legend: {
					align: 'center',
					verticalAlign: 'bottom',
					layout: 'horizontal'
				},
				pane: {
					size: '70%'
				}
			}
		}]
	}

});

chartpotensi = new Highcharts.chart({
	chart: {
		renderTo: 'containerpotensi',
		polar: true,
		type: 'line'
	},

	title: {
		text: '',
		x: -80
	},

	pane: {
		size: '80%'
	},

	xAxis: {
		labels: {
			rotation: 1,
			step: 1
		},
		categories: [
		<?
		for($index_data=0; $index_data < $jumlahDataPotensi; $index_data++)
		{
			if($index_data > 0)
				echo ",";
		?>
			'<?=$arrDataPotensi[$index_data]["NAMA"]?>'
		<?
		}
		?>
		],
		tickmarkPlacement: 'on',
		lineWidth: 0
	},

	credits: {
      enabled: false
    },

	yAxis: {
		gridLineInterpolation: 'polygon',
		lineWidth: 0,
		min: 0,
		labels: {
            enabled: false
        }
	},

	tooltip: {
		shared: true,
		pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
	},

	legend: {
		align: 'right',
		verticalAlign: 'middle',
		layout: 'vertical'
	},

	series: [
	{
		name: 'Capaian',
		data: [
		<?
		for($index_data=0; $index_data < $jumlahDataPotensi; $index_data++)
		{
			if($index_data > 0)
				echo ",";
		?>
			<?=$arrDataPotensi[$index_data]["NILAI"]?>
		<?
		}
		?>
		],
		pointPlacement: 'on',
		color: "#0F0",
		dataLabels: {
			// inside: true,
			enabled: true
			// , style: {
			// 	color: 'white'
			// }
		}
	}
	, 
	{
		name: 'Nilai Standar',
		data: [
		<?
		for($index_data=0; $index_data < $jumlahDataPotensi; $index_data++)
		{
			if($index_data > 0)
				echo ",";
		?>
			<?=$arrDataPotensi[$index_data]["NILAI_STANDAR"]?>
		<?
		}
		?>
		],
		pointPlacement: 'on',
		color: "#FF0000",
		dataLabels: {
			// inside: true,
			enabled: true
			// , style: {
			// 	color: 'white'
			// }
		}
	}
	],

	responsive: {
		rules: [{
			condition: {
				maxWidth: 500
			},
			chartOptions: {
				legend: {
					align: 'center',
					verticalAlign: 'bottom',
					layout: 'horizontal'
				},
				pane: {
					size: '70%'
				}
			}
		}]
	}

});

function setGrafik(link_url)
{
    var s_url= link_url;

    //alert(s_url);return false;
    var request = $.get(s_url);
    request.done(function(dataJson)
    {
        if(dataJson == ''){}
        else
        {
            dataValue= JSON.parse(dataJson);
            // console.log(dataValue);

            if(Array.isArray(dataValue) && dataValue.length)
            {
                nilaix= dataValue[0].x.toFixed(2);
                nilaix= nilaix.replace(".00", "");
                nilaiy= parseFloat(dataValue[0].y);
                // nilaiy= parseFloat(nilaiy) - 7;
                nilaiy= nilaiy.toFixed(2);
                nilaiy= nilaiy.replace(".00", "");
            }

            if(dataValue == null){}
            else
            {
                // console.log("xxx");
                // nilaix= dataValue[0].x.toFixed(2);
                // nilaix= nilaix.replace(".00", "");
                // nilaiy= parseFloat(dataValue[0].y);
                // // nilaiy= parseFloat(nilaiy) - 7;
                // nilaiy= nilaiy.toFixed(2);
                // nilaiy= nilaiy.replace(".00", "");
            }

            var reqSkpY0= reqSkpX0= reqGmY0= reqGmX0=
            reqSkpY1= reqSkpX1= reqGmY1= reqGmX1=
            reqSkpY2= reqSkpX2= reqGmY2= reqGmX2= 0;

            reqSkpY0= parseFloat($("#reqInfoSkpY0").val());
            reqSkpX0= parseFloat($("#reqInfoSkpX0").val());
            reqGmY0= parseFloat($("#reqInfoGmY0").val());
            reqGmX0= parseFloat($("#reqInfoGmX0").val());
            reqSkpY1= parseFloat($("#reqInfoSkpY1").val());
            reqSkpX1= parseFloat($("#reqInfoSkpX1").val());
            reqGmY1= parseFloat($("#reqInfoGmY1").val());
            reqGmX1= parseFloat($("#reqInfoGmX1").val());
            reqSkpY2= parseFloat($("#reqInfoSkpY2").val());
            reqSkpX2= parseFloat($("#reqInfoSkpX2").val());
            reqGmY2= parseFloat($("#reqInfoGmY2").val());
            reqGmX2= parseFloat($("#reqInfoGmX2").val());

            chartkuadran = new Highcharts.Chart({
            chart: {
                    renderTo: 'kontenidgrafik',
                },
                exporting: {
                    enabled: false
                },
                credits: {
                    enabled: false
                },
                legend:{
                    enabled:false
                },
                xAxis: {
                    title:{
                         text:'Potensi'
                         , style: {
                            // color: 'white',
                            // fontSize: '15px'
                         }
                    },
                    min: 0,
                    max: reqSkpX2,
                    tickLength:0,
                    minorTickLength:0,
                    gridLineWidth:0,
                    showLastLabel:true,
                    showFirstLabel:false,
                    // lineColor:'#ccc',
                    // lineWidth:1,
                    lineColor:'white',
                    lineWidth:0,
                    bgColor: "#ff0",
                    labels: {
                        style: {
                            // color: 'white',
                            // fontSize: '15px'
                        }
                    },
                },
                yAxis: {
                    title:{
                        text:'Kinerja'
                        , rotation:270
                        , style: {
                            // color: 'white',
                            // fontSize: '15px'
                        }
                    },
                    min: 0,
                    max: reqGmY2,
                    tickLength:3,
                    minorTickLength:0,
                    gridLineWidth:0,
                    // lineColor:'#ccc',
                    // lineWidth:1
                    lineColor:'white',
                    lineWidth:0,
                    labels: {
                        style: {
                            // color: 'white',
                            // fontSize: '15px'
                        }
                    },
                },
                tooltip: {
                    formatter: function() {
                        var s = this.point.myData;
                        return s;
                    }
                },
                title: {
                    text:''
                },
                series: [
                {
                    type: 'line',
                    name: 'SKP Kurang',
                    lineWidth: 0,
                    // borderWidth: 0,
                    data: [[reqSkpX0, reqSkpY0], [reqSkpX0, reqSkpX2]],
                    marker: {
                        enabled: false
                    },
                    states: {
                        hover: {
                            lineWidth: 0
                        }
                    },
                    enableMouseTracking: false
                },
                {
                    type: 'line',
                    name: 'GM Kurang',
                    lineWidth: 0,
                    // borderWidth: 0,
                    data: [[reqGmX0, reqGmY0], [reqGmY2, reqGmY0]],
                    marker: {
                        enabled: false
                    },
                    states: {
                        hover: {
                            lineWidth: 0
                        }
                    },
                    enableMouseTracking: false
                },
                {
                    type: 'line',
                    name: 'SKP Sedang',
                    lineWidth: 0,
                    // borderWidth: 0,
                    data: [[reqSkpX1, reqSkpY1], [reqSkpX1, reqSkpX2]],
                    marker: {
                        enabled: false
                    },
                    states: {
                        hover: {
                            lineWidth: 0
                        }
                    },
                    enableMouseTracking: false
                },
                {
                    type: 'line',
                    name: 'GM Sedang',
                    lineWidth: 0,
                    // borderWidth: 0,
                    data: [[reqGmX1, reqGmY1], [reqGmY2, reqGmY1]],
                    marker: {
                        enabled: false
                    },
                    states: {
                        hover: {
                            lineWidth: 0
                        }
                    },
                    enableMouseTracking: false
                },
                {
                    type: 'line',
                    name: 'SKP Baik',
                    lineWidth: 0,
                    // borderWidth: 0,
                    data: [[reqSkpX2, reqSkpY2], [reqSkpX2, reqSkpX2]],
                    marker: {
                        enabled: false
                    },
                    states: {
                        hover: {
                            lineWidth: 0
                        }
                    },
                    enableMouseTracking: false
                },
                {
                    type: 'line',
                    name: 'GM Baik',
                    lineWidth: 0,
                    // borderWidth: 0,
                    data: [[reqGmX2, reqGmY2], [reqGmY2, reqGmY2]],
                    marker: {
                        enabled: false
                    },
                    states: {
                        hover: {
                            lineWidth: 0
                        }
                    },
                    enableMouseTracking: false
                },
                {
                    type: 'scatter',
                    name: 'Observations',
                    color: 'blue',
                    //data: [[80,80], [40.5,40.5], [60.8,60.8], [53.5,53.5], [63.9,63.9], [90.2,90.2], [95,95]],
                    data: dataValue,
                    marker: {
                        radius: 8
                    }
                }
                ]

                }
                ,
                function(chart) { // on complete
                    var width= chart.plotBox.width;
                    var height= chart.plotBox.height;
                    var tempplotbox= tempplotboy= tempwidth= tempxwidth= tempheight= 0;
                    var modif= 45;
                    var modif= 55;

                    //garis I
                    //=====================================================================================
                    tempwidth1= tempwidth= parseFloat(width) * (parseFloat(reqSkpX0) / reqSkpX2);
                    tempheight1= tempheight= parseFloat(height) * ((reqGmY2 - parseFloat(reqGmY1)) / reqGmY2);
                    tempyheight= chart.plotBox.x + (parseFloat(tempheight) / 3) - modif;
                    tempplotbox= chart.plotBox.x;
                    tempxwidth= tempplotbox + parseFloat(parseFloat(tempwidth) / 2);
                    tempplotboy= chart.plotBox.y;
                    chart.renderer.rect(tempplotbox,tempplotboy, tempwidth, tempheight, 1).attr({
                        fill: '#00b050',
                        zIndex: 0
                    }).add();

                    var text = chart.renderer.text("IV", tempwidth, tempheight).css({
                        fontSize: '14px'
                        // , color: '#666666'
                    }).add();
                    text.attr({
                        x: tempxwidth,
                        y: tempyheight,
                        zIndex:99
                    });
                    //=====================================================================================
                    tempwidth2= tempwidth= parseFloat(width) * ((parseFloat(reqSkpX1) - parseFloat(reqSkpX0)) / reqSkpX2);
                    tempheight= parseFloat(height) * ((reqGmY2 - parseFloat(reqGmY1)) / reqGmY2);
                    tempyheight= chart.plotBox.x + (parseFloat(tempheight) / 3) - modif;
                    tempplotbox= parseFloat(chart.plotBox.x) + parseFloat(tempwidth1);
                    tempxwidth= tempplotbox + parseFloat(parseFloat(tempwidth) / 2);
                    tempplotboy= chart.plotBox.y;
                    chart.renderer.rect(tempplotbox,tempplotboy, tempwidth, tempheight, 1).attr({
                        fill: '#92d050',
                        zIndex: 0
                    }).add();

                    var text = chart.renderer.text("VII", tempwidth, tempheight).css({
                        fontSize: '14px'
                        // , color: '#666666'
                    }).add();
                    text.attr({
                        x: tempxwidth,
                        y: tempyheight,
                        zIndex:99
                    });
                    //=====================================================================================
                    tempwidth= parseFloat(width) * ((reqSkpX2 - parseFloat(reqSkpX1)) / reqSkpX2);
                    tempheight= parseFloat(height) * ((reqGmY2 - parseFloat(reqGmY1)) / reqGmY2);
                    tempyheight= chart.plotBox.x + (parseFloat(tempheight) / 3) - modif;
                    tempplotbox= chart.plotBox.x + parseFloat(tempwidth1) + parseFloat(tempwidth2);
                    tempxwidth= tempplotbox + parseFloat(parseFloat(tempwidth) / 2);
                    tempplotboy= chart.plotBox.y;
                    //alert(tempwidth);
                    chart.renderer.rect(tempplotbox,tempplotboy, tempwidth, tempheight, 1).attr({
                        fill: '#006600',
                        zIndex: 0
                    }).add();

                    var text = chart.renderer.text("IX", tempwidth, tempheight).css({
                        fontSize: '14px'
                        // , color: '#666666'
                    }).add();
                    text.attr({
                        x: tempxwidth,
                        y: tempyheight,
                        zIndex:99
                    });
                    //=====================================================================================

                    //garis II
                    //=====================================================================================
                    tempwidth1= tempwidth= parseFloat(width) * (parseFloat(reqSkpX0) / reqSkpX2);
                    tempheight2= tempheight= parseFloat(height) * ((parseFloat(reqGmY1) - parseFloat(reqGmY0)) / reqGmY2);
                    tempyheight= chart.plotBox.x + (parseFloat(tempheight) / 3) + parseFloat(tempheight1) - modif;
                    tempplotbox= chart.plotBox.x;
                    tempxwidth= tempplotbox + parseFloat(parseFloat(tempwidth) / 2);
                    tempplotboy= chart.plotBox.y + parseFloat(tempheight1);
                    chart.renderer.rect(tempplotbox,tempplotboy, tempwidth, tempheight, 1).attr({
                        fill: '#ffff00',
                        zIndex: 0
                    }).add();

                    var text = chart.renderer.text("II", tempwidth, tempheight).css({
                        fontSize: '14px'
                        // , color: '#666666'
                    }).add();
                    text.attr({
                        x: tempxwidth,
                        y: tempyheight,
                        zIndex:99
                    });
                    //=====================================================================================
                    tempwidth2= tempwidth= parseFloat(width) * ((parseFloat(reqSkpX1) - parseFloat(reqSkpX0)) / reqSkpX2);
                    tempheight= parseFloat(height) * ((parseFloat(reqGmY1) - parseFloat(reqGmY0)) / reqGmY2);
                    tempyheight= chart.plotBox.x + (parseFloat(tempheight) / 3) + parseFloat(tempheight1) - modif;
                    tempplotbox= parseFloat(chart.plotBox.x) + parseFloat(tempwidth1);
                    tempxwidth= tempplotbox + parseFloat(parseFloat(tempwidth) / 2);
                    tempplotboy= chart.plotBox.y + parseFloat(tempheight1);
                    chart.renderer.rect(tempplotbox,tempplotboy, tempwidth, tempheight, 1).attr({
                        fill: '#c4d79b',
                        zIndex: 0
                    }).add();

                    var text = chart.renderer.text("V", tempwidth, tempheight).css({
                        fontSize: '14px'
                        // , color: '#666666'
                    }).add();
                    text.attr({
                        x: tempxwidth,
                        y: tempyheight,
                        zIndex:99
                    });
                    //=====================================================================================
                    tempwidth= parseFloat(width) * ((reqSkpX2 - parseFloat(reqSkpX1)) / reqSkpX2);
                    tempheight= parseFloat(height) * ((parseFloat(reqGmY1) - parseFloat(reqGmY0)) / reqGmY2);
                    tempyheight= chart.plotBox.x + (parseFloat(tempheight) / 3) + parseFloat(tempheight1) - modif;
                    tempplotbox= chart.plotBox.x + parseFloat(tempwidth1) + parseFloat(tempwidth2);
                    tempxwidth= tempplotbox + parseFloat(parseFloat(tempwidth) / 2);
                    tempplotboy= chart.plotBox.y + parseFloat(tempheight1);
                    chart.renderer.rect(tempplotbox,tempplotboy, tempwidth, tempheight, 1).attr({
                        fill: '#92d050',
                        zIndex: 0
                    }).add();

                    var text = chart.renderer.text("VIII", tempwidth, tempheight).css({
                        fontSize: '14px'
                        // , color: '#666666'
                    }).add();
                    text.attr({
                        x: tempxwidth,
                        y: tempyheight,
                        zIndex:99
                    });
                    //=====================================================================================

                    //garis III
                    //=====================================================================================
                    tempwidth1= tempwidth= parseFloat(width) * (parseFloat(reqSkpX0) / reqSkpX2);
                    tempheight3= tempheight= parseFloat(height) * (parseFloat(reqGmY0) / reqGmY2);
                    tempyheight= chart.plotBox.x + (parseFloat(tempheight) / 3) + parseFloat(tempheight1) + parseFloat(tempheight2) - modif;
                    tempplotbox= chart.plotBox.x;
                    tempxwidth= tempplotbox + parseFloat(parseFloat(tempwidth) / 2);
                    tempplotboy= chart.plotBox.y + parseFloat(tempheight1) + parseFloat(tempheight2);
                    chart.renderer.rect(tempplotbox,tempplotboy, tempwidth, tempheight, 1).attr({
                        fill: '#ff0000',
                        zIndex: 0
                    }).add();

                    var text = chart.renderer.text("I", tempwidth, tempheight).css({
                        fontSize: '14px'
                        // , color: '#666666'
                    }).add();
                    text.attr({
                        x: tempxwidth,
                        y: tempyheight,
                        zIndex:99
                    });
                    //=====================================================================================
                    tempwidth2= tempwidth= parseFloat(width) * ((parseFloat(reqSkpX1) - parseFloat(reqSkpX0)) / reqSkpX2);
                    tempheight= parseFloat(height) * (parseFloat(reqGmY0) / reqGmY2);
                    tempyheight= chart.plotBox.x + (parseFloat(tempheight) / 3) + parseFloat(tempheight1) + parseFloat(tempheight2) - modif;
                    tempplotbox= parseFloat(chart.plotBox.x) + parseFloat(tempwidth1);
                    tempxwidth= tempplotbox + parseFloat(parseFloat(tempwidth) / 2);
                    tempplotboy= chart.plotBox.y + parseFloat(tempheight1) + parseFloat(tempheight2);
                    chart.renderer.rect(tempplotbox,tempplotboy, tempwidth, tempheight, 1).attr({
                        fill: '#ffff00',
                        zIndex: 0
                    }).add();

                    var text = chart.renderer.text("III", tempwidth, tempheight).css({
                        fontSize: '14px'
                        // , color: '#666666'
                    }).add();
                    text.attr({
                        x: tempxwidth,
                        y: tempyheight,
                        zIndex:99
                    });
                    //=====================================================================================
                    tempwidth= parseFloat(width) * ((reqSkpX2 - parseFloat(reqSkpX1)) / reqSkpX2);
                    tempheight= parseFloat(height) * (parseFloat(reqGmY0) / reqGmY2);
                    tempyheight= chart.plotBox.x + (parseFloat(tempheight) / 3) + parseFloat(tempheight1) + parseFloat(tempheight2) - modif;
                    tempplotbox= chart.plotBox.x + parseFloat(tempwidth1) + parseFloat(tempwidth2);
                    tempxwidth= tempplotbox + parseFloat(parseFloat(tempwidth) / 2);
                    tempplotboy= chart.plotBox.y + parseFloat(tempheight1) + parseFloat(tempheight2);
                    chart.renderer.rect(tempplotbox,tempplotboy, tempwidth, tempheight, 1).attr({
                        fill: '#00b050',
                        zIndex: 0
                    }).add();

                    var text = chart.renderer.text("VI", tempwidth, tempheight).css({
                        fontSize: '14px'
                        // , color: '#666666'
                    }).add();
                    text.attr({
                        x: tempxwidth,
                        y: tempyheight,
                        zIndex:99
                    });
                    //=====================================================================================

                }

            );

        }

    });
}
</script>

<!-- <button onclick="tes()">tesss</button>
<script>
    function tes() {
        // pageUrl= "app/loadUrl/main/pegawai_data";
        pageUrl= "iframe/index/pegawai_data";
        openAdd(pageUrl);
    }
</script> -->