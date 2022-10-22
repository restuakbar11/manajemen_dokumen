$(document).ready(function () {
    $('.device').load("fungsi/device/show_device.php");

    $("#supplier").append('<option value="">-- Select Supplier --</option>'); 
    url = 'fungsi/device/getSupplier.php'; 
      $.ajax({ url: url, 
      type: 'GET', 
      dataType: 'json', 
      success: function(result) { 
        for (var i = 0; i < result.length; i++) 
        $("#supplier").append('<option value="' + result[i].id_supp + '">' + result[i].nm_supp + '</option>'); 
      } 
    }); 

});

$(".inputdevice").click(function(){
    
    $('#judul').text('Add Devices');
    $("#inputdevice").modal('show');
    $("#act").val('add');
    $('#simpan').text('SAVE');
    $('#inputdevice').on('shown.bs.modal', function () {
        $('#nomorkartu').focus();
    });
});

$(".simpan_device").click(function(){
  act = document.getElementById('act').value;
  if (act == "add") {
    tambah();
  }else{
    edit();
  }
  
});

$(document).on('click', '.editdevice', function(){
  $('#defaultModalLabel').text('Edit Devices');
  id = $(this).attr('data');
    $.ajax({
        type: "POST", 
        url : "fungsi/device/getDevice.php", 
                data: "id_device=" + id ,
                dataType: "json",     
              success: function(data){
          if(data){            
             $('#supplier').val(data.id_supplier).change();
             $('#device').val(data.nm_device);
             $('#id').val(data.id_device);
             $('#act').val('update');
             $('#simpan').text('UPDATE');
          }
          else{
            alert("Error");
          }
        }   
      });
    $("#inputdevice").modal('show');
});



function tampil_list () {
  $('.device').load("fungsi/device/show_device.php");
} 

function clear(){
  $('input[type=text].form-control').val('');
  $('select.clearform').val('0').change();
}

function tambah() {
  nm_supplier = document.getElementById('supplier').value;
  nm_device = document.getElementById('device').value;
  username = document.getElementById('username').value;
  $.ajax({
            type: 'POST',
            url: "fungsi/device/submit_device.php",
            data: "nm_device=" + nm_device + "&username=" + username + "&nm_supplier=" + nm_supplier,
            dataType:'json',
            success: function (msg) {
              if (msg.status=='SUCCESS') {
                alert(msg.pesan);
                tampil_list();
              }else{
                Swal.fire({
                  title: msg.status,
                  text: msg.pesan+ '..!',
                  type: 'warning',
                  showCancelButton: false,
                  allowOutsideClick: false,
                  position: 'top'
                })
              }
            }
        });
}

function edit (){
  nm_supplier = document.getElementById('supplier').value;
  nm_device = document.getElementById('device').value;
  username = document.getElementById('username').value;
  id = document.getElementById('id').value;

  $.ajax({
          type: 'POST',
          url: "fungsi/device/edit_device.php",
          data: "supplier=" + nm_supplier + "&device=" + nm_device + "&username=" + username + "&id=" + id,
          dataType:'json',
          success: function (msg) {
            if (msg.status=='SUCCESS') {
              alert(msg.pesan);
              tampil_list();
            }else{
              Swal.fire({
                title: msg.status,
                text: msg.pesan+ '..!',
                type: 'warning',
                showCancelButton: false,
                allowOutsideClick: false,
                position: 'top'
              })
            }
          }
      });
}