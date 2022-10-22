<?php
include "../../config/connect.php";
$now =date('Y-m-d H:i:s');
$nm_dokumen_tipe = $_POST['nm_dokumen_tipe'];
$username = $_POST['username'];
$id_dokumen_tipe = $_POST['id_dokumen_tipe'];

$ambil_folder_lama = mysqli_query($koneksi,"SELECT M_DocumentTypeName from m_documenttype where M_DocumentTypeID='$id_dokumen_tipe' ");
$r=mysqli_fetch_array($ambil_folder_lama);
$folder_lama = $r['M_DocumentTypeName'];

$simpan = mysqli_query($koneksi,"UPDATE m_documenttype set M_DocumentTypeName='$nm_dokumen_tipe', M_DocumentTypeUserID='$username', M_DocumentTypeLastUpdate='$now' where M_DocumentTypeID='$id_dokumen_tipe'");
rename("d:/manajemen_dokumen/2022/$folder_lama","d:/manajemen_dokumen/2022/$nm_dokumen_tipe");
$return = array('status' => 'SUCCESS',
				'pesan' => 'Successfully Update Document Type');
	echo json_encode($return);
?>