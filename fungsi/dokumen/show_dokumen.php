<?php
session_start();
include "../../config/connect.php";
$username = $_SESSION['username'];
$isLoggedIn = $_SESSION['signed_in'];
$supplier = $_SESSION['supplier'];
$userfullname = $_SESSION['userfullname'];
if ($supplier == 99) {
    $where = "";
}else{
    $where = "and a.T_DocumentM_SupplierID='$supplier'";
}
?>


<div class="table-responsive m-b-40">
<table class="table table-striped table-bordered table-hover" id="dataTable" width="100%">
                                            <thead bgcolor="bluesky">
                                                <tr>
                                                    <th><center>No</center></th>
                                                    <th><center>Document Name</center></th>
                                                    <th><center>Document Type</center></th>
                                                    <th><center>Name</center></th>
                                                    <th><center>Option</center></th>
                                                </tr>
                                            </thead>
                                            <?php
                                                $no = 0; //batasan halaman

                                                $prodjas = mysqli_query($koneksi,"SELECT c.m_supplierName, a.T_DocumentID, b.M_DocumentTypeName FROM t_document a
                                                    INNER JOIN m_documenttype b ON a.T_DocumentM_DocumentTypeID=b.M_DocumentTypeID 
                                                    INNER JOIN m_supplier c ON a.t_documentM_supplierID=c.m_supplierID
                                                    WHERE a.T_documentIsActive = 'Y' $where");
                                                while($row=mysqli_fetch_array($prodjas)) { 
                                                $no++; ?>
                                            <tbody>
                                                <tr>
                                            <td><center><?php echo $no; ?></center></td>
                                            <td><center><?php echo $row['T_DocumentID']; ?></center></td>
                                            <td><center><?php echo $row['M_DocumentTypeName']; ?></center></td>
                                            <td><center><?php echo $row['m_supplierName']; ?></center></td>
                                            <td><center>
                                                <a href="#" class="btn btn-secondary btn-sm restu" data="<?php echo $row['T_DocumentID']?>" data-toggle="modal" title="View File"><i class="fa fa-eye"></i></a>
                                                <a href="#" class="btn btn-secondary btn-sm akbar" data="<?php echo $row['T_DocumentID']?>" data-toggle="modal" title="View Meeting"><i class="fas fa-users"></i></a>
                                               <!--  <a href="#" class="btn btn-info btn-sm editdokumen" data="<?php echo $row['T_DocumentID']?>" data-toggle="modal" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a id="hapusdokumen" class="btn btn-danger btn-sm hapusdokumen" data="<?php echo $row['T_DocumentID'] ?>" style="color:white; width:35px;" title="Hapus"><i class="fa fa-trash"></i></a> -->
                                                </center>
                                            </td>
                                                </tr>
                                                
                                            </tbody>     
                                          <?php
                                          } 
                                          ?>  

                                           
                                        </table>
                                    </div>
                                            <script type="text/javascript">
            $(document).ready(function() {
            $('#dataTable').DataTable();
        } );
        </script>