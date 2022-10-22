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


// Upload File
$files = $_FILES;
$jumlahFile = count($files['fileupload']['name']);

//AMBIL NAMA TYPE DOCKUMEN
$nm_document = mysqli_query($koneksi,"SELECT M_DocumentTypeName FROM m_documenttype WHERE M_DocumentTypeID='$id_jenis'");
$s = mysqli_fetch_array($nm_document);
$nm_type_document = $s['M_DocumentTypeName'];

// AMBIL SUPLIER DAN DEVICE
$nama_supplier = mysqli_query($koneksi,"SELECT a.M_SupplierName, b.M_SupplierDeviceName from m_supplier a 
	INNER JOIN m_supplierdevice b ON a.M_SupplierID=b.M_SupplierDeviceM_SupplierID WHERE M_SupplierDeviceID='$id_alat'");
$r=mysqli_fetch_array($nama_supplier);
$nm_supplier = $r['M_SupplierName'];
$nm_alat = $r['M_SupplierDeviceName'];

$temp = "D:/manajemen_dokumen/$year/$nm_type_document/$nm_supplier/$nm_alat/";
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
// 	$type = "meeting";
// }
	

	for ($i = 0; $i < $jumlahFile; $i++) {
    $fileName = $files['fileupload']['name'][$i];
    $fileLokasi = $files['fileupload']['tmp_name'][$i];
    $fileType = $files['fileupload']['type'][$i];
    $fileSize = $files['fileupload']['size'][$i];

    // proses upload
    $fileExt = substr($fileName, strrpos($fileName, '.'));
    $fileExt = str_replace('.','',$fileExt); // Extension
    $fileNameBaru= $fullname.'_'.$type.'_'.$jam.'_'.$i;
    $newFileName = $fileNameBaru.'.'.$fileExt;
    $lokasiBaru = $temp.$newFileName;
    move_uploaded_file($fileLokasi, $temp.$newFileName);

    $simpan_detail = mysqli_query($koneksi,"INSERT INTO t_documentdetail(T_DocumentDetailT_DocumentID,T_DocumentDetailName,T_DocumentDetailPath,T_DocumentDetailInsertDate,T_DocumentDetailUserID)
		VALUES('$no_hedaer_dokumen','$newFileName','$temp','$now','$username')"); 	
}

    if ($id_jenis == 8) {
    		$a = $_POST['peserta'];
			$banyaknya = count($a);
    		for ($j=0; $j < $banyaknya; $j++) { 
			$peserta = $a[$j];
    	
    	$simpan_meeting = mysqli_query($koneksi,"INSERT INTO t_documentmeeting(T_DocumentMeeting_T_documentID,T_DocumentMeetingParticipantID,M_MeetingParticipantInsertDate,M_MeetingParticipantUserID)
		VALUES('$no_hedaer_dokumen','$peserta','$now','$username')");}
    }

$simpan_header = mysqli_query($koneksi,"INSERT INTO t_document(T_DocumentID,T_DocumentM_DocumentTypeID,T_DocumentM_SupplierID,T_DocumentM_SupplierDeviceID,T_DocumentInsertDate,T_DocumentLastUpdate,T_DocumentUserID)
	VALUES('$no_hedaer_dokumen','$id_jenis','$supplier','$id_alat','$now','$now','$username')");
echo "<script>alert('successfully add document');window.location='../../index.php?page=dokumen'</script>";

?>