$(document).ready(function () {
    $(".meet").hide( 1000 );
    $('.dokumen').load("fungsi/dokumen/show_dokumen.php");
    $("#jns").append('<option value="">-- Select Document Type --</option>'); 
    url = 'fungsi/dokumen/getJenisDokumen.php'; 
      $.ajax({ url: url, 
      type: 'GET', 
      dataType: 'json', 
      success: function(result) { 
        for (var i = 0; i < result.length; i++) 
        $("#jns").append('<option value="' + result[i].id_jenis + '">' + result[i].nm_jenis + '</option>'); 
      } 
    }); 

    $("#alat").append('<option value="">-- Select Device --</option>'); 
    url = 'fungsi/dokumen/getAlat.php'; 
      $.ajax({ url: url, 
      type: 'GET', 
      dataType: 'json', 
      success: function(result) { 
        for (var i = 0; i < result.length; i++) 
        $("#alat").append('<option value="' + result[i].id_alat + '">' + result[i].nm_alat + '</option>'); 
      } 
    });

    $("#jns").change(function () {
      b = $("#jns").val();
      if (b == 8) {
      supp = document.getElementById('supplier').value;  
        $(".meet").show( 1000 );
        $.ajax({
          type: "POST",
          url: "fungsi/dokumen/getPeserta.php",
          data: "supp=" + supp,
          success: function (result) {
            $('.getPeserta').html(result);
          }
        });
      }else{
        $(".meet").hide( 1000 );
      }
    });

});
$(".inputdokumen").click(function(){
    $('#judul').text('Add Document');
    $("#inputdokumen").modal('show');
    $("#act").val('add');
    $('#simpan').text('SAVE');
    $('#inputdokumen').on('shown.bs.modal', function () {
        $('#nomorkartu').focus();
    });
});



$( function() {
  $( ".datepicker" ).datepicker({
    dateFormat: "yy-mm-dd"
  });
});



function clear () {
    $('input[type=text].form-control').val('').attr('readonly',false);
    $('input[type="password"].form-control').val('');
    $('select.form-control').val('');
}



$(".simpan_jenis").click(function(){
  act = document.getElementById('act').value;
  if (act == "add") {
    tambah();
  }else{
    edit();
  }
  
});


$(".cancel").click(function(){
 window.location.reload(true);
  
});




$(document).ready(
  function(){
    tampil_list();
});
function tampil_list () {
  $('.dokumen').load("fungsi/dokumen/show_dokumen.php");
    } 

$(document).on('click', '.restu', function(){
  $('.modal-title').text('File Document Terupload');
  id = $(this).attr('data');
  $.ajax({
        type: "POST", 
        url : "fungsi/dokumen/getFile.php", 
        data: "id_dokumen=" + id, 
        success: function(data){
          $("#showfile").html(data)
          $("#restu").modal('show');
        }   
    });
});

$(document).on('click', '.akbar', function(){
  $('.modal-title').text('Meeting Participant');
  id = $(this).attr('data');
  $.ajax({
        type: "POST", 
        url : "fungsi/dokumen/getMeeting.php", 
        data: "id_dokumen=" + id, 
        success: function(data){
          $("#showfile").html(data)
          $("#restu").modal('show');
        }   
    });
});

$(document).on('click','.hapusdokumen',function(){

var id = $(this).attr('data');
   var checkstr =  confirm('Are you sure want to delete?');
    if(checkstr == true){
    $.ajax({
        type: "POST", 
        url : "fungsi/dokumen/hapus_dokumen.php", 
        data: "id_dokumen=" + id,
        dataType: "json",     
        success: function(data){
         if(data.status=='SUCCESS'){
          Swal.fire({
            title: 'DELETED SUCCESSFULLY',
            text: "Akan Menutup Dalam 2 Detik!!!",
            confirmButtonColor: "#80C8FE",
            type: "success",
            timer: 3500,
            confirmButtonText: "Ya",
            showConfirmButton: true
          });
          $('.dokumen').load("fungsi/dokumen/show_dokumen.php");
          //window.location.replace("index.php?page=dokumen");
        }else{
          Swal.fire({
            title: 'FAILED TO DELETE..!!',
            text: "Akan Menutup Dalam 2 Detik!!!",
            confirmButtonColor: "#80C8FE",
            type: "warning",
            timer: 3500,
            confirmButtonText: "Ya",
            showConfirmButton: true
          });
        }
        }   
    });
    } else{
    return false;
    }
});

$(document).on('click', '.editdokumen', function(){
  $('#defaultModalLabel').text('Edit Dokumen');
  id = $(this).attr('data');
    $.ajax({
        type: "POST", 
        url : "fungsi/dokumen/getDokumen.php", 
                data: "id_document=" + id ,
                dataType: "json",     
              success: function(data){
          if(data){            
             $('#jns').val(data.jns_document).change();
             $('#alat').val(data.nm_alat).change();
             $('#id').val(data.id_document);
             $('#act').val('update');
             $('#simpan').text('UPDATE');
          }
          else{
            alert("Error");
          }
        }   
      });
    $("#inputdokumen").modal('show');
});



function clear(){
  $('input[type=text].form-control').val('');
  $('select.clearform').val('0').change();
}

  function ambilId(fileupload){
    return document.getElementById(fileupload);
  }


function tambah(){
  id = document.getElementById('jns').value;
  idalat = document.getElementById('alat').value;
  fullname = document.getElementById('userfullname').value;
  user_name = document.getElementById('username').value;
  supp = document.getElementById('supplier').value;
  var peserta = [];
  $(':checkbox:checked').each(function(i){
          peserta[i] = $(this).val();
        });
  ambilId("progressBar").style.display = "block";
  var fileupload = ambilId("fileupload").files[0];
  if (fileupload == undefined) {
    alert('Select Document First');
  }else{
    let formData = new FormData();
      formData.append('fileupload', fileupload);
      formData.append('jns', id);
      formData.append('userfullname', fullname);
      formData.append('username', user_name);
      formData.append('supplier', supp);
      formData.append('alat', idalat);
      formData.append('peserta', peserta);
      var ajax = new XMLHttpRequest();
      ajax.upload.addEventListener("progress", progressHandler, false);
      ajax.addEventListener("load", completeHandler, false);
      ajax.addEventListener("error", errorHandler, false);
      ajax.addEventListener("abort", abortHandler, false);
      ajax.open("POST", "fungsi/dokumen/submit_dokumen.php");
      ajax.send(formData);
  }
}

function progressHandler(event){
    ambilId("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
    var percent = (event.loaded / event.total) * 100;
    ambilId("progressBar").value = Math.round(percent);
    ambilId("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
}
function completeHandler(event){
  ambilId("status").innerHTML = event.target.responseText;
  ambilId("progressBar").value = 0;
  tampil_list();
  //window.location.replace("index.php?page=dokumen");
  //alert('1');
}
function errorHandler(event){
  ambilId("status").innerHTML = "Upload Failed";
}
function abortHandler(event){
  ambilId("status").innerHTML = "Upload Aborted";
}
function edit(){
  id_document = document.getElementById('id').value;
  id = document.getElementById('jns').value;
  idalat = document.getElementById('alat').value;
  fullname = document.getElementById('userfullname').value;
  user_name = document.getElementById('username').value;
  supp = document.getElementById('supplier').value;
    const fileupload = $('#fileupload').prop('files')[0];
    let formData = new FormData();
    formData.append('fileupload', fileupload);
    formData.append('id', id_document);
    formData.append('jns', id);
    formData.append('userfullname', fullname);
    formData.append('username', user_name);
    formData.append('supplier', supp);
    formData.append('alat', idalat);
          $.ajax({
            type: 'POST',
            url: "fungsi/dokumen/edit_document.php",
            data: formData,
            dataType:'json',
            cache: false,
            processData: false,
            contentType: false,
            success: function (msg) {
              if (msg.status=='SUCCESS') {
                alert('successfully update document');
                window.location.replace("index.php?page=dokumen");
              }else{
                Swal.fire({
                  title: 'WARNING',
                  text: msg.status+ '..!',
                  type: 'warning',
                  showCancelButton: false,
                  allowOutsideClick: false,
                  position: 'top'
                })
              }
            }
        });
}


