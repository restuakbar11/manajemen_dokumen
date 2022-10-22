<?php
include "../../config/connect.php";
$now =date('Y-m-d H:i:s');
$nm_dokumen_tipe = $_POST['nm_dokumen_tipe'];
$username = $_POST['username'];

$nm_dokumen = mysqli_query($koneksi,"SELECT COUNT(M_DocumentTypeName) as jumlah from m_documenttype a 
	WHERE M_DocumentTypeName='$nm_dokumen_tipe'");
$r=mysqli_fetch_array($nm_dokumen);

if ($r['jumlah'] > 0) {
	$return = array('status' => 'error',
					'pesan' => 'Data Already Exists');
	echo json_encode($return);
}else{
	$simpan = mysqli_query($koneksi,"INSERT INTO m_documenttype(M_DocumentTypeName,M_DocumentTypeLastUpdate,M_DocumentTypeUserID)
    	VALUES('$nm_dokumen_tipe','$now','$username')");
	mkdir("d:/manajemen_dokumen/2022/$nm_dokumen_tipe");
	$simpan_supplier = mysqli_query($koneksi,"SELECT M_SupplierName from m_supplier");
	while($r=mysqli_fetch_array($simpan_supplier)) {
		$nm_supp = $r['M_SupplierName'];
		mkdir("d:/manajemen_dokumen/2022/$nm_dokumen_tipe/$nm_supp");
	}
	$return = array('status' => 'SUCCESS',
					'pesan' => 'Successfully Submit Document');
	echo json_encode($return);	
}


?>