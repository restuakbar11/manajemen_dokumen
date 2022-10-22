<?php
include "../../config/connect.php";
$now =date('Y-m-d H:i:s');
$nm_supplier = $_POST['nm_supplier'];
$nm_device = $_POST['nm_device'];
$username = $_POST['username'];

$supp = mysqli_query($koneksi,"SELECT M_SupplierName from m_supplier a 
	WHERE M_SupplierId='$nm_supplier'");
$s=mysqli_fetch_array($supp);
$supplier_name = $s['M_SupplierName'];

$nm_devices = mysqli_query($koneksi,"SELECT COUNT(M_SupplierDeviceName) as jumlah from m_supplierdevice a 
	WHERE M_SupplierDeviceName='$nm_device'");
$r=mysqli_fetch_array($nm_devices);

if ($r['jumlah'] > 0) {
	$return = array('status' => 'error',
					'pesan' => 'Data Already Exists');
	echo json_encode($return);
}else{
	$simpan = mysqli_query($koneksi,"INSERT INTO m_supplierdevice(M_SupplierDeviceM_SupplierID,M_SupplierDeviceName,M_SupplierDeviceLastUpdate,M_SupplierDeviceUserID)VALUES('$nm_supplier','$nm_device','$now','$username')");
	$buat_folder_type = mysqli_query($koneksi,"SELECT M_DocumentTypeName from m_documenttype");
	while($row=mysqli_fetch_array($buat_folder_type)) {
		$nm_document = $row['M_DocumentTypeName'];
		mkdir("d:/manajemen_dokumen/2022/$nm_document/$supplier_name/$nm_device");
	}
	$return = array('status' => 'SUCCESS',
					'pesan' => 'Successfully Submit Document');
	echo json_encode($return);	
}

?>