<?php
include "../../config/connect.php";
$id_dokumen_tipe = $_POST['id_dokumen_tipe'];

$update = mysqli_query($koneksi,"UPDATE m_documenttype SET M_DocumentTypeIsActive='N' WHERE M_DocumentTypeID='$id_dokumen_tipe'");
		if(!$update)
        {
            $return = array('status'=> 'FAILED',
                            'pesan' => 'FAILED TO DELETE..!!');
        } else {
            $return = array('status'=> 'SUCCESS',
                            'pesan' => 'DELETED SUCCESSFULLY');
        }
        echo json_encode($return);
?>