<?php
error_reporting(0);
session_start();
include "config/connect.php";
///echo $_POST['username'];
///echo $_POST['password'];
$username = $_POST['username'];
$password = MD5($_POST['password']);
$result = mysqli_query($koneksi,"SELECT * from m_user where M_UserName='$username' AND M_UserPassword='$password' and M_UserIsActive='Y'");

//$cek = mysqli_num_rows($result);
 //$sql = "select * from m_user where M_UserName='$username' AND M_UserPassword='$password' and M_UserIsActive='Y'";
    //$hasil=mysql_query($sql);
$r=mysqli_fetch_array($result);
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true){
   echo "Anda dalam keadaan Login. </br> Anda bisa <a href='logout.php'> Keluar. </a>";
}
if(mysqli_num_rows($result) == 0){
    echo"<script>alert('LOGIN Failed, please check your username and password, or contact Web Administrator.');window.history.go(-1);</script>";
}
 else{
 if($_SESSION['signed_in'] = true && $_SESSION['username'] = $r['M_UserName']){

   $_SESSION['supplier'] = $r['M_UserM_SupplierID'];
   $_SESSION['userfullname'] = $r['M_UserFullName'];
   $_SESSION['iduser'] = $r['M_UserID'];
header("Location: index.php");

 }
 else{
 header('location:index.php');
 }
 }
?>