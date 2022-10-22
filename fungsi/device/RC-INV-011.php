<?php
date_default_timezone_set("Asia/Bangkok");
ob_start();
ini_set('memory_limit', '500M');

include "../../config/connect.php";
$startdate = date('Y-m-d', strtotime($_GET['startdate']));
$finishdate = date('Y-m-d', strtotime($_GET['finishdate']));
$tgl = date('Y-m-d');
$kode_laporan = $_GET['kode_laporan'];
$id_kulkas = $_GET['id_kulkas'];
$namaKulkas = "SELECT NAMAGUDANG as NAMA_KULKAS from M_KULKAS k
JOIN M_GUDANG g ON g.ID_GUDANG=k.ID_GUDANG 
where kode_kulkas='$id_kulkas' ";
$getKulkas = $mysqli->query($namaKulkas);
// oci_execute($getKulkas);
while ($row = mysqli_fetch_array($getKulkas)) {
	$nm_kulkas = $row['NAMA_KULKAS'];
}
if ($id_kulkas == 'all') {
	$kulkas = " ";
	$judul = "ALL FIOCCHETTI";
} else {
	$kulkas = " and KODE_KULKAS = '$id_kulkas'";
	$judul = $nm_kulkas;
}

echo "
<style>
table.layout {
	font-family: Arial Black;
	font-size: 12px;
	border: 1px solid black;
	border-collapse: black;
}
td.layout { 
	font-family: Arial Black;
	font-size: 12px;
	border:1px solid black;
	text-align:center;
}
td.kiri { 
	font-family: Arial Black;
	font-size: 12px;
	border:1px solid black;
	text-align:left;
}
th.layout { 
	font-family: Arial Black;
	font-size: 12px;
	text-align:center;
	border:1px solid black;
}
</style>";

//HEADER
echo "
<table width='100%' id='table_report'>
    		<tr>
                <th>LAPORAN LOG TEMPERATUR & VOLTAGE (PKL 7:00 dan 16:00) </th>				
			</tr>
			<tr>
			<th>$judul</th>
			</tr>
			<tr>
				<td align='center'>Periode : $startdate sampai $finishdate</td>
			</tr>
</table>
<hr>";

//get All Kulkas
if ($id_kulkas == 'all') {

	include '../kulkas/queryGetKulkas.php';
	while ($u = mysqli_fetch_array($queryGetKulkas)) {
		echo '<b>' . $u['NAMA_KULKAS'] . '</b>';

		echo "
	<table width='100%' class='layout'  id='table_report'>
		<thead>
			<tr>
				<th class='layout' width='20%'>Tanggal</th>
				<th class='layout' width='20%'>Jam</th>
				<th class='layout' width='20%'> Temperatur &#8451;</th>
				<th class='layout' width='20%'> Voltage (V)</th>
				<th class='layout' width='20%'> Daya (VA)</th>
			</tr>
		</thead>
									  
		<tbody>";
		$no = 1;
		$query = "select * from KULKAS_DATA_LOG
		where TANGGAL between '$startdate' and '$finishdate'
		and JAM in ('07:00:00','16:00:00') AND KODE_KULKAS = '$u[KODE_KULKAS]'
		group by TANGGAL,JAM";

		echo $query;

		$getData = $mysqli->query($query);
		// oci_execute($getData);
		while ($row = mysqli_fetch_array($getData)) {


			echo "
			<tr>";

			echo "
					<td class='kiri'>$row[TANGGAL]</td>
					<td class='kiri'>$row[JAM]</td>
					<td class='kiri'>$row[COLD_ROOM]</td>
					<td class='kiri'>$row[VOLTAGE]</td>
					<td class='kiri'>$row[POWER]</td>
			</tr>";
			$no++;
		}
		echo "
	</tbody>
</table><br>";
	}
} else {


	//ISI
	echo "
<table width='100%' class='layout'  id='table_report'>
	<thead>
		<tr>
		<th class='layout' width='20%'>Tanggal</th>
		<th class='layout' width='20%'>Jam</th>
		<th class='layout' width='20%'> Temperatur &#8451;</th>
		<th class='layout' width='20%'> Voltage (V)</th>
		<th class='layout' width='20%'> Daya (VA)</th>
		</tr>
	</thead>
								  
	<tbody>";


	$no = 1;
	$query = "select * from KULKAS_DATA_LOG
	where TANGGAL between '$startdate' and '$finishdate'
	and JAM in ('07:00:00','16:00:00') $kulkas
	group by TANGGAL,JAM";



	$getData = $mysqli->query($query);
	// oci_execute($getData);
	while ($row = mysqli_fetch_array($getData)) {

		echo "
			<tr>";

		echo "
					<td class='kiri'>$row[TANGGAL]</td>
					<td class='kiri'>$row[JAM]</td>
					<td class='kiri'>$row[COLD_ROOM]</td>
					<td class='kiri'>$row[VOLTAGE]</td>
					<td class='kiri'>$row[POWER]</td>
			</tr>";
		$no++;
	}
	echo "
	</tbody>
</table>";
}

include('getReport_P.php');
