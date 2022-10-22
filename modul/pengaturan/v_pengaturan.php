<?php
session_start();
include "config/connect.php";
$username = $_SESSION['username'];
$isLoggedIn = $_SESSION['signed_in'];
$id_user = $_SESSION['iduser'];
$userfullname = $_SESSION['userfullname'];
?>
<div class="main-content">
 <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                                    <div class="card-header">
                                        <strong>Profil Anda</strong> <?php echo $userfullname; ?>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" class="form-horizontal">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <label>Your Fullname :</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-smile-o"></i>
                                                        </div>
                                                        <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo $userfullname; ?>" class="form-control">
                                                        <input type="hidden" name="iduser" id="iduser" value="<?php echo $id_user; ?>" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row form-group">
                                                <div class="col-12 col-md-12">
                                                    <label>Your Username:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                                <i class="fa fa-user"></i>
                                                        </div>
                                                        <input type="text" id="username" name="username" value="<?php echo $username; ?>" class="form-control">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <label>Upload your profile photo :</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-upload"></i>
                                                        </div>
                                                        <input type="file" id="fileupload" name="fileupload" placeholder="Password" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-success btn-sm simpan_profil">
                                            <i class="fa fa-save"></i> Save
                                        </button>
                                        <button type="button" class="btn btn-info btn-sm ganti_pass" data-toggle="modal">
                                            <i class="fa fa-unlock"></i> Change Password
                                        </button>
                                        
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="ganti_pass" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="largeModalLabel"><label id="judul"></label></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                    

                            <div class="col-lg-12">
                                <div class="card-body card-block">
                                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        
                                        <div class="row form-group">
                                            <div class="col col-md-4">
                                                <label class=" form-control-label">Password Lama Anda</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="password" name="password_lama" id="password_lama" class="form-control">
                                                <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $id_user; ?>">
                                            </div>
                                           
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-4">
                                                <label class=" form-control-label">Password Baru Anda</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="password" name="password_baru" id="password_baru" class="form-control">
                                            </div>
                                           
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-4">
                                                <label class=" form-control-label">Ulangi Password</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="password" name="password_baru_ulang" id="password_baru_ulang" class="form-control">
                                            </div>
                                           
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="simpan" class="btn btn-primary ganti_password"></button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>

    </div>

<link href="vendor/datepicker.css" rel="stylesheet" media="all">

<script src="vendor/jquery-3.2.1.min.js"></script>
<script src="vendor/bootstrap-datepicker.js"></script>
<script src="vendor/bootstrap-colorpicker.js"></script>
<script src="modul/pengaturan/pengaturan.js"></script>
