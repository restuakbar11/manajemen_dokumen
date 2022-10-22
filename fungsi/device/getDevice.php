<?php
include('../../config/connect.php');
$id_device = $_POST['id_device'];
        $getData =mysqli_query($koneksi,"select M_SupplierDeviceID,M_SupplierDeviceM_SupplierID,M_SupplierDeviceName from m_supplierdevice where M_SupplierDeviceID = '$id_device'");
        // oci_execute($getData);
        $r =mysqli_fetch_array($getData);
        
        $data['id_device']    =$r['M_SupplierDeviceID'];
        $data['id_supplier']    =$r['M_SupplierDeviceM_SupplierID'];
        $data['nm_device']     =$r['M_SupplierDeviceName'];
        echo json_encode($data);
?>