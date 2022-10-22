<?php
include "../../config/connect.php";
$id_user = $_POST['id'];
$pass_lama = MD5($_POST['pass_lama']);
$pass_baru = $_POST['pass_baru'];
$pass_baru_ulang = $_POST['pass_baru_ulang'];

$ambil_password = mysqli_query($koneksi,"SELECT M_UserPassword as password FROM m_user WHERE M_UserID='$id_user'");
$r=mysqli_fetch_array($ambil_password);
$password_lama = $r['password'];
if ($pass_lama != $password_lama) {
	$return = array('status' => 'Password Lama Anda Salah');
}else if($pass_baru != $pass_baru_ulang){
	$return = array('status' => 'Password Baru Tidak Sesuai');
}else{
	$password_terbaru = md5($pass_baru_ulang);
	$simpan = mysqli_query($koneksi,"UPDATE m_user set M_UserPassword='$password_terbaru' where M_UserID='$id_user'");
	$return = array('status' => 'SUCCESS');
}
//$return = array('lama_form' => $pass_lama,'lama_tbl' => $password_lama);
echo json_encode($return);
?>