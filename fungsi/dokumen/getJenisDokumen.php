<?php
include('../../config/connect.php');
$sql = mysqli_query($koneksi,"SELECT * FROM m_documenttype where M_DocumentTypeIsActive='Y'");
$data = array();
while($row = mysqli_fetch_array($sql)){
$data[] = array("id_jenis" => $row['M_DocumentTypeID'], "nm_jenis" => $row['M_DocumentTypeName']);
}
echo json_encode($data);
?>