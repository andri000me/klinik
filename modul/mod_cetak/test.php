<?php
session_start();
$idpasien=$_POST['idpasien'];
include "../koneksi.php";
//include "../Configurasi/fungsi_indotgl.php";
//include "../Configurasi/library.php";

include "fpdf17/fpdf.php";


//$tgl = tgl_indo(date('Y m d'));
$pdf = new FPDF();
$pdf->Open();
//Poisi Kertas
$pdf->addPage('L','A4');
$pdf->setAutoPageBreak(false);

//mengatur posisi tabel yang ditampilkan
$a = 10; //posisi field record atas / bawah
$b = 16; //posisi isi record atas / bawah
$pdf->setFont('Arial','',15);
$pdf->text(10 /*nilai kiri / kanan*/ ,8,'KLINIK DR REZA');
$pdf->setFont('Arial','',8);
$pdf->text(10 /*nilai kiri / kanan*/ ,11,'jln. sepatan no.768 tangerang');
$pdf->setFont('Arial','',12);
$pdf->text(41 /*nilai kiri / kanan*/ ,15,'Kartu Berobat');

//Field yang ada pada database

//query baca data MySQL

$sql = mysql_query("select *from tbl_pasien where idpasien='$_GET[idpasien]'");
   
//looping penbacaan record

while($data = mysql_fetch_array($sql)){
	$SQL="SELECT * FROM tbl_pasien where idpasien='$_GET[idpasien]' ";
	$bacakategori = mysql_query($SQL);
	$ex=mysql_fetch_array($bacakategori);
       $pdf->setXY(10/*nilai untuk mengatur posisi isi record kiri / kanan*/,$b);
       $pdf->setFont('arial','',7);
       $pdf->setFillColor(255,255,255);
      
       
      // $pdf->cell(30,6,'id pasien',1,0,'L',1);
       //$pdf->cell(5,6,':',1,0,'C',1);
      // $pdf->cell(60,6,$data['idpasien'],1,0,'L',1);
      // $pdf->Ln(5);
       $pdf->cell(25,6,'No Registrasi',0,0,'L',1);
       $pdf->cell(5,6,':',0,0,'C',1);
       $pdf->cell(60,6,$data['noreg'],0,0,'L',1);
       $pdf->Ln(5);
       $pdf->cell(25,6,'Nama Pasien',0,0,'L',1);
       $pdf->cell(5,6,':',0,0,'C',1);
       $pdf->cell(60,6,$data['namapasien'],0,0,'L',1);
       $pdf->Ln(5);
		 $pdf->cell(25,6,'Tanggal Lahir',0,0,'L',1);
		 $pdf->cell(5,6,':',0,0,'C',1);
		 $pdf->cell(60,6,$data['tgllhr'],0,0,'L',1);
		 $pdf->Ln(5.9);
       $pdf->Cell(25,15,'Alamat',0,0,'L',1);
       
       $pdf->Cell(5,15,':',0,0,'C',1);
       $pdf->MultiCell(60,6,$data['alamat'],0,1);
       
	    $pdf->CELL(25,6,'Jenis Kelamin',0,0,'L',1);
	    $pdf->cell(5,6,':',0,0,'C',1);
	    $pdf->CELL(60,6,$data['jeniskel'],0,0,'L',1);
	    $pdf->Ln(5);
	    $pdf->cell(25,6,'Pekerjaan',0,0,'L',1);
		 $pdf->cell(5,6,':',0,0,'C',1);	    
	    $pdf->cell(60,6,$data['pekerjaan'],0,0,'L',1);
	    $pdf->Ln(5);
       $pdf->cell(25,6,'Nama KK',0,0,'L',1);
       $pdf->cell(5,6,':',0,0,'C',1);	    
       $pdf->cell(60,6,$data['namakk'],0,0,'L',1);
       $pdf->Ln(5);
	    $pdf->cell(25,6,'Tanggal Daftar',0,0,'L',1);
	     $pdf->cell(5,6,':',0,0,'C',1);	  
	    $pdf->cell(60,6,$data['tgldaftar'],0,0,'L',1);
	    $b = $b+$row;
       $no++;
       $i++;
}
  // Go to 1.5 cm from bottom


$pdf->output();
?>
