<?php
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
include './config.inc.php';

//get from post
$arrFieldContent = array();
foreach ($arrFieldProp as $k=>$v){
	include './dbconnect.inc.php';
	$arrFieldContent[$v['field']] = (isset($_POST[$v['field']]))?mysqli_real_escape_string($dblink,$_POST[$v['field']]):'';
	mysqli_close($dblink);
}
//button
$submit = $_POST['submit']!=''?$_POST['submit']:'';

function checkField($_arrFieldProp, $_arrFieldContent){
	$fieldError = array();
	//check if empty
	foreach($_arrFieldContent as $k=>$v){
		if ($_arrFieldProp[$k]['mandatory'] && $v=='') $fieldError[] = $k;
	}
	
	//if found error then return false
	return $fieldError;
}

if (strtoupper($submit)!=''){
	$redir = '';
	$fieldError = checkField($arrFieldProp,$arrFieldContent);
	if (count($fieldError)==0){
		//connect to database
		include './dbconnect.inc.php';
		
		$datetime = date('Y-m-d H:i:s',time());
		
		//query insert
		$q = "
			INSERT INTO t_registrasi 
			SET 
				uid=fx_uid('".time()."'),
				datetime_created='".$datetime."',
				nama='".$arrFieldContent['nama']."',
				lahir_tempat='".$arrFieldContent['lahir_tempat']."',
				lahir_tanggal='".$arrFieldContent['lahir_tanggal']."',
				alamat='".$arrFieldContent['alamat']."',
				notelp='".$arrFieldContent['notelp']."',
				jenis_kelamin='".$arrFieldContent['jenis_kelamin']."',
				email='".$arrFieldContent['email']."',
				pekerjaan='".$arrFieldContent['pekerjaan']."',
				status_rumah='".$arrFieldContent['status_rumah']."',
				pendidikan='".$arrFieldContent['pendidikan']."',
				marital_status='".$arrFieldContent['marital_status']."',
				tanggungan='".$arrFieldContent['tanggungan']."',
				object='".$arrFieldContent['object']."',
				dp='".$arrFieldContent['dp']."',
				angsuran='".$arrFieldContent['angsuran']."',
				top='".$arrFieldContent['top']."'
		";

		$r = mysqli_query($dblink, $q); //or die(mysqli_error($dblink));
		
		//close database connection
		mysqli_close($dblink);
		$redir = ''; //'<meta http-equiv="refresh" content="10; url=index.php" />';
		$msg = '<h6><br/><center>Terima kasih, <br/>Kami akan segera menghubungi Anda.<br /><br /><a class="button button-primary" href="index.php" >Tutup</a></center></h6>';
	} else {
		$redir = ''; //'<meta http-equiv="refresh" content="5; url=index.php" />';
		$msg = '<h6><br/><center>Silahkan masukkan data Anda dengan benar!<br /><br /><a class="button button-primary" href="index.php" >&laquo; Kembali</a></center></h6>';
	}
} else {
	$redir = ''; //'<meta http-equiv="refresh" content="5; url=index.php" />';
	$msg = '<h6><br/><center>Silahkan masukkan data Anda dengan benar!<br /><br /><a class="button button-primary" href="index.php" >&laquo; Kembali</a></center></h6>';
}

?>
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
  <?php echo $redir;?>
  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <!--link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css"-->

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="normalize.css">
  <link rel="stylesheet" href="skeleton.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="favicon.png">

</head>
<body>
<div class="container"><?php echo $msg;?></div>
<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
