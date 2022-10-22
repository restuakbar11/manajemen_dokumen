<?php
session_start();
include('../../config/connect.php');
$supplier = $_SESSION['supplier'];
$sql = mysqli_query($koneksi,"SELECT * FROM m_supplierdevice where M_SupplierDeviceIsActive='Y' and M_SupplierDeviceM_SupplierID='$supplier'");
$data = array();
while($row = mysqli_fetch_array($sql)){
$data[] = array("id_alat" => $row['M_SupplierDeviceID'], "nm_alat" => $row['M_SupplierDeviceName']);
}
echo json_encode($data);
?>