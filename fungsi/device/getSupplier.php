<?php
session_start();
include('../../config/connect.php');
$id_supplier = $_SESSION['supplier'];
$sql = mysqli_query($koneksi,"SELECT * FROM m_supplier where M_SupplierIsActive='Y' AND M_supplierId='$id_supplier'");
$data = array();
while($row = mysqli_fetch_array($sql)){
$data[] = array("id_supp" => $row['M_SupplierID'], "nm_supp" => $row['M_SupplierName']);
}
echo json_encode($data);
?>