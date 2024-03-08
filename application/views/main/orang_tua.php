<?
include_once("functions/personal.func.php");

$this->load->model("base-data/InfoData");

$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;

if(!empty($userpegawaimode) && !empty($adminuserid))
    $reqPegawaiId= $userpegawaimode;
else
    $reqPegawaiId= $this->pegawaiId;

// $folder = $this->config->item('simpeg');

/*$set= new InfoData();
$set->selectbyparamspendidikan(array("A.PEGAWAI_ID"=>$reqPegawaiId),-1,-1);
// echo $set->query;exit;
$set->firstRow();
$reqPendidikanTerkahir= $set->getField('PENDIDIKAN_NAMA');
$reqTahunLulus= $set->getField('TAHUN');*/

$set= new InfoData();
$arragama= [];
$set->selectbyagama();
// echo $set->query;exit;
while($set->nextRow())
{
	$arrdata= [];
	$arrdata["id"]= $set->getField("NAMA");
	$arrdata["text"]= $set->getField("NAMA");
	array_push($arragama, $arrdata);
}
unset($set);

$set= new InfoData();
$arrsatuankerja= [];
$set->selectbysatuankerja();
// echo $set->query;exit;
while($set->nextRow())
{
	$arrdata= [];
	$arrdata["id"]= $set->getField("SATKER_ID");
	$arrdata["text"]= $set->getField("NAMA");
	array_push($arrsatuankerja, $arrdata);
}
unset($set);

$set= new InfoData();
$set->selectbyparamspegawai(array("A.PEGAWAI_ID"=>$reqPegawaiId),-1,-1);
// echo $set->query;exit;
$set->firstRow();
$reqNipBaru= $set->getField('NIP_BARU');
$reqNama= $set->getField('NAMA');
$reqEmail= $set->getField('EMAIL');
$reqAlamat= $set->getField('ALAMAT');
$reqPangkatTerkahir= $set->getField('PANGKAT_KODE')." (".$set->getField('PANGKAT_NAMA').")";
$reqTmtPangkat= datetimeTodatePageCheck($set->getField('LAST_TMT_PANGKAT'));
$reqJabatanTerkahir= $set->getField('LAST_JABATAN');
$reqSatker= $set->getField('SATKER_ID');
$reqTmtJabatan= datetimeTodatePageCheck($set->getField('LAST_TMT_JABATAN'));
$reqTanggalLahir= datetimeTodatePageCheck($set->getField('TGL_LAHIR'));
$reqPendidikanTerkahir= $set->getField('PENDIDIKAN_NAMA');
$reqJurusanTerkahir= $set->getField('LAST_DIK_JURUSAN');
$reqTahunLulus= $set->getField('LAST_DIK_TAHUN');

// echo $reqTmtJabatan;exit;
$reqMode="update";
// $reqMode="insert";
$readonly = "readonly";
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
						<a class="text-muted">Orang Tua</a>
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
                    <h3 class="card-label">Identitas Orang Tua</h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
	        	<div class="card-body">

	        		<div class="row">
		        		<!-- KOLOM AYAH -->
		        		<div class="col-md-6">
		        			<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Nama Ayah</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control" <?=$readonly?> style="background-color: #F3F6F9;" name="reqNama" id="reqNama" placeholder="Masukkan nama ayah" value="<?=$reqNama?>" />
			        			</div>
			        		</div>	
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Tempat Lahir</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control" name="reqNama" id="reqNama" placeholder="Tempat Lahir" value="<?=$reqNama?>" />
			        			</div>
			        		</div>	
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Tanggal Lahir</label>
			        			<div class="col-lg-6 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" autocomplete="off" class="form-control" id="kttanggallahir" name="reqTanggalLahir" placeholder="Select date" value="<?=$reqTanggalLahir?>" />
				        				<div class="input-group-append">
				        					<span class="input-group-text">
				        						<i class="la la-calendar"></i>
				        					</span>
				        				</div>
				        			</div>
			        			</div>
			        		</div>	
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Usia</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control" name="reqNama" id="reqNama" placeholder="Usia" value="<?=$reqNama?>" />
			        			</div>
			        		</div>	
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Pekerjaan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control" name="reqNama" id="reqNama" placeholder="Pekerjaan" value="<?=$reqNama?>" />
			        			</div>
			        		</div>	
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Alamat</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<textarea class="form-control" name="reqAlamat" cols="46" placeholder="Masukkan alamat" > <?=$reqAlamat?></textarea>
			        			</div>
			        		</div>	
		        		</div>

		        		<!-- KOLOM IBU -->
		        		<div class="col-md-6">
		        			<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Nama Ibu</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control" <?=$readonly?> style="background-color: #F3F6F9;" name="reqNama" id="reqNama" placeholder="Masukkan nama Ibu" value="<?=$reqNama?>" />
			        			</div>
			        		</div>	
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Tempat Lahir</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control" name="reqNama" id="reqNama" placeholder="Tempat Lahir" value="<?=$reqNama?>" />
			        			</div>
			        		</div>	
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Tanggal Lahir</label>
			        			<div class="col-lg-6 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" autocomplete="off" class="form-control" id="kttanggallahir" name="reqTanggalLahir" placeholder="Select date" value="<?=$reqTanggalLahir?>" />
				        				<div class="input-group-append">
				        					<span class="input-group-text">
				        						<i class="la la-calendar"></i>
				        					</span>
				        				</div>
				        			</div>
			        			</div>
			        		</div>	
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Usia</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control" name="reqNama" id="reqNama" placeholder="Usia" value="<?=$reqNama?>" />
			        			</div>
			        		</div>	
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Pekerjaan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control" name="reqNama" id="reqNama" placeholder="Pekerjaan" value="<?=$reqNama?>" />
			        			</div>
			        		</div>	
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Alamat</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<textarea class="form-control" name="reqAlamat" cols="46" placeholder="Masukkan alamat" > <?=$reqAlamat?></textarea>
			        			</div>
			        		</div>	
		        		</div>
		        	</div>
	        		
	        	</div>

	        	<div class="card-footer">
	        		<div class="row">
	        			<div class="col-lg-9">
	        				<input type="hidden" name="reqMode" value="<?=$reqMode?>">
	        				<input type="hidden" name="reqTempValidasiId" value="<?=$reqTempValidasiId?>">
	        				<button type="submit" id="ktloginformsubmitbutton"  class="btn btn-primary font-weight-bold mr-2">Simpan</button>
	        			</div>
	        		</div>
	        	</div>
	        </form>
        </div>
    </div>
</div>

<script type="text/javascript">

	$(function () {
		$("[rel=tooltip]").tooltip({ placement: 'right'});
		// $('[data-toggle="tooltip"]').tooltip()
	})

	$('#ktagamaid').select2({
		placeholder: "Pilih agama"
	});

	$('#ktsatuankerjad').select2({
		placeholder: "Pilih Satuan Kerja"
	});
	
	$('#ktjeniskelamin').select2({
		placeholder: "Pilih jenis kelamin"
	});

	arrows= {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'};
	$('#kttanggallahir').datepicker({
		todayHighlight: true
		, autoclose: true
		, orientation: "bottom left"
		, clearBtn: true
		, format: 'dd-mm-yyyy'
		, templates: arrows
	});

	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
	jQuery(document).ready(function() {
		var form = KTUtil.getById('ktloginform');
		var formSubmitUrl = "json-data/info_data_json/indentitaspegawai";
		var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
		if (!form) {
			return;
		}
		FormValidation
		.formValidation(
			form,
			{
				fields: {
					/*reqEmail: {
						validators: {
							notEmpty: {
								message: 'Email is required'
							},
							emailAddress: {
								message: 'The value is not a valid email address'
							}
						}
					},
					reqSatuanKerjaNama: {
						validators: {
							notEmpty: {
								message: 'Please select an option'
							}
						}
					},*/
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					submitButton: new FormValidation.plugins.SubmitButton(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
			)
		.on('core.form.valid', function() {
				// Show loading state on button
				KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
				var formData = new FormData(document.querySelector('form'));
				$.ajax({
					url: formSubmitUrl,
					data: formData,
					processData: false,
					contentType: false,
					type: 'POST',
					dataType: 'json',
					success: function (response) {
			        	// console.log(response); return false;
			        	// Swal.fire("Good job!", "You clicked the button!", "success");
			        	Swal.fire({
			        		text: response.message,
			        		icon: "success",
			        		buttonsStyling: false,
			        		confirmButtonText: "Ok",
			        		customClass: {
			        			confirmButton: "btn font-weight-bold btn-light-primary"
			        		}
			        	}).then(function() {
			        		document.location.href = "app/index/pegawai_data";
			        	});
			        },
			        error: function(xhr, status, error) {
			        	var err = JSON.parse(xhr.responseText);
			        	Swal.fire("Error", err.message, "error");
			        },
			        complete: function () {
			        	KTUtil.btnRelease(formSubmitButton);
			        }
			    });
			})
		.on('core.form.invalid', function() {
			Swal.fire({
				text: "Sorry, looks like there are some errors detected, please try again.",
				icon: "error",
				buttonsStyling: false,
				confirmButtonText: "Ok, got it!",
				customClass: {
					confirmButton: "btn font-weight-bold btn-light-primary"
				}
			}).then(function() {
				KTUtil.scrollTop();
			});
		});
	});

</script>

<!-- <button onclick="tes()">tesss</button>
<script>
    function tes() {
        // pageUrl= "app/loadUrl/main/pegawai_data";
        pageUrl= "iframe/index/pegawai_data";
        openAdd(pageUrl);
    }
</script> -->