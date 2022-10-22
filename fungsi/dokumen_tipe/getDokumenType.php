<?php
include('../../config/connect.php');
$id_document_tipe = $_POST['id_document_tipe'];
        $getData =mysqli_query($koneksi,"select M_DocumentTypeID,M_DocumentTypeName from m_documenttype where M_DocumentTypeID = '$id_document_tipe'");
        // oci_execute($getData);
        $r =mysqli_fetch_array($getData);
        
        $data['id_document_tipe']    =$r['M_DocumentTypeID'];
        $data['nm_document_tipe']     =$r['M_DocumentTypeName'];
        echo json_encode($data);
?>