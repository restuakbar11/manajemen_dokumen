<?php
include "../../config/connect.php";

$id_dokumen = $_POST['id_dokumen'];
$update = mysqli_query($koneksi,"UPDATE t_document SET T_DocumentIsActive='N' WHERE T_DocumentID='$id_dokumen'");
		if(!$update)
        {
            $return = array('status'=> 'FAILED');
        } else {
            $return = array('status'=> 'SUCCESS');
        }
        echo json_encode($return);
$ambil_doc = mysqli_query($koneksi,"SELECT T_DocumentPath, T_DocumentName, T_DocumentName1 from t_document WHERE T_DocumentID='$id_dokumen'");
$y = mysqli_fetch_array($ambil_doc);
$temp = $y['T_DocumentPath'];
if($y['T_DocumentName1'] == ""){
    unlink($temp.'/'.$y['T_DocumentName']);
}else{
    unlink($temp.'/'.$y['T_DocumentName']);    
    unlink($temp.'/'.$y['T_DocumentName1']);
}

?>