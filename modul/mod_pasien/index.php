<?php
session_start();
error_reporting(0);
include "../../timeout.php";

if($_SESSION[login]==1){
	if(!cek_login()){
		$_SESSION[login] = 0;
	}
}
if($_SESSION[login]==0){
  header('location:../../logout.php');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
 <meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php include "koneksi.php";
include"class_paging.php";
?>
<link href="../../css/bootstrap.css" rel="stylesheet">
    <link href="../../css/template.css" rel="stylesheet">
    <link href="../../js/google-code-prettify/prettify.css" rel="stylesheet">
    <script type="text/javascript" src="../../js/ui.dialog.js"></script>
    <script type="text/javascript" src="../../js/effects.js"></script>
	<link rel="stylesheet" href="../../css/themes/base/jquery.ui.all.css">
	<script src="../../js/jquery-1.8.2.js"></script>
	<script src="../../js/ui/jquery.ui.core.js"></script>
	<script src="../../js/ui/jquery.ui.widget.js"></script>
	<script src="../../js/ui/jquery.ui.datepicker.js"></script>
<script src="js/jquery-1.8.2.js"></script>
	<script src="js/ui.core.js"></script>
	<script src="js/ui.datepicker.js"></script>
	<script>
	$(function() {
		$( "#datepicker2" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
		$("#datepicker2").datepicker("option","dateFormat","dd-mm-yy");
	});
	</script>

<?php
session_start();
error_reporting(0);
include "../../timeout.php";

if($_SESSION[login]==1){
	if(!cek_login()){
		$_SESSION[login] = 0;
	}
}
if($_SESSION[login]==0){
  header('location:../../logout.php');
}

?>

   	<script>
	var $konf=jQuery.noConflict();
	$konf(function() {
		$konf( "#datepicker" ).datepicker();
	});
	</script>
    <script type="text/javascript" src="../../js/blend/jquery.blend.js"></script>
	<script type="text/javascript" src="../../js/ui.core.js"></script>
	<script type="text/javascript" src="../../js/ui.sortable.js"></script>    
    <script type="text/javascript" src="../../js/ui.dialog.js"></script>
    <script type="text/javascript" src="../../js/effects.js"></script>
    <!--[if IE6]>
	<link rel="stylesheet" type="text/css" href="css/iefix.css" />
    <![endif]-->
    <!--[if IE 6]>
	<link rel="stylesheet" type="text/css" href="css/iefix.css" />
	<script src="js/pngfix.js"></script>
    <script>
        DD_belatedPNG.fix('#menu ul li a span span');
    </script>    
    <![endif]-->
</head>   
</head><body>
 <?php
    $aksi="aksi.php";
switch($_GET[act]){
  // Tampilkan pd tabel
  default:
    echo "
	    <div class='navbar'>
    <div class='navbar-inner'>
    
    <ul class='nav'>
    <li class='active'><a href='mod.php?mod=input_pasien'>Tambah Pasien</a></li>

    </ul>
    </div>
    </div>
	<table  class='table table-striped'>
	
          <tr style=' align:center; valign='middle'>
		  <td>No</td>
		  <td>No Reg</td>
		  <td>Nama pasien</td>
		  <td>Tanggal Lahir</td>
		  <td>Alamat</td>
		  <td>Telpon</td>
		  <td>Jenis Kelamin</td>
		<td>Pekerjaan</td>
		  <td>Nama KK</td>
		  <td>Tgl Daftar</td>
		  <td>Aksi</td>
		  </tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
    $tampil=mysql_query("SELECT * FROM tbl_pasien ORDER BY noreg DESC LIMIT $posisi,$batas");
    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "
	  			<tr align=center>
				<td width=20>$no</td>
                <td width=70>$r[noreg]</td>
                <td width=130>$r[namapasien]</td>
                <td width=65>$r[tgllhr]</td>
			
				<td width=50>$r[alamat]</td>
				<td width=250>$r[telpon]</td>
				<td width=50>$r[jeniskel]</td>
					<td width=100>$r[pekerjaan]</td>
				<td width=50>$r[namakk]</td>
				<td width=70>$r[tgldaftar]</td>
                <td width=75>
	    <div class='btn-group'>
     <a href=mod.php?mod=pasien&act=edit&noreg=$r[noreg] class='btn' >Edit</a>

    <a class='btn' href='modul/mod_pasien/aksi.php?mod=pasien&act=hapus&noreg=$r[noreg]' onClick=\"return confirm('Apakah Anda akan menghapusnya?')\">Hapus</a>
    </div>   
                
                
             
		        </tr>";
      $no++;
    }
    echo "</table>";
    $jmldata=mysql_num_rows(mysql_query("SELECT * FROM tbl_pasien "));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
	echo "";
    echo "<div id=paging>Halaman: 

<a> $linkHalaman</a></div><br>";
    break;

  case "edit":
    $edit = mysql_query("SELECT * FROM tbl_pasien WHERE noreg='$_GET[noreg]'");
    $r    = mysql_fetch_array($edit);
	
    echo "
<div class='navbar'>
    <div class='navbar-inner'>
    
    <ul class='nav'>
    <li class='active'><a href='#'>Edit Pasien</a></li>
    <li onclick='self.history.back()'><a href='#'>Cancel</a></li>
    
    </ul>
    </div>
    </div>    
    <h2 >Edit pasien</h2>
          <form style='margin-left:30px;' method='POST' action='modul/mod_pasien/aksi.php?mod=pasien&act=edit'>
          <input type=hidden name=noreg value=$r[noreg]>
           <table>
          <tr><td>Nama pasien</td><td>     :</td><td> <input type=text name='namapasien' size=40 value='$r[namapasien]'></td></tr>
          <tr><td>Tanggal lahir</td><td>  :</td><td> <input type=text name='tgllhr' size=30 value='$r[tgllhr]'></td></tr>
        
          <tr><td>alamat</td><td>  : </td><td><input type=text name='alamat' size=40 value='$r[alamat] '></td></tr>
   <tr><td>Telpon</td><td>     :</td><td> <input type=int name='telpon' size=40 value='$r[telpon]'></td></tr>
		  <tr><td>Jenis Kelamin</td><td>     : </td><td><input type=text name='jeniskel' size=30 value='$r[jeniskel]'></td></tr>
  <tr><td>Pekerjaan</td><td>     :</td><td> <input type=text name='pekerjaan' size=30 value='$r[pekerjaan]' ></td></tr>
		  <tr><td>Nama KK</td><td>     : </td><td><input type=text name='namakk' size=30 value='$r[namakk]'></td></tr>
		  <tr><td>Berat Badan</td><td>     : </td><td><input type=text name='berat' size=30 value='$r[berat]' maxlength='3' style='width:40px;'>  KG</td></tr>
		  <tr><td>Tinggi Badan</td><td>     : </td><td><input type=text name='tinggi' size=30 value='$r[tinggi]' maxlength='3' style='width:40px;'>  M</td></tr>
		  <tr><td>tanggal daftar</td><td>     : </td><td><input type=text name='tgldaftar' size='30' value='$r[tgldaftar]' readonly></td></tr>";
    echo "<tr><td></td><td><td colspan='2'><input type='submit' value='update' name=ubah>
                            <input type='button' value='Batal' onclick='self.history.back()'></td></tr>
          </table>
		  </form>";
    break;  
}
?>

</body>
</html>
