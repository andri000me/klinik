<?php
include "../koneksi.php";
session_start();
$act=$_GET[act];
$idobt=$_POST[idobt];
$namaobt=$_POST[namaobt];
$jenisobt=$_POST[jenisobt];
if($_POST[simpan]){
	mysql_query("insert into tbl_obat values('$idobt','$namaobt','$jenisobt')") or die (mysql_error());	
	}elseif ($_POST[ubah]){
	$q="update tbl_obat set idobt='$idobt',namaobt='$namaobt',jenisobt='$jenisobt' where idobt='$idobt'";
	mysql_query($q)or die(mysql_error());
	}elseif($act=='hapus'){
	  mysql_query("delete from tbl_obat where idobt='$_GET[idobt]'");
	  
	  }
	  
	  
header("location:../../mod.php?mod=obat");

	

?>
