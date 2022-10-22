<?php
session_start();
include "../../config/connect.php";
$username = $_SESSION['username'];
$isLoggedIn = $_SESSION['signed_in'];
$supplier = $_SESSION['supplier'];
$userfullname = $_SESSION['userfullname'];
if ($supplier == 0) {
    $where = "";
}else{
    $where = "and a.T_DocumentM_SupplierID='$supplier'";
}
?>


<div class="col-md-12">
<div class="table-responsive m-b-4">
<table class="table table-striped table-bordered table-hover" id="dataTable">
        <thead bgcolor="bluesky">
            <tr>
                <th>No</th>
                <th>Document Name Type</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            <?php
                                                $no = 0; //batasan halaman

                                                $prodjas = mysqli_query($koneksi,"SELECT M_DocumentTypeID, M_DocumentTypeName from m_documenttype WHERE M_DocumentTypeIsActive = 'Y' ");
                                                while($row=mysqli_fetch_array($prodjas)) { 
                                                    $nama = $row['M_DocumentTypeName'];
                                                $no++; ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $nama; ?></td>
                <td><a href="#" class="btn btn-info btn-sm editdokumentipe" data="<?php echo $row['M_DocumentTypeID']?>" data-toggle="modal" title="Edit"><i class="fa fa-edit"></i></a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
                                    </div>
                                </div>
<script type="text/javascript">
$(document).ready(function () {
    $('#dataTable').DataTable({
         "aLengthMenu": [[2, 10], [2, 10]],
        "iDisplayLength": 2
    });
});
    
</script>