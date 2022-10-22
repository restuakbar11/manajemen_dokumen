<?php

/**
 * @author Ple-Q
 * @copyright 2015
 */
 
 ob_start();
 ini_set('memory_limit','500M');
include "../../../../config/koneksi.php";
session_start();
$laporan=$_GET[id];
//$tanggal=$_GET[tanggal];
$tanggal=$_GET['tanggal'];
//include "rupiah.php";
$cabang =$_SESSION['id_customer'];
$tambah =$tanggal.'^'.$cabang;

$arr=explode('^',$tambah);
    $hitung=count($arr);
    for($a=0;$a<$hitung;$a++){
        $k[$a]="'$arr[$a]'";
    }
  //  $arr=count($date);

$gabung=implode(',',$k);
$i = 1;
$b=1;
 // echo"$gabung";
require "../../../../config/querysp.php"; 
$no=1;

echo"
<html><head>
<style>
body {
	font-family: sans-serif;
	font-size: 12pt;

}
table.layout {
	font-family: Arial Black;
    font-size: 15px;
	border: 1px solid black;
	border-collapse: black;
}
tr.layout { 
    font-family: Arial Black;
    font-size: 15px;
   text-align:center
border:1px solid black;
    }
tr.kiri { 
    font-family: Arial Black;
    font-size: 15px;
   text-align:center
border:1px solid black;
    }
th.layout { 
    font-family: Arial Black;
    font-size: 15px;
    text-align:left;
border:1px solid black;
    }
td.layout { 
    font-family: Arial Black;
    font-size: 15px;
    text-align:center;
border:1px solid black;
    }
td.kiri { 
    font-family: Arial Black;
    font-size: 15px;
    text-align:left;
border:1px solid black;
    }
td.kanan { 
    font-family:Arial Black;
    font-size: 15px;
    text-align:right;
border:1px solid black;
    }
</style>
</head>
<body>
<form class='page'>
<table>
<tr>
<td rowspan='4'><img src='../../../../images/headergvp.jpg' width=250></td>
<td width='160px'> </td>
<td valign='top' align='center'><h3>Laporan Detail Inventaris Customer / Customer</h3>

</td></tr></table>
<p align=right>Periode : $arr[0] sampai $arr[1]</p>";
echo"<table width='1500px' class='layout'>
<tr class='layout'>
<th class='layout' width=40px align='center'>No</th>
<th class='layout' width=60px align='center'>Tanggal</th>
<th class='layout' width=90px align='center'>No Aggrement</th>
<th class='layout' width=130px align='center'>No SJ</th>
<th class='layout' width=130px align='center'>Nama Customer</th>
<th class='layout' width=200px align='center'>Item</th>
<th class='layout' width=70px align='center'>Lot Number/SN</th>
<th class='layout' width=50px align='center'>Qty</th>
<th class='layout' width=50px align='center'>Satuan</th>
<th class='layout' width=100px align='center'>Alat</th>
<th class='layout' width=100px align='center'>Harga</th>
<th class='layout' width=100px align='center'>Subtotal</th>
</tr>";
$k=1;
 //$sql = mysql_query("call $laporan ($gabung);");
    while( $r = mysql_fetch_array($sql)){
		$subtot =$r['qty']*$r['harga'];
		$harga=number_format($r[harga],0,'.',',');
		$subtotal=number_format($subtot,0,'.',',');
		$grandtotalFOC=$subtot+$grandtotalFOC;
   // mysql_query("select count(barang_masuk)")
//$stock=$stock + $r[barang_masuk]-$r[barang_keluar];
    echo"<tr class='layout'>";
    if($r[jml] >= 50 and $no ==1){
  if($penjualan_no_surat_jalan!=$r['penjualan_no_surat_jalan']){

        $span=20;
        
    $penjualan_no_surat_jalan=$r['penjualan_no_surat_jalan'];
    
   // echo"$satuan";
    echo "
    <td rowspan=$span class='kiri' valign='top'>$no</td>
    <td rowspan=$span class='kiri' valign='top'>$r[tanggal]</td>
    <td rowspan=$span class='kiri' valign='top'>$r[no_aggrement]</td>
    <td rowspan=$span class='kiri' valign='top'>$r[penjualan_no_surat_jalan]</td>
    <td rowspan=$span class='kiri' valign='top'>$r[nama_costumer]</td>
";

                $no++;
                     
    }
        }
        else if($r[jml] >= 50 and $k ==21){
            if($penjualan_no_surat_jalan==$r['penjualan_no_surat_jalan']){
         
                $span=$r[jml]-20;
                echo "
    <td rowspan=$span class='kiri' valign='top'>$no</td>
    <td rowspan=$span class='kiri' valign='top'>$r[tanggal]</td>
	<td rowspan=$span class='kiri' valign='top'>$r[no_aggrement]</td>
    <td rowspan=$span class='kiri' valign='top'>$r[penjualan_no_surat_jalan]</td>
    <td rowspan=$span class='kiri' valign='top'>$r[nama_costumer]</td>";
            $no++;
           
            }
        }
        else if ($penjualan_no_surat_jalan!=$r['penjualan_no_surat_jalan']){
                $span=$r[jml];
    $penjualan_no_surat_jalan=$r['penjualan_no_surat_jalan'];
                echo "
    <td rowspan=$span class='kiri' valign='top'>$no</td>
    <td rowspan=$span class='kiri' valign='top'>$r[tanggal]</td>
	<td rowspan=$span class='kiri' valign='top'>$r[no_aggrement]</td>
    <td rowspan=$span class='kiri' valign='top'>$r[penjualan_no_surat_jalan]</td>
    <td rowspan=$span class='kiri' valign='top'>$r[nama_costumer]</td>";
            $no++;
            
        }
    
    echo " 
    <td class='kiri'>$r[item]</td> 
    <td class='kiri'>$r[lot_number]</td> 
                <td class='layout'>$r[qty]</td>
                <td class='layout'>$r[satuan]</td>
                <td class='layout'>$r[kegunaan]</td>
                <td class='kanan'>$harga</td>
                <td class='kanan'>$subtotal</td>
</tr>";
$k++;
 }
     
$grandtotalFOC2=number_format($grandtotalFOC,0,'.',',');        

 echo"<tr class='layout'>
        <td class='kanan' colspan=11>TOTAL ALL</td>
        <td class='kanan'>$grandtotalFOC2</td>
      </tr>
</table>";
 
//include "../../../../config/fungsi_getreportP.php";
    $out = ob_get_contents();
ob_end_clean();
include("../../../../lib/MPDF57/mpdf.php");
$mpdf = new mPDF('C','A4-L');
$mpdf->SetDisplayMode('fullpage');
$stylesheet = file_get_contents('../../../../lib/MPDF57/mpdf.css');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($out);
$mpdf->Output();

mysql_free_result($sql);
?>