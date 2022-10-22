<?php
include "../../config/connect.php";

$year = date('Y');
$now =date('Y-m-d H:i:s');
$jam=date('His');
$id_jenis = $_POST['jns'];
$id_alat = $_POST['alat'];
$fullname = $_POST['userfullname'];
$username = $_POST['username'];
$supplier = $_POST['supplier'];
$no_hedaer_dokumen = $username."/".$id_alat."/".$supplier."/".$jam;
$a = $_POST['peserta'];
$peserta = explode (",",$a);
$fileupload   = $_FILES['fileupload']['tmp_name'];
$PdfName    = $_FILES['fileupload']['name'];
$PdfType    = $_FILES['fileupload']['type'];
$PdfSize	= $_FILES['fileupload']['size'];
// echo $PdfName;
// if (is_array($_FILES)) {
// 	foreach($_FILES['fileupload']['name'] as $name => $value){
// 		echo $name;
// 	}
// }
$nm_document = mysqli_query($koneksi,"SELECT M_DocumentTypeName FROM m_documenttype WHERE M_DocumentTypeID='$id_jenis'");
$s = mysqli_fetch_array($nm_document);
$nm_type_document = $s['M_DocumentTypeName'];

$nama_supplier = mysqli_query($koneksi,"SELECT a.M_SupplierName, b.M_SupplierDeviceName from m_supplier a 
	INNER JOIN m_supplierdevice b ON a.M_SupplierID=b.M_SupplierDeviceM_SupplierID WHERE M_SupplierDeviceID='$id_alat'");
$r=mysqli_fetch_array($nama_supplier);
$nm_supplier = $r['M_SupplierName'];
$nm_alat = $r['M_SupplierDeviceName'];


$temp = "D:/manajemen_dokumen/$year/$nm_type_document/$nm_supplier/$nm_alat";
$type = $nm_type_document;
// if ($id_jenis == 1) {
// 	$temp = "D:/manajemen_dokumen/$year/jurnal/";
// 	$type = "jurnal";
// }else if($id_jenis == 2){
// 	$temp = "D:/manajemen_dokumen/$year/manual book/$nm_supplier/$nm_alat/";
// 	$type = "manual_book";
// }else if($id_jenis == 3){
// 	$temp = "D:/manajemen_dokumen/$year/instruction for use/$nm_supplier/$nm_alat/";
// 	$type = "presentasi";
// }else{
// 	$temp = "D:/manajemen_dokumen/$year/meeting/";
// 	$type = "presentasi";
// }

if (($PdfType != "application/pdf") && ($PdfType != "video/mp4")) {
	echo "Format file harus PDF / MP4";
	
}else if($PdfSize > 9120000000){
	echo "Ukuran file terlalu besar";
}else{
$PdfExt = substr($PdfName, strrpos($PdfName, '.'));
    $PdfExt = str_replace('.','',$PdfExt); // Extension
    $PdfNameBaru= $fullname.'_'.$type.'_'.$jam;
    $NewPdfName = $PdfNameBaru.'.'.$PdfExt;
    move_uploaded_file($_FILES["fileupload"]["tmp_name"], $temp.$NewPdfName);
   
	$simpan_header = mysqli_query($koneksi,"INSERT INTO t_document(T_DocumentID,T_DocumentName,T_DocumentM_DocumentTypeID,T_DocumentM_SupplierID,T_DocumentM_SupplierDeviceID,T_DocumentPath,T_DocumentInsertDate,T_DocumentLastUpdate,T_DocumentUserID)
	VALUES('$no_hedaer_dokumen','$NewPdfName','$id_jenis','$supplier','$id_alat','$temp','$now','$now','$username')");

    if ($id_jenis == 8) {
    	foreach ($peserta as $k) {
    			$simpan_detail = mysqli_query($koneksi,"INSERT INTO t_documentmeeting(T_DocumentMeeting_T_documentID,T_DocumentMeetingPath,T_DocumentMeetingName,T_DocumentMeetingParticipantID,M_MeetingParticipantInsertDate,M_MeetingParticipantUserID)
    	VALUES('$no_hedaer_dokumen','$temp','$NewPdfName','$k','$now','$username')");
    	}
    }else{
    // $simpan_detail = mysqli_query($koneksi,"INSERT INTO t_documentdetail(T_DocumentDetailT_DocumentID,T_DocumentName,T_DocumentDetailPath,T_DocumentDetailInsertDate,T_DocumentDetailUserID)
    // 	VALUES('$NewPdfName','$NewPdfName1','$id_jenis','$supplier','$id_alat','$temp','$now','$now','$username')");
    }
	echo "sukses diupload";
}

?>