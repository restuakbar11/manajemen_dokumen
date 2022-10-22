<?php
include "../../config/connect.php";

$now =date('Y-m-d H:i:s');
$jam=date('His');
$id_dokumen = $_POST['id'];
$id_jenis = $_POST['jns'];
$id_alat = $_POST['alat'];
$fullname = $_POST['userfullname'];
$username = $_POST['username'];
$supplier = $_POST['supplier'];
$fileupload   = $_FILES['fileupload']['tmp_name'];
$PdfName    = $_FILES['fileupload']['name'];
$PdfType    = $_FILES['fileupload']['type'];
$PdfSize	= $_FILES['fileupload']['size'];

$nama_supplier = mysqli_query($koneksi,"SELECT a.M_SupplierName, b.M_SupplierDeviceName from m_supplier a 
	INNER JOIN m_supplierdevice b ON a.M_SupplierID=b.M_SupplierDeviceM_SupplierID 
	WHERE M_SupplierDeviceID='$id_alat'");

$r=mysqli_fetch_array($nama_supplier);
$nm_supplier = $r['M_SupplierName'];
$nm_alat = $r['M_SupplierDeviceName'];
if ($id_jenis == 1) {
	$temp = "../../dokumen/2022/jurnal/";
	$temp_insert = "dokumen/2022/jurnal";
	$type = "jurnal";
}else if($id_jenis == 2){
	$temp = "../../dokumen/2022/manual book/$nm_supplier/$nm_alat/";
	$temp_insert = "dokumen/2022/Manual Book/$nm_supplier/$nm_alat";
	$type = "manual_book";
}else{
	$temp = "../../dokumen/2022/instruction for use/$nm_supplier/$nm_alat/";
	$temp_insert = "dokumen/2022/instruction for use/$nm_supplier/$nm_alat";
	$type = "presentasi";
}

if ($PdfType != "application/pdf") {
	$return = array('status' => 'Format file harus PDF');
}else if($PdfSize > 512000000){
	$return = array('status' => 'Ukuran file terlalu besar');
}else{
	$PdfExt = substr($PdfName, strrpos($PdfName, '.'));
    $PdfExt = str_replace('.','',$PdfExt); // Extension
    $PdfName= $fullname.'_'.$type.'_'.$jam;
    $NewPdfName = $PdfName.'.'.$PdfExt;

    $ambil_doc = mysqli_query($koneksi,"SELECT T_DocumentName from t_document WHERE T_DocumentID='$id_dokumen'");
    $y = mysqli_fetch_array($ambil_doc);
    unlink($temp.'/'.$y['T_DocumentName']);

    move_uploaded_file($_FILES["fileupload"]["tmp_name"], $temp.$NewPdfName);
    $simpan = mysqli_query($koneksi,"UPDATE t_document set T_DocumentM_DocumentTypeID='$id_jenis', T_DocumentM_SupplierDeviceID='$id_alat', T_DocumentName='$NewPdfName', T_DocumentPath='$temp_insert' where T_DocumentID='$id_dokumen'");
	$return = array('status' => 'SUCCESS');
}
echo json_encode($return);
?>