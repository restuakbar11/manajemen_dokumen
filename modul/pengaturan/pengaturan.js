$(document).ready(function () {

});

$(".ganti_pass").click(function(){
    $('#judul').text('Change Password');
    $("#ganti_pass").modal('show');
    $("#act").val('add');
    $('#simpan').text('SAVE');
    $('#ganti_pass').on('shown.bs.modal', function () {
        $('#nomorkartu').focus();
    });
});

$(".simpan_profil").click(function(){
nama_lengkap = document.getElementById('nama_lengkap').value;
username = document.getElementById('username').value;
iduser = document.getElementById('iduser').value;
  const fileupload = $('#fileupload').prop('files')[0];
    let formData = new FormData();
    formData.append('fileupload', fileupload);
    formData.append('nama_lengkap', nama_lengkap);
    formData.append('username', username);
    formData.append('iduser', iduser);

    $.ajax({
            type: 'POST',
            url: "fungsi/pengaturan/submit_profil.php",
            data: formData,
            dataType:'json',
            cache: false,
            processData: false,
            contentType: false,
            success: function (msg) {
              if (msg.status=='SUCCESS') {
                alert('Successfully update profile');
                window.location.replace("index.php?page=home");
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
});

$(".ganti_password").click(function(){
id = document.getElementById('id').value;
pass_lama = document.getElementById('password_lama').value;
pass_baru = document.getElementById('password_baru').value;
pass_baru_ulang = document.getElementById('password_baru_ulang').value;
let formData = new FormData();
    formData.append('id', id);
    formData.append('pass_lama', pass_lama);
    formData.append('pass_baru', pass_baru);
    formData.append('pass_baru_ulang', pass_baru_ulang);

    $.ajax({
            type: 'POST',
            url: "fungsi/pengaturan/ganti_password.php",
           data: formData,
            dataType:'json',
            cache: false,
            processData: false,
            contentType: false,
            success: function (msg) {
              if (msg.status=='SUCCESS') {
                alert('successfully change password');
                window.location.replace("logout.php");
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

});