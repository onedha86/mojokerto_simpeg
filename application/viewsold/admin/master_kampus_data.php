<?
include_once("functions/date.func.php");

$this->load->model("base-data/InfoData");

$reqId= $this->input->get("reqId");

if(empty($reqId)){}
else
{
	$set= new InfoData();
	$set->selectbykampus(array("A.Kampus_id"=>$reqId),-1,-1);
	// echo $set->query;exit;
	$set->firstRow();
	$reqNama= $set->getField('NAMA');
	$reqTingkatPendidikanS1= $set->getField('S1');
	$reqTingkatPendidikanS2= $set->getField('S2');
	$reqTingkatPendidikanS3= $set->getField('S3');
}
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

<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="card card-custom">
        	<div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-notepad text-primary"></i>
                    </span>
                    <h3 class="card-label">Data</h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
	        	<div class="card-body">
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Nama</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqNama" id="reqNama" placeholder="Masukkan nama" value="<?=$reqNama?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tingkatan Pendidikan S1</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<select name="reqTingkatPendidikanS1"  class="form-control">
	        					<option disabled value="" <? if ($reqTingkatPendidikanS1==''){ echo "selected"; }?>> Pilih tingkatan</option>
	        					<?
	        					$this->load->model("base-data/InfoData");

								$setTingkat= new InfoData();
								$setTingkat->selectbyparamstingkatpendidikan();
								// echo $setTingkat->query; exit;

								while($setTingkat->nextRow()){
								$reqNamaTingkatId= $setTingkat->getField('TINGKAT_PENDIDIKAN_ID');
								$reqNamaTingkatNama= $setTingkat->getField('NAMA');
									?>
		        					<option value="<?=$reqNamaTingkatId?>" <? if ($reqTingkatPendidikanS1==$reqNamaTingkatId){ echo "selected"; }?>> <?=$reqNamaTingkatNama?></option>
	        					<?}?>
	        				</select>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tingkatan Pendidikan S2	</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<select name="reqTingkatPendidikanS2"  class="form-control">
	        					<option disabled value="" <? if ($reqTingkatPendidikanS2==''){ echo "selected"; }?>> Pilih tingkatan</option>
	        					<?
	        					$this->load->model("base-data/InfoData");

								$setTingkat= new InfoData();
								$setTingkat->selectbyparamstingkatpendidikan();
								// echo $setTingkat->query; exit;

								while($setTingkat->nextRow()){
								$reqNamaTingkatId= $setTingkat->getField('TINGKAT_PENDIDIKAN_ID');
								$reqNamaTingkatNama= $setTingkat->getField('NAMA');
									?>
		        					<option value="<?=$reqNamaTingkatId?>" <? if ($reqTingkatPendidikanS2==$reqNamaTingkatId){ echo "selected"; }?>> <?=$reqNamaTingkatNama?></option>
	        					<?}?>
	        				</select>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tingkatan Pendidikan S3</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<select name="reqTingkatPendidikanS3"  class="form-control">
	        					<option disabled value="" <? if ($reqTingkatPendidikanS3==''){ echo "selected"; }?>> Pilih tingkatan</option>
	        					<?
	        					$this->load->model("base-data/InfoData");

								$setTingkat= new InfoData();
								$setTingkat->selectbyparamstingkatpendidikan();
								// echo $setTingkat->query; exit;

								while($setTingkat->nextRow()){
								$reqNamaTingkatId= $setTingkat->getField('TINGKAT_PENDIDIKAN_ID');
								$reqNamaTingkatNama= $setTingkat->getField('NAMA');
									?>
		        					<option value="<?=$reqNamaTingkatId?>" <? if ($reqTingkatPendidikanS3==$reqNamaTingkatId){ echo "selected"; }?>> <?=$reqNamaTingkatNama?></option>
	        					<?}?>
	        				</select>
	        			</div>
	        		</div>
	        	</div>

	        	<div class="card-footer">
	        		<div class="row">
	        			<div class="col-lg-9">
	        				<input type="hidden" name="reqId" value="<?=$reqId?>">
	        				<button type="submit" id="ktloginformsubmitbutton"  class="btn btn-primary font-weight-bold mr-2">Simpan</button>
	        			</div>
	        		</div>
	        	</div>
	        </form>
        </div>
    </div>
</div>

<script type="text/javascript">
	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
	jQuery(document).ready(function() {
		var form = KTUtil.getById('ktloginform');
		var formSubmitUrl = "json-data/info_admin_json/AddMasterKampus";
		var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
		if (!form) {
			return;
		}
		FormValidation
		.formValidation(
			form,
			{
				fields: {
					reqNama: {
						validators: {
							notEmpty: {
								message: 'Nama is required'
							}
						}
					},
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
					cache: false,
					url: formSubmitUrl,
					data: formData,
					processData: false,
					contentType: false,
					type: 'POST',
					dataType: 'json',
					success: function (response) {
			        	// console.log(response); return false;

			        	inforesponse= response.message;
			        	inforesponsedata = inforesponse.split("-");

			        	inforesponseid= inforesponsedata[0];
			        	inforesponsepesan= inforesponsedata[1];

			        	// Swal.fire("Good job!", "You clicked the button!", "success");
			        	Swal.fire({
			        		text: inforesponsepesan,
			        		icon: "success",
			        		buttonsStyling: false,
			        		confirmButtonText: "Ok",
			        		customClass: {
			        			confirmButton: "btn font-weight-bold btn-light-primary"
			        		}
			        	}).then(function() {
			        		document.location.href = "admin/index/master_kampus_data?reqId="+inforesponseid;
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