<div class="main-content">
 <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <div class="col-lg-12">
                                <!-- USER DATA-->
                                <div class="user-data m-b-30">
                                     <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>Devices List</h3>
                                    <button type="button" class="title-3 m-b-30 au-btn au-btn-icon au-btn--green au-btn--small inputdevice" data-toggle="modal"  
                                            style="margin-left: 20px;">
                                                <i class="zmdi zmdi-plus"></i>Add Devices</button>
                                    <div></div>
                                    
                                     
                                    
                                    <div class="device"></div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal input produk dan jasa -->
            <div class="modal fade" id="inputdevice" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
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
                                                <label for="text-input" class=" form-control-label" >Supplier</label>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <select name="supplier"  id ="supplier" class="form-control" >
                                                </select>
                                                <input type="hidden" id="userfullname" name="userfullname" class="form-control" value="<?php echo $userfullname ?>">
                                                <input type="hidden" id="username" name="username" class="form-control" value="<?php echo $username ?>">
                                                <input type="hidden" id="supplier" name="supplier" class="form-control" value="<?php echo $supplier ?>">
                                                <input type="hidden" id="act" name="act" class="form-control">
                                                <input type="hidden" id="id" name="id" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <label for="text-input" class=" form-control-label" >Devices</label>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <input type="text" id="device" name="device" class="form-control">
                                            </div>
                                        </div>
                                        
                                          
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="simpan" class="btn btn-primary simpan_device"></button>
                            <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ================================ -->
    </div>

<link href="vendor/datepicker.css" rel="stylesheet" media="all">

<script src="vendor/jquery-3.2.1.min.js"></script>
<script src="vendor/bootstrap-datepicker.js"></script>
<script src="vendor/bootstrap-colorpicker.js"></script>
<script src="modul/master/device/device.js"></script>
