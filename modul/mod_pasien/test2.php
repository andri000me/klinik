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


<style>
 th{
	color: #FFFFFF;
	font-size: 8pt;
	text-transform: uppercase;
	text-align: center;
	padding: 0.5em;
	border-width: 1px;
	border-style: solid;
	border-color: #969BA5;
	border-collapse: collapse;
	background-color: #4985B2;
	width:auto;
}

td{
	padding: 0.3em;
	font-size: 11px;
	vertical-align: top;
	border-width: 1px;
	border-style: solid;
	border-color: #969BA5;
	border-collapse: collapse;

}
</style>
<script src="js/jquery-1.8.2.js"></script>
	<script src="js/ui.core.js"></script>
	<script src="js/ui.datepicker.js"></script>
	<script>
	$(function() {
		$( "#datepicker1" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
		$("#datepicker1").datepicker("option","dateFormat","dd-mm-yy");
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
<?php
if($_POST[act]=="hapus"){
$cek=$_POST[cek];
$jml=count($cek);

for($i=0;$i<$jml;$i++){
					mysql_query("delete from tbl_pasien where noreg='$cek[$i]'");
					}
}
?>

<link rel="stylesheet" type="text/css" href="../../css/960.css" />
<link rel="stylesheet" type="text/css" href="../../css/reset.css" />
<link rel="stylesheet" type="text/css" href="../../css/text.css" />
<link rel="stylesheet" type="text/css" href="../cssmod/blue.css"/>
<link type="text/css" href="../../css/smoothness/ui.css" rel="stylesheet" />
<link type="text/css" href="../../js/wysiwyg/jquery.wysiwyg.css" rel="stylesheet" />
    <script type="text/javascript" src="../../ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/wysiwyg/jquery.wysiwyg.js"></script>
    <script type="text/javascript">
	$(document).ready(function() {
		$('#wysiwyg').wysiwyg();
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
switch($_GET[namapasien]){
  // Tampilkan pd tabel
  default:
    echo "

	<table border=1 width=940>
	<tr><td colspan='10'><a href='mod.php?mod=input_pasien' class='button_grey' name='tambah'><span>Tambah</span></a></tr>
          <tr>
		  <th>No</th>
		  <th>No reg</th>
		  <th>Nama pasien</th>
		  <th>namakk</th>
		  <th>riwayat</th>
		  <th>keterangan</th>
		  <th>Aksi</th>
		  </tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
    $tampil=mysql_query("select x.namapasien, x.tgllhr, x.alamat,x.jeniskel, x.pekerjaan, x.tgldaftar, y.riwayat, y.keterangan from tbl_pasien x, tbl_riwayat y where x.noreg=y.noreg and namapasien='$namapasien' LIMIT $posisi,$batas");
    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "
	  			<tr align=center>
				<td width=20>$no</td>
                <td width=70>$r[noreg]</td>
                <td width=130>$r[namapasien]</td>
                <td width=65>$r[namakk]</td>
			
				<td width=170>$r[riwayat]</td>
					<td width=100>$r[keterangan]</td>
		
                <td width=75><a href=mod.php?mod=pasien&act=edit&noreg=$r[noreg] >Edit</a> | 
	           <a href='modul/mod_pasien/aksi.php?mod=pasien&act=hapus&noreg=$r[noreg]' onClick=\"return confirm('Apakah Anda akan menghapusnya?')\">Hapus</a>
			  
		        </tr>";
      $no++;
    }
    echo "</table>";
    $jmldata=mysql_num_rows(mysql_query("SELECT * FROM tbl_pasien "));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
	echo "";
    echo "<div id=paging>Hal: $linkHalaman</div><br>";
    break;

  case "edit":
    $edit = mysql_query("SELECT * FROM tbl_pasien WHERE noreg='$_GET[noreg]'");
    $r    = mysql_fetch_array($edit);
	
    echo "<h2 >Edit pasien</h2>
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
