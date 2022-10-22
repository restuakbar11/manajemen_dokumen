<?php
session_start();
include "../../config/connect.php";
// $username = $_SESSION['username'];
// $isLoggedIn = $_SESSION['signed_in'];
// $supplier = $_SESSION['supplier'];
// $userfullname = $_SESSION['userfullname'];
// if ($supplier == 0) {
//     $where = "";
// }else{
//     $where = "and a.T_DocumentM_SupplierID='$supplier'";
// }
?>

<div class="col-md-12">
<div class="table-responsive m-b-40">
<table class="table table-striped table-bordered table-hover" id="dataTable">
                                            <thead bgcolor="bluesky">
                                                <tr>
                                                    <th><center>No</center></th>
                                                    <th><center>Supplier</center></th>
                                                    <th><center>Devices</center></th>
                                                    <th><center>Option</center></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $no = 0; //batasan halaman

                                                $device = mysqli_query($koneksi,"SELECT a.M_SupplierName, b.M_SupplierDeviceName, b.M_SupplierDeviceID FROM m_supplier a
                                                    INNER JOIN m_supplierdevice b ON a.M_SupplierID=b.M_SupplierDeviceM_SupplierID WHERE M_SupplierDeviceIsActive = 'Y' ");
                                                while($row=mysqli_fetch_array($device)) { 
                                                    $nm_supp = $row['M_SupplierName'];
                                                    $nm_device = $row['M_SupplierDeviceName'];
                                                $no++; ?>
                                                <tr>
                                            <td><center><?php echo $no; ?></center></td>
                                            <td><center><?php echo $nm_supp; ?></center></td>
                                            <td><center><?php echo $nm_device; ?></center></td>
                                            <td><center>
                                                <a href="#" class="btn btn-info btn-sm editdevice" data="<?php echo $row['M_SupplierDeviceID']?>" data-toggle="modal" title="Edit"><i class="fa fa-edit"></i></a>
                                                <!-- <a id="hapusdokumen" class="btn btn-danger btn-sm hapusdokumentipe" data="<?php echo $row['M_SupplierDeviceID'] ?>" style="color:white; width:35px;" title="Hapus"><i class="fa fa-trash"></i></a> -->
                                                </center>
                                            </td>
                                                </tr>
                                                
                                          <?php } ?>  
                                            </tbody>     

                                           
                                        </table>
                                    </div>
                                </div>
                                <script type="text/javascript">
            $(document).ready(function() {
            $('#dataTable').DataTable();
        } );
        </script>