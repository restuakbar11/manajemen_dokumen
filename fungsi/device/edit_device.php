<?php
include "../../config/connect.php";
$now =date('Y-m-d H:i:s');
$supplier = $_POST['supplier'];
$nm_device = $_POST['device'];
$username = $_POST['username'];
$id_device = $_POST['id'];

// ambil supplier
$supp = mysqli_query($koneksi,"SELECT M_SupplierName from m_supplier a 
	WHERE M_SupplierId='$supplier'");
$s=mysqli_fetch_array($supp);
$folder_lama_supp = $s['M_SupplierName'];

// ambil device
$dev = mysqli_query($koneksi,"SELECT M_SupplierDeviceName from m_supplierdevice WHERE M_SupplierDeviceID='$id_device'");
$s=mysqli_fetch_array($dev);
$folder_lama_device = $s['M_SupplierDeviceName'];


$simpan = mysqli_query($koneksi,"UPDATE m_supplierdevice set M_SupplierDeviceM_SupplierID='$supplier', M_SupplierDeviceName='$nm_device',M_SupplierDeviceUserID='$username', M_SupplierDeviceLastUpdate='$now' where M_SupplierDeviceID='$id_device'");

// ambil supplier baru
$supplier_baru = mysqli_query($koneksi,"SELECT M_SupplierName from m_supplier a 
	WHERE M_SupplierId='$supplier'");
$s=mysqli_fetch_array($supplier_baru);
$folder_baru_supp = $s['M_SupplierName'];

// ubah folder
$ubah_folder_type = mysqli_query($koneksi,"SELECT M_DocumentTypeName from m_documenttype");
while($row=mysqli_fetch_array($ubah_folder_type)) {
	$nm_document = $row['M_DocumentTypeName'];
	rename("d:/manajemen_dokumen/2022/$nm_document/$folder_lama_supp/$folder_lama_device","d:/manajemen_dokumen/2022/$nm_document/$folder_baru_supp/$nm_device");
}

$return = array('status' => 'SUCCESS',
				'pesan' => 'Successfully Update Document Type');
	echo json_encode($return);
?>