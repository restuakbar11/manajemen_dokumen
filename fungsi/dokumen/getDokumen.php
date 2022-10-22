<?php
include('../../config/connect.php');
$id_document = $_POST['id_document'];
        $getData =mysqli_query($koneksi,"select * from t_document where T_DocumentID = '$id_document'");
        // oci_execute($getData);
        $r =mysqli_fetch_array($getData);
        
        $data['id_document']    =$r['T_DocumentID'];
        $data['jns_document']    =$r['T_DocumentM_DocumentTypeID'];
        $data['nm_alat']         =$r['T_DocumentM_SupplierDeviceID'];
        $data['nm_document']     =$r['T_DocumentName'];
        echo json_encode($data);
?>