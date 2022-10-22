$(document).ready(function () {
    $('.dokumen_tipe').load("fungsi/dokumen_tipe/show_dokumen_type.php");
});

$(".inputdokumentipe").click(function(){
    clear();
    $('#judul').text('Add Document Type');
    $("#act").val('add');
    $("#inputdokumentipe").modal('show');
    $('#simpan').text('SAVE');
    $('#inputdokumentipe').on('shown.bs.modal', function () {
        $('#nomorkartu').focus();
    });
});

$(".simpan_dokumen_tipe").click(function(){
  act = document.getElementById('act').value;
  if (act == "add") {
    tambah();
  }else{
    edit();
  }
  
});

$(document).on('click', '.editdokumentipe', function(){
  $('#defaultModalLabel').text('Edit Dokumen Type');
  id = $(this).attr('data');
    $.ajax({
        type: "POST", 
        url : "fungsi/dokumen_tipe/getDokumenType.php", 
                data: "id_document_tipe=" + id ,
                dataType: "json",     
              success: function(data){
          if(data){            
             $('#nama_dokumen').val(data.nm_document_tipe).change();
             $('#id').val(data.id_document_tipe);
             $('#act').val('update');
             $('#simpan').text('UPDATE');
          }
          else{
            alert("Error");
          }
        }   
      });
    $("#inputdokumentipe").modal('show');
});

// $(document).on('click','.hapusdokumentipe',function(){

//   var id = $(this).attr('data');
//   var checkstr =  confirm('Are you sure want to delete?');
//     if(checkstr == true){
//     $.ajax({
//         type: "POST", 
//         url : "fungsi/dokumen_tipe/hapus_dokumen_tipe.php", 
//         data: "id_dokumen_tipe=" + id,
//         dataType: "json",     
//         success: function(data){
//          if(data.status=='SUCCESS'){
//           Swal.fire({
//             title: data.status,
//             text: data.pesan,
//             confirmButtonColor: "#80C8FE",
//             type: "success",
//             timer: 3500,
//             confirmButtonText: "Ya",
//             showConfirmButton: true
//           });
//           tampil_list();
//         }else{
//           Swal.fire({
//             title: data.status,
//             text: data.pesan,
//             confirmButtonColor: "#80C8FE",
//             type: "warning",
//             timer: 3500,
//             confirmButtonText: "Ya",
//             showConfirmButton: true
//           });
//           tampil_list();
//         }
//         }   
//     });
//     } else{
//     return false;
//     }
// });

function tampil_list () {
  $('.dokumen_tipe').load("fungsi/dokumen_tipe/show_dokumen_type.php");
} 

function clear(){
  $('input[type=text].form-control').val('');
  $('select.clearform').val('0').change();
}

function tambah() {
  nm_dokumen = document.getElementById('nama_dokumen').value;
  username = document.getElementById('username').value;
  $.ajax({
            type: 'POST',
            url: "fungsi/dokumen_tipe/submit_dokumen_tipe.php",
            data: "nm_dokumen_tipe=" + nm_dokumen + "&username=" + username,
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
  nm_dokumen = document.getElementById('nama_dokumen').value;
  username = document.getElementById('username').value;
  id = document.getElementById('id').value;

  $.ajax({
          type: 'POST',
          url: "fungsi/dokumen_tipe/edit_dokumen_tipe.php",
          data: "nm_dokumen_tipe=" + nm_dokumen + "&username=" + username + "&id_dokumen_tipe=" + id,
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


