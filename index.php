<?php
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
include './config.inc.php';

session_start();

//get reference data
$arrRef = array(
	'pekerjaan' 	=> 'r_pekerjaan',
	'status_rumah' 	=> 'r_statusrumah',
	'pendidikan'	=> 'r_pendidikan',
	'marital_status'=> 'r_maritalstatus',
	'object'		=> 'r_object'
);

include './dbconnect.inc.php';

foreach ($arrRef as $k=>$v){
	$q = "SELECT * FROM ".$v." ORDER BY sort ASC;";
	$r = mysqli_query($dblink, $q) or die(mysqli_error($dblink));
	while($d=mysqli_fetch_assoc($r)){
		$$k[$d['uid']] = $d['name'];
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

<!-- Basic Page Needs
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<meta charset="utf-8">
<title><?php echo $WEB_TITLE;?></title>
<meta name="description" content="">
<meta name="author" content="">

<!-- Mobile Specific Metas
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<meta name="viewport" content="width=device-width, initial-scale=1">

  
<!-- CSS
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<link rel="stylesheet" href="normalize.css">
<link rel="stylesheet" href="skeleton.css">
<link rel="stylesheet" href="progress-wizard.min.css">
<style>
.inputFileImg, .imgocrtemp{
	display:none;
}

.thumbImgClass{
	position:relative;
	width:70px;
	height:auto;
	margin-right:5px;
	display: inline-block;
}

.divImgThumbFolder{
	width:100%; 
	position:relative;
}

.imgTitleDiv{
	position:relative;
	width:100%;
	font-size:10pt;
	text-align:center;
}
</style>

<!-- Favicon
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<link rel="shortcut icon" type="image//vnd.microsoft.icon" href="./favicon.ico">
<script src="jquery.min.js"></script>
</head>
<body>

<!-- Primary Page Layout
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<div class="container">
	<div class="column" style="margin-top: 3%">
		<div style="position:relative; overflow: show">
			<center>
				<div><img width="90%" src="./applogo.png" /></div><br /><br />
				<div><strong>Form Registrasi Pengajuan Kredit</strong></div>
				<small>Silahkan isi form di bawah ini dengan baik dan benar</small>
			</center>
			<br />
			<form action="./submit.php" method="post" enctype="multipart/form-data">
				<label>Nama:</label>
				<small>Masukkan nama lengkap sesuai KTP</small>
				<input class="goWidth" type="text" name="nama" id="nama" value="" autocomplete="off" required="required" autofocus /><br />
				<label>Tempat Lahir:</label>
				<small>Masukkan tempat lahir sesuai KTP</small>
				<input class="goWidth" type="text" name="lahir_tempat" id="lahir_tempat" value="" autocomplete="off" required="required" /><br />
				<label>Tanggal Lahir:</label>
				<small>Pilih tanggal lahir sesuai KTP</small>
				<input class="goWidth" type="date" name="lahir_tanggal" id="lahir_tanggal" value="" autocomplete="off" required="required" /><br />
				<label>Alamat:</label>
				<small>Masukkan alamat lengkap</small>
				<textarea class="goWidth" type="text" name="alamat" id="alamat" value="" autocomplete="off" required="required" ></textarea><br />
				<label>Nomor Telp:</label>
				<small>Kami akan menghubungi Anda melalui nomor ini</small>
				<input class="goWidth" type="number" name="notelp" id="notelp" onkeypress="return ((event.charCode >= 48 && event.charCode <= 57) | event.charCode==8)" value="" autocomplete="off" required="required"/><br />
				<label>Jenis Kelamin:</label>
				<select class="goWidth" name="jenis_kelamin" id="jenis_kelamin" autocomplete="off" required="required" >
					<option value="">- Pilih -</option>
					<option value="L">Laki-Laki</option>
					<option value="P">Perempuan</option>
				</select><br />
				<label>Email:</label>
				<small>Masukkan alamat email Anda</small>
				<input class="goWidth" type="text" name="email" id="email" value="" autocomplete="off" required="required" /><br />					
				<label>Pekerjaan:</label>
				<small>Pilih pekerjaan Anda</small>
				<select class="goWidth" name="pekerjaan" id="pekerjaan" autocomplete="off" required="required" >
					<option value="">- Pilih -</option>
					<?php
					foreach($pekerjaan as $k=>$v){
						?>
						<option value="<?php echo $k;?>"><?php echo $v;?></option>
						<?php
					}
					?>
				</select><br />
				
				<label>Status Rumah:</label>
				<small>Pilih status tempat tinggal Anda</small>
				<select class="goWidth" name="status_rumah" id="status_rumah" autocomplete="off" required="required" >
					<option value="">- Pilih -</option>
					<?php
					foreach($status_rumah as $k=>$v){
						?>
						<option value="<?php echo $k;?>"><?php echo $v;?></option>
						<?php
					}
					?>
				</select><br />
				
				<label>Pendidikan:</label>
				<small>Pilih pendidikan terakhir Anda</small>
				<select class="goWidth" name="pendidikan" id="pendidikan" autocomplete="off" required="required" >
					<option value="">- Pilih -</option>
					<?php
					foreach($pendidikan as $k=>$v){
						?>
						<option value="<?php echo $k;?>"><?php echo $v;?></option>
						<?php
					}
					?>
				</select><br />
				
				<label>Marital Status:</label>
				<small>Pilih status berkeluarga Anda</small>
				<select class="goWidth" name="marital_status" id="marital_status" autocomplete="off" required="required" >
					<option value="">- Pilih -</option>
					<?php
					foreach($marital_status as $k=>$v){
						?>
						<option value="<?php echo $k;?>"><?php echo $v;?></option>
						<?php
					}
					?>
				</select><br />
				<label>Tanggungan:</label>
				<small>Jumlah tanggungan</small>
				<input class="goWidth" type="number" name="tanggungan" id="tanggungan" value="" autocomplete="off" required="required" /><br />
				<label>Object:</label>
				<small>Jenis barang yang akan di kredit</small>
				<select class="goWidth" name="object" id="object" autocomplete="off" required="required" >
					<option value="">- Pilih -</option>
					<?php
					foreach($object as $k=>$v){
						?>
						<option value="<?php echo $k;?>"><?php echo $v;?></option>
						<?php
					}
					?>
				</select><br />
				<label>DP:</label>
				<small>Down Payment / Uang Muka</small>
				<input class="goWidth" type="number" name="dp" id="dp" value="" autocomplete="off" required="required" /><br />
				<label>Angsuran:</label>
				<small>Jumlah angsuran</small>
				<input class="goWidth" type="number" name="angsuran" id="angsuran" value="" autocomplete="off" required="required" /><br />
				<label>TOP (Terms of Payment):</label>
				<small>Jangka waktu pembayaran (Bulan)</small>
				<input class="goWidth" type="number" name="top" id="top" value="" autocomplete="off" required="required" /><br />
				
				<br /><center><input onclick="javascript:return validateFormSubmit();" type="Submit" name="submit" id="submit" value="Register" class="button button-primary"/></center>
			</form>
		</div>
	</div>
</div>
<div id="modalCanvas" style="z-index:9999; background-color:#000; position:absolute; top:50px; left0px; width:100%; height:100%; display:none;">
	<img src="" id="targetCanvas" style="display:none;">
</div>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>

<script language="javascript">
$(document).ready(function(){
	_arrStep = new Array;
	_arrStepBubble = new Array;
	_stepActive = 0;
	
	$('.stepBubble').each(function(){
		_arrStepBubble.push($(this).attr('id'));
	});
	$('.stepClass').each(function(){
		_arrStep.push($(this).attr('id'));
	});
	
	//set first step to active
	setActiveStep(_stepActive);
});

setActiveStep = function(_step){
	_stepActive = _step;
	//bubble
	$('.stepBubble').removeClass('completed');
	for(_i=0; _i<=_step; _i++){
		$('#' + _arrStepBubble[_i] ).addClass('completed');
	}
	
	//set all to hide
	$('.stepClass').removeClass('active');
	$('#' + _arrStep[_step] ).addClass('active');
}


btnStepPrev = function(){
	if (_stepActive!=0){
		_stepActive--;
		setActiveStep(_stepActive);
	}
}

btnStepNext = function(){
	if (_stepActive<=_arrStep.length-1){
		_stepActive++;
		setActiveStep(_stepActive);
	}
}


validateFormSubmit = function(){
	return true;
	msisdn = $('#msisdn').val();
	nikktp = $('#nikktp').val();
	nokk = $('#nokk').val();
	namaibu = $('#namaibu').val();
	imgktp = $('#imgktp').val();
	imgfotodiri = $('#imgfotodiri').val();
	imgttd = $('#imgttd').val();
	agreeinputdata = $('#agreeinputdata').attr('checked');
	
	_arrPrefixXLAXIS = ['62831', '62832', '62838', '62859', '62877', '62878', '62817', '62818', '62819'];
	_msisdn = msisdn.replace(/08/g, "628");
	_msisdn = _msisdn.substr(0,5);
	
	_msgError = "";
	_idFocus = null;
	
	if (!agreeinputdata){
		_msgError = '[ERROR] Anda harus menyatakan bahwa semua input sudah benar';
		_idFocus = $('#agreeinputdata');
	}
	
	if (imgttd==''){
		_msgError = '[ERROR] Silahkan masukkan Foto Tanda Tangan Anda';
		_idFocus = null;
	}
	
	if (imgfotodiri==''){
		_msgError = '[ERROR] Silahkan masukkan Foto Diri Anda';
		_idFocus = null;
	}
	
	if (imgktp==''){
		_msgError = '[ERROR] Silahkan masukkan Foto KTP Anda';
		_idFocus = null;
	}
	
	if (nokk=='' && namaibu==''){
		_msgError = '[ERROR] Silahkan masukkan No Kartu Keluarga atau Nama Gadis Ibu Kandung, sesuaikan dengan data pada Kartu Keluarga';
		if (nokk==''){
			_idFocus = $('#nokk');
		}
		if (namaibu==''){
			_idFocus = $('#namaibu');
		}
	}
	
	if (nikktp==''){
		_msgError = '[ERROR] Maaf NIK/No KTP yang Anda masukkan salah, sesuaikan dengan data pada Kartu Keluarga';
		_idFocus = $('#nikktp');
	}
		
	if (_arrPrefixXLAXIS.indexOf(_msisdn)===-1){
		_msgError = '[ERROR] Maaf MSISDN yang Anda masukkan salah, pastikan nomor yang Anda ketik adalah nomor XL atau AXIS';
		_idFocus = $('#msisdn');
	}
	
	
	//notified user
	if (_idFocus!=null){
		$(_idFocus).focus();
	}
	
	if (_msgError!=''){
		alert(_msgError);
		return false;
	} else {
		return true;
	}
	
}

$("#imgktp, #imgkk, #imgfotodiri, #imgttd").change(function(){
	input = this;
	idname = $(input).attr('id')+'_view';
	idfield = $(input).attr('id')+'_id';
	if (input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload = function (e) {
			_strImg = e.target.result;
			$('#' + idname).attr('src', _strImg);
		}
		reader.readAsDataURL(input.files[0]);
	}
});

</script>
</html>
