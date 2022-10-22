<?php
include "../../config/connect.php";
$jam=date('His');
$id_user = $_POST['iduser'];
$username = $_POST['username'];
$fullname = $_POST['nama_lengkap'];
$fileupload   = $_FILES['fileupload']['tmp_name'];
$fotoName    = $_FILES['fileupload']['name'];
$fotoType    = $_FILES['fileupload']['type'];
$fotoSize	= $_FILES['fileupload']['size'];
$temp = "../../images/foto profil/";
$temp_insert = "images/foto profil/";

$ambil_img = mysqli_query($koneksi,"SELECT M_UserFotoProfil from m_user where M_UserID='$id_user'");
$r=mysqli_fetch_array($ambil_img);



if ($fotoType != "image/jpeg") {
	$return = array('status' => 'Format Harus JPG');
}else if($fotoSize > 3104803){
	$return = array('status' => 'Ukuran file terlalu besar');
}else{
	$FotoExt = substr($fotoName, strrpos($fotoName, '.'));
    $FotoExt = str_replace('.','',$FotoExt); // Extension
    $FotoName= $fullname.'_'.$jam;
    $NewFotoName = $FotoName.'.'.$FotoExt;
    unlink($temp.'/'.$r['M_UserFotoProfil']);
    move_uploaded_file($_FILES["fileupload"]["tmp_name"], $temp.$NewFotoName);
    $simpan = mysqli_query($koneksi,"UPDATE m_user set M_UserName='$username', M_UserFullName='$fullname', M_UserFotoProfil='$NewFotoName',M_UserFotoProfilPath='$temp_insert' where M_UserID='$id_user'");
	$return = array('status' => 'SUCCESS');
}
//$return = array('status' => $fotoSize);
echo json_encode($return);
?>