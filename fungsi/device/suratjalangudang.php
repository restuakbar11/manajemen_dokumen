<script type='text/javascript' src='../datepicker/jquery-ui-1.12.1.custom/external/jquery/jquery.js'></script>
<script type="text/javascript" src="../datepicker/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
	<script type="text/javascript" src="../datepicker/datepicker-master/dist/datepicker.js"></script> 
    <style type="text/css" title="currentStyle">		
		@import "../datatable/css/jquery.dataTables.min.css";
		@import "../datepicker/datepicker-master/dist/datepicker.css";
		@import "../datatable/css/jquery-ui-1.8.4.custom.css";
		@import "css/elements.css";  
	</style>

	<script type="text/javascript" language="javascript" src="../datatable/js/jquery.dataTables.min.js"></script>
<script>
function proses(param)
{
if(param==1){
document.getElementById("wait").style.visibility = 'visible';
document.getElementById("klik").style.visibility = 'hidden';
}else{
document.getElementById("wait").style.visibility = 'hidden';
document.getElementById("klik").style.visibility = 'visible';
}
}
$(document).ready(function(){
     var loading = $("#loading");
	var tampilkan = $("#tampilkan");
   var otable = $('#example').DataTable({
	"processing": true,
      "bJQueryUI": true,
    "sPaginationType": "full_numbers",
        "ajax": {
    "url": "modul/mod_suratjalangudang/listsj.php",
    "type": "POST",
    "data": function ( d ) {
        d.start_date = $('#start_date').val();
        d.end_date = $('#end_date').val();
        d.level = $('#level').val();
        d.level2 = $('#level2').val();
    }
    
  },
  "columns" :[
  { "data": 'no' },
        { "data": 'linkno_surat_jalan' },
        { "data": 'nama_costumer' },
        { "data": 'alamat' },
        { "data": 'tanggal' },
        { "data": 'keterangan' },
        { "data": 'nama_petugas' },
        { "data": 'nama_petugas_kembali' },
        { "data": 'aksi' }
      ]
         
               
			}); 
  $("#search").click(function(){ 
		  var start_date = $("#start_date").val();
		  var end_date = $("#end_date").val();
          
          if(start_date !='' && end_date !=''){
            // minDateFilter = new Date(this.value).getTime();
    otable.ajax.url("modul/mod_suratjalangudang/listsj.php").load();
          }
          else
          {
            alert("dfsf");
          }
});
function tampildata(){
    var id_customer = $("#id_customer").val();
        var surat_jalan = $("#surat_jalan").val();
        var tanggal = $("#tanggal").val();
        var tipe_alat = $(".status_alat:checkbox:checked").attr("value");
	 // membuat efek fading
	 tampilkan.hide();
	 loading.fadeIn();

   $.ajax({
    type:"POST",
    url:"modul/mod_suratjalangudang/aksi_suratjalangudang.php",    
    data: "aksi=tampil&id_customer=" +id_customer+ "&surat_jalan=" +surat_jalan+ "&tanggal=" +tanggal,
    success: function(data){                 
			loading.fadeOut();
      tampilkan.html(data);
      tampilkan.fadeIn(2000);
    }  
   });
  }
  
tampildata();

 function listdata(){
    var id_customer = $("#id_customer").val();
	 // membuat efek fading
//	 tampilkan.hide();
	// loading.fadeIn();

   $.ajax({
    type:"POST",
    url:"modul/mod_salesorder/proses_item2.php",    
    data: "id_customer=" +id_customer,
    success: function(data){   
    
                $("#coba").html(data);
    }  
   });
  }
  listdata();
      $( "#tanggal" ).datepicker({
			changeMonth: true,
			changeYear: true,
			format: "yyyy-mm-dd",
		//	yearRange: 'c-90:2014'
		});
  $( ".tgl" ).datepicker({
			changeMonth: true,
			changeYear: true,
			format: "yyyy-mm-dd",
          //  yearRange: 'c-60:c-0'
		});
     $(".closex").click(function(){
        var link=$(this).attr('data');
      //  alert("fjfj");
if(link=='dibawa'){
            // alert(link);
$(".dibawa").css('display','none');
           }
           else if(link=='kembali'){
            //alert(link);
            
$(".kembali").css('display','none');

           }
});    
  $("table").delegate('.div_show', 'click', function() {
    
   // alert("kdkd");
             var $this = $(this); // the <a />
               var no_surat_jalan = $this.attr('data');
               var link = $this.attr('name');
           //    alert (no_faktur,tipe);
           if(link=='dibawa'){
            // alert(link);
$(".dibawa").css('display','block');
           }
           else if(link=='kembali'){
            //alert(link);
            
$(".kembali").css('display','block');

           }
$(".no_surat_jalan").val(no_surat_jalan);
return false;
    });
$(function() {
             
                     $(".petugas").autocomplete(
                     {
                           source: "modul/mod_ppb/proses_staff.php",
                           minLength: 2,
                            select: function( event, ui ) {
               $( ".petugas" ).val( ui.item.value );
              // $( "#merk" ).val( ui.item.merk );
                  return false;
               },
                     })
                      .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li>" )
            .append( "<a>" + item.value +  "</a>" )
            .appendTo( ul );
         };
                     
         //$( "#item" ).autocomplete("option", "position", { my : "right-10 top+10", at: "right top" }) 
               });  
 $("#no_so").change(function(){
        var no_so = $("#no_so").val();
        var surat_jalan = $("#surat_jalan").val();
        var tanggal = $("#tanggal").val();
        $.ajax({
        type: "POST",
        url: "modul/mod_suratjalangudang/aksi_suratjalangudang.php",
        data: "aksi=tampil&no_so=" +no_so+ "&surat_jalan=" +surat_jalan+ "&tanggal=" +tanggal,
        success: function(data){            
		   tampildata();
        }  
    });
});     
   $(".submit").click(function(){
        var nama_petugas = $("#nama_petugas").val();
if(nama_petugas==''){
alert("Nama Petugas belum di isi");
}
else{
	var linkdata = $(this).attr('data');
	if(linkdata=='formdibawa'){
	$("form[name='formdibawa']").submit();
	}
	else if(linkdata=='formkembali')
	{
		
	$("form[name='formkembali']").submit();
	}
}
      });            
$("#tambah").click(function(){
         var item = $("#item").val();
        var id_customer = $("#id_customer").val();
    $.ajax({
        type: "POST",
        url: "modul/mod_suratjalangudang/aksi_suratjalangudang.php",
        data: "aksi=tambah&item=" +item+ "&id_customer=" +id_customer,
        success: function(data){
            tampildata();
 
   $("#item").val("");
 
     }  
    });
  });
   $(".ubahtanggal").dblclick(function(){
        var surat_jalan = $(this).attr('id');
$(location).attr('href','media.php?mod=surat_jalangudang&act=edittanggal&id='+surat_jalan);
});
  $(".status_alat").click(function(){
        tampildata();
});
  });
  
$(document).ready(function(){
   var loading = $("#loading");
	var tampilkan = $("#tampilkan");
   var otable = $('#example2').DataTable({
	"processing": true,
      "bJQueryUI": true,
    "sPaginationType": "full_numbers",
        "ajax": {
    "url": "modul/mod_suratjalangudang/list_listsuratjalan2.php",
    "type": "POST",
    "data": function ( d ) {
        d.start_date = $('#start_date').val();
        d.end_date = $('#end_date').val();
    }
    
  },
  "columns" :[
  { "data": 'no' },
        { "data": 'no_surat_jalan' },
        { "data": 'nama_costumer' },
        { "data": 'alamat' },
        { "data": 'username' },
        { "data": 'keterangan' },
        { "data": 'aksi' }
      ]
         
               
			}); 
  $("#search2").click(function(){ 
		  var start_date = $("#start_date").val();
		  var end_date = $("#end_date").val();
          
          if(start_date !='' && end_date !=''){
            // minDateFilter = new Date(this.value).getTime();
    otable.ajax.url("modul/mod_suratjalangudang/list_listsuratjalan2.php").load();
          }
          else
          {
            alert("dfsf");
          }
});
	});
</script>


<?php	
include "../../config/querysuplier.php";
include"../../config/querysatuan.php";
$aksi="modul/mod_suratjalangudang/aksi_penerimaan.php";
$aksi2="modul/mod_suratjalangudang/aksi_batalsj.php";

  $tgl=date('Y-m-d');
  $last_day = date("Y-m-d", strtotime(" -1 months"));
	switch($_GET['act']){
  // Tampil Produk
  default:
   echo "<h1>Daftar Surat Jalan Gudang</h1><br>";
   if($_SESSION['level']=='admin' or $_SESSION['id_customer'] !=0){
    echo"<input type=button value='Tambah Surat Jalan' onclick=\"window.location.href='?mod=surat_jalangudang&act=suratjalan3';\">
    <input type=button value='Tambah Surat Jalan FOC Cabang' onclick=\"window.location.href='?mod=sjfoccabang';\"> 
<input type=button value='Ubah Qty Surat Jalan' onclick=\"window.location.href='?mod=surat_jalangudang&act=listsuratjalan2';\">

    <input type=button value='Ambil Data Tanda Terima' onclick=\"window.location.href='?mod=surat_jalangudang&act=daftartt';\"><br><br>
";
echo" Tanggal : <input class='tgl' id='start_date' name='start_date' placeholder='Start Date' type='text' value='$last_day'>
<input class='tgl' id='end_date' name='end_date' placeholder='End Date' type='text' value='$tgl'> 
<input type=button value='Search' id='search'>
<input id='level' name='level' type='hidden' value='$_SESSION[level]'>
<input id='level2' name='level2' type='hidden' value='$_SESSION[id_customer]'>";
    }
 echo"</br></br>
            <div class=message id='message'>
	</div><br>";
     echo" <table class='display' id='example'>
          	<thead>
          <tr><th width='2px'>NO</th><th width='50px'>No Surat Jalan</th><th width='200px'>Nama Customer</th>
          <th>Alamat</th>
          <th width='80px'>Username</th>
          <th>Keterangan</th>
          <th>Dibawa</th>
<th>Kembali</th>
          <th width='80px'>Aksi</th></tr> 
          </thead>
          </table>";
          
echo"
 <div id='abc' class='kembali'>";
// Popup Div Starts Here -->
echo"<div id='popupContact'>";
// Contact Us Form -->
echo"<form class='form2' action='$aksi?mod=surat_jalangudang&act=kembali' id='formkembali' method='POST' name='formkembali'>
<img id='close' src='images/cross.png' class='closex' data='kembali'>
<h2>Petugas Kembali</h2>
<hr>
<input class='no_surat_jalan input' id='no_surat_jalan' name='no_surat_jalan'  type='text'>
<input class='petugas input' id='nama_petugas' name='nama_petugas' placeholder='Nama Petugas' type='text'>
<a href=# data='formkembali' id='submit' class='submit'>Simpan</a>
</form>
</div>";
// Popup Div Ends Here -->
echo"</div>";
    
     echo"
 <div id='abc' class='dibawa' name='dibawa'>";
// Popup Div Starts Here -->
echo"<div id='popupContact'>";
// Contact Us Form -->
echo"<form class='form2' action='$aksi?mod=surat_jalangudang&act=titip' id='formdibawa' method='POST' name='formdibawa'>
<img id='close' src='images/cross.png' class='closex' data='dibawa'>
<h2>Petugas Pembawa</h2>
<hr>
<input class='no_surat_jalan input' id='no_surat_jalan' name='no_surat_jalan' placeholder='No Faktur' type='text'>
<input class='petugas input' id='nama_petugas' name='nama_petugas' placeholder='Nama Petugas' type='text'>
<a href=# data='formdibawa' id='submit' class='submit'>Simpan</a>
</form>
</div>";
// Popup Div Ends Here -->
echo"</div>";

    
    break;
    
    case "daftarso" :
    echo "<h1>Daftar Sales Order</h1><br>
            <div class=message id='message'>
	</div><br>";
     echo" <table class='display' id='example'>
          	<thead>
          <tr><th width='2px'>NO</th><th width='50px'>No Sales Order</th><th width='200px'>Nama Customer</th><th>Alamat</th><th width='80px'>Marketing</th></tr> </thead>
          <tbody>";

    $tampil = mysql_query("select so.*,c.nama_costumer,c.alamat from so so
                        left join customer c on so.id_customer_customer=c.id
                        left join detail_so ds on ds.no_so_so=so.no_so
                        where ds.status=0 or ds.qty-ds.qty_terpenuhi > 0
                        group by so.no_so order by so.id_so asc ");
  
    $no = 1;
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r['tgl_masuk']);
      echo "<tr><td>$no</td>
                <td><a href=?mod=surat_jalangudang&act=suratjalan2&id=$r[no_so]&id_customer=$r[id_customer_customer]>$r[no_so]</a></td>
                <td>$r[nama_costumer]</td>
                <td>$r[alamat]</td>
                <td>$r[username]<br><small>$r[date]</small></td>
		        </tr>";
      $no++;
    }
    echo "</tbody></table>";
    
    break;
    
  
    case "suratjalan" :
    echo "<h1>Surat Jalan Cabang</h1><br>
            <div class=message id='message'>
	</div><br>";
  /*  $a=date("Y-m-d");
    $c=mysql_query("select * from sequen_surat_jalan");
  $d=mysql_fetch_array($c);
  $z=mysql_query("SELECT date_format(curdate(),'%Y' )as tahun");
    $c=mysql_fetch_array($z);
  if($d[tahun]==$c[tahun]){
  $e=$d[no_surat_jalan] ;
  }
  else{  
    $e=1;
  } 
  */  $hasil=mysql_query("select *,DATE_FORMAT(tanggal,'%Y-%m-%d') as tanggal2,c.id,c.nama_costumer from penjualan_cabang a
                    left join customer c on c.id=a.id_customer 
                    where a.no_surat_jalan_cabang='$_GET[id]'");
  $zz=mysql_fetch_array($hasil);
  
     echo" 
       <table><td width=100px>Surat Jalan</td>  <td> : <input type=text id='surat_jalan' name='surat_jalan' size=40 value='$zz[no_surat_jalan_cabang]'>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   Tanggal : <input type=text id='tanggal' name='tanggal' size=20 value='$zz[tanggal2]'></td></tr>
     <tr><td>Nama Customer</td>  <td> : <select id='id_customer' name='id_customer'>
       <option value=$zz[id] selected> $zz[nama_costumer] </option>
       </select>
       <table class='statusalat_customer' style='width: auto;display: inline-table;border:0px;'>
      <tr>
        <td style='border:0px;'> <input type='checkbox' value=1 name='replacement_alat' id='replacement_alat' class='status_alat'> Replacement Alat</td>
      </tr>
      <tr>
        <td style='border:0px;'> <input type='checkbox' value=2 name='new_alat' id='new_alat' class='status_alat'> New Alat</td>
      </tr>
       </table>
       </td></tr> 
    <tr><td>Nama Barang</td>  <td> : <div id='coba'>
   </div></td></tr>       
          </table>
          <input type=submit value=Tambah id='tambah' >
          <p>&nbsp;&nbsp;
   <form method=post action='$aksi?mod=surat_jalan&act=update'>  
          <h3>Detail Surat Jalan</h3>
			<div id='loading'><img src='../loading.gif' /></div>
      </br>
      <table id='tampilkan'></table>
     
      <table class='table2'>
      <tr id='th'>
      <td valign='top' width=80px class='td'>keterangan :</td><td class='td'> <textarea id='ket' name='ket' style='width: 270px; height: 100px;'></textarea></td></br>
      </td></tr>
      </table>
       <input type=submit value=Simpan>
       </form>
      ";
      mysql_free_result($hasil);
    
    break;
    
     case "suratjalan2" :
    echo "<h1>Surat Jalan</h1><br>
            <div class=message id='message'>
	</div><br>";
    $a=date("Y-m-d");
    $c=mysql_query("select * from sequen_penjualan_cabang_jakarta where id_customer='$_SESSION[id_customer]'");
  $d=mysql_fetch_array($c);
  $z=mysql_query("SELECT date_format(curdate(),'%Y' )as tahun");
    $c=mysql_fetch_array($z);
  if($d['tahun']==$c['tahun']){
  $e=$d['no_surat_jalan_cabang'] ;
  }
  else{  
    $e=1;
  } 
  $shortcutcabang=$d['shortcutcabang'];
 // mysql_query("insert into penjualan (no_so_so,tanggal,no_surat_jalan,id_customer,keterangan,username)
   //             VALUES('$no_so','$_POST[tanggal] $jam_sekarang','$_POST[surat_jalan]','$_POST[customer_id]','$_POST[ket]','$_SESSION[username]')");
     echo" <form method=post action='$aksi?mod=surat_jalan&act=insert'>
       <table><td width=100px>Surat Jalan</td>  <td> : <input type=text id='surat_jalan' name='surat_jalan' size=40 value='$e/DN$shortcutcabang/GVP/$thn_sekarang'>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   Tanggal : <input type=text id='tanggal' name='tanggal' size=20 value=$a></td></tr>
    <tr><td>No SO</td>  <td> : <input type=text id='no_so' name='no_so' size=40 value='$_GET[id]'></td></tr> 
    </table>
       <input type=submit value=Simpan>
       </form>
      ";
    
    break;
       case "suratjalan3" :
    echo "<h1>Surat Jalan</h1><br>
            <div class=message id='message'>
	</div><br>";
    $a=date("Y-m-d");
    $c=mysql_query("select * from sequen_penjualan_cabang_jakarta where id_customer='$_SESSION[id_customer]'");
  $d=mysql_fetch_array($c);
  $z=mysql_query("SELECT date_format(curdate(),'%Y' )as tahun");
   $c=mysql_fetch_array($z);
  if($d[tahun]==$c['tahun']){
  $e=$d['no_surat_jalan_cabang'] ;
  }
  else{  
    $e=1;
  } 
  $shortcutcabang=$d['shortcutcabang'];
 // mysql_query("insert into penjualan (no_so_so,tanggal,no_surat_jalan,id_customer,keterangan,username)
   //             VALUES('$no_so','$_POST[tanggal] $jam_sekarang','$_POST[surat_jalan]','$_POST[customer_id]','$_POST[ket]','$_SESSION[username]')");
     echo" <form method=post action='$aksi?mod=surat_jalan&act=insert'>
       <table><td width=100px>Surat Jalan</td>  <td> : <input type=text id='surat_jalan' name='surat_jalan' size=40 value='$e/DN$shortcutcabang/GVP/$thn_sekarang'>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   Tanggal : <input type=text id='tanggal' name='tanggal' size=20 value=$a></td></tr>
    <tr><td>Nama Customer</td>  <td> : <select id='customer' name='customer'>
       <option value=0 selected>- Pilih Nama Customer -</option>";
       $sql=mysql_query("select c.id,c.nama_costumer from so a
       left join detail_so b on b.no_so_so=a.no_so
       left join customer c on c.id=a.id_customer_customer
       where a.flg=0 or (b.qty > b.qty_terpenuhi) group by c.id 
       order by nama_costumer");
       while($db=mysql_fetch_array($sql)){
        echo"<option value='$db[id]'>$db[nama_costumer]</option>";
       }
       echo"</select></td></tr> 
    </table>
       <input type=submit id='klik' onclick='proses(1)' style='visibility: visible;' value=Simpan>
	   <label id='wait' style='visibility: hidden;'><font color='red' >Wait...</font></label>
       </form>
      ";
      mysql_free_result($sql);
    
    break;
     case "edit" :
    echo "<h1> Edit Surat Jalan Cabang</h1><br>
            <div class=message id='message'>
	</div><br>";
   // $a=date("Y-m-d");
    $c=mysql_query("select *,DATE_FORMAT(tanggal,'%Y-%m-%d') as tanggal2 
    from penjualan_cabang where no_surat_jalan_cabang='$_GET[id]'");
  $d=mysql_fetch_array($c);
  echo" 
       
       <table><td width=100px>Surat Jalan</td>  <td> : <input type=text id='surat_jalan' name='surat_jalan' size=40 value='$d[no_surat_jalan_cabang]'>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   Tanggal : <input type=text id='tanggal' name='tanggal' size=20 value=$d[tanggal2]></td></tr>
    <tr><td>No SO</td>  <td> : <input type=text id='no_so' name='no_so' size=40 value='$d[no_so_so]'></td></tr> 
    <tr><td>Nama Barang</td>  <td> : <input type=text id='item' size=30></td></tr>       
          </table>
          <input type=submit value=Tambah id='tambah' >
          <p>&nbsp;&nbsp;
   <form method=post action='$aksi?mod=surat_jalan&act=update'>  
          <h3>Detail Pengeluaran Barang</h3>
			<div id='loading'><img src='../loading.gif' /></div>
      </br>
      <table id='tampilkan'></table>
     
      <table class='table2'>
      <tr id='th'>
      <td valign='top' width=80px class='td'>keterangan :</td><td class='td'> <textarea id='ket' name='ket' style='width: 270px; height: 100px;'></textarea></td></br>
      </td></tr>
      </table>
       <input type=submit value=Simpan>
       </form>
      ";
    
    break;
    
    case "barcodebarang" :
    echo"<form action='$aksi?mod=breakdown&act=update' method='POST'>
          <table>
          <tr><td>Kode Barcode </td>  <td> : <input type=text name='kd_barcode' id='kd_barcode' autofocus></td></tr> 
          <tr><td colspan=2><a target=_blank><input type=submit value=Simpan id='break_down' ></a>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table>
         </form>";
    
    break;
     case "batalsj":
    echo "<h1>Surat Jalan</h1><br><br>	";
     $sj=$_GET[id];
    $a=date("Y-m-d");
    $sql10=mysql_query("select p.no_surat_jalan_cabang,c.nama_costumer,c.alamat from penjualan_cabang p
                        JOIN customer c ON p.id_customer = c.id
                        where p.no_surat_jalan_cabang='$_GET[id]'");
                        $k=mysql_fetch_array($sql10);
     echo"  
    <input type=button value='Ubah Jadi Faktur' onclick=\"window.location.href='$aksi?mod=surat_jalan&act=ubah&id=$sj';\"><br>
      <form method=post action=$aksi2?mod=surat_jalan&act=batalsj>   
       <table>
          <tr><td width=100px>Surat Jalan Customer</td>  <td> : <input type=text id='surat_jalan' name='surat_jalan' size=40 value='$k[no_surat_jalan_cabang]'>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   Tanggal : <input type=text id='tanggal' name='tanggal' size=20 value=$a></td></tr>
   <tr><td width=100px rowspan=2>Nama Customer</td>  <td> : <input type=text id='tanggal' name='tanggal' size=20 value='$k[nama_costumer]'></td></tr>
          <tr>  <td>&nbsp; <textarea id='alamat' name='alamat' style='width: 270px; height: 100px;'>$k[alamat]</textarea></td></tr>
          </table></br>
          <p>&nbsp;</p><p>&nbsp;
          <h3>Detail Barang</h3>
      </br>";
      $tampil2=mysql_query("SELECT pen.no_surat_jalan_cabang,dpen.id_detail_penjualan_cabang,dpen.no_so_so, 
        dpen.catalog_number, dpen.item, dpen.qty, dpen.tgl_expaid, dpen.lot_number, dpen.satuan, c.nama_costumer,
        dpen.detailttbarangcabang_id_detailttbarangcabang
                        FROM penjualan_cabang pen
                        JOIN detail_penjualan_cabang dpen ON pen.no_surat_jalan_cabang = dpen.penjualan_cabang_no_surat_jalan_cabang
                        JOIN customer c ON pen.id_customer = c.id
                        WHERE pen.no_surat_jalan_cabang ='$k[no_surat_jalan_cabang]'");
      
     echo" <table>
<tr><th width='120px'>Catalog_number</th><th>Lot Number</th><th>item</th><th width=20px>qty</th><th width=20px>satuan</th><th>Tgl Expaid</th></tr>";
 $no=1;
    while($r=mysql_fetch_array($tampil2)){
        $flag_batal = $r['flag_batal'];
       echo"
       <tr><td align='center'>$r[catalog_number] <input type=hidden id='id_detail_penjualan_cabang$no' name='id_detail_penjualan_cabang[$no]' value='$r[id_detail_penjualan_cabang]'>
       <input type=hidden id='no_so_so$no' name='no_so_so[$no]' value='$r[no_so_so]'>
       <input type=hidden id='catalog_number$no' name='catalog_number[$no]' value='$r[catalog_number]'>
       <input type=hidden id='id_tt$no' name='id_tt[$no]' value='$r[detailttbarangcabang_id_detailttbarangcabang]'></td>
       <td align='center'>$r[lot_number] <input type=hidden id='lot_number$no' name='lot_number[$no]' value='$r[lot_number]'></td>
        <td align='center'>$r[item]</td>
        <td align='center'>$r[qty] <input type=hidden id='qty$no' name='qty[$no]' value='$r[qty]'></td>
        <td align='center'>$r[satuan] <input type=hidden id='satuan$no' name='satuan[$no]' value='$r[satuan]'></td>
        <td align='center'>$r[tgl_expaid]</td>
        </tr>";
        $no++; 
    }
  echo" </table> </br>
  <table class='table2'>
      <tr id='th'>
      <td valign='top' width=80px class='td'>keterangan Batal:</td><td class='td'> <textarea id='ket' name='ket' style='width: 270px; height: 100px;'></textarea></td></br>
      </td></tr>
      </table>";
     
        if ($flag_batal == "1") {
            echo "<h3>Data Sudah Terbatalkan</h3>";
        }else{
            echo"<input type=submit value=Batal onClick='return warning();'></form>";
        }
    
    break;
    
   case "listsuratjalan2" :
    $tgl_now=date('Y-m-d');
    $last_day = date("Y-m-d", strtotime(" -1 months"));
    echo"<h1>Daftar Surat Jalan</h1><br><br>
	
	Tanggal : <input class='tgl' id='start_date' name='start_date' placeholder='start date' type='text' value='$last_day'>
	<input class='tgl' id='end_date' name='end_date' placeholder='end date' type='text' value='$tgl_now'> 
	<input type='submit' value='Search' id='search2'></br></br>
	
    <table class='display' id='example2'>
          	<thead>
          <tr><th width='2px'>NO</th><th width='150px'>No Surat Jalan</th><th width='200px'>Nama Customer</th><th width='250px'>Alamat</th>
<th>Username</th><th>Keterangan</th><th>Aksi</th></tr> </thead>
          ";
/*if($_POST[start_date]!='' && $_POST[end_date]!='') {
	$start_date=$_POST[start_date];
	$end_date=$_POST[end_date];
	if($_SESSION['id_customer'] !=0){
    $tampil=mysql_query("select p.no_so_so,p.no_surat_jalan_cabang as no_surat_jalan,c.nama_costumer,c.alamat,p.username,p.tanggal,p.keterangan from penjualan_cabang p
                        left join customer c on p.id_customer=c.id
                         where id_cabang='$_SESSION[id_customer]' and p.flag_batal=0 and tanggal between '$start_date 00:00:00' and '$end_date 23:00:00' order by id_penjualan_cabang desc");
	}
	else{
    $tampil = mysql_query("select p.no_surat_jalan,c.nama_costumer,c.alamat,p.username,p.tanggal, p.keterangan from penjualan p
                        left join customer c on p.id_customer=c.id
                        where p.flag_batal=0 and tanggal between '$start_date 00:00:00' and '$end_date 23:00:00' order by id_penjualan desc");
	}
} else {
	if($_SESSION['id_customer'] !=0){
    $tampil=mysql_query("select p.no_so_so,p.no_surat_jalan_cabang as no_surat_jalan,c.nama_costumer,c.alamat,p.username,p.tanggal,p.keterangan from penjualan_cabang p
                        left join customer c on p.id_customer=c.id
                         where id_cabang='$_SESSION[id_customer]' and p.flag_batal=0 and tanggal between '$last_day 00:00:00' and '$tgl_now 23:00:00' order by id_penjualan_cabang desc");
	}
	else{
    $tampil = mysql_query("select p.no_surat_jalan,c.nama_costumer,c.alamat,p.username,p.tanggal, p.keterangan from penjualan p
                        left join customer c on p.id_customer=c.id
                        where p.flag_batal=0 and tanggal between '$last_day 00:00:00' and '$tgl_now 23:00:00' order by id_penjualan desc");
	}
}
    $no = 1;
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r['tgl_masuk']);
      echo "<tr><td>$no</td>
                <td>$r[no_surat_jalan]</td>
                <td>$r[nama_costumer]</td>
                <td>$r[alamat]</td>
                <td>$r[username]<br><small>$r[tanggal]</small></td>
                <td>$r[keterangan]</td>
                <td><a href=?mod=surat_jalangudang&act=listubahqty&id=$r[no_surat_jalan]>Ubah Qty </a></td>
		        </tr>";
      $no++;
    }*/
    echo "</table>";
    break;
 case "listubahqty":
    echo "<h1>Surat Jalan $_GET[id]</h1><br><br>	";
     $sj=$_GET['id'];
    $a=date("Y-m-d");
    $sql10=mysql_query("select p.no_surat_jalan_cabang as no_surat_jalan,c.nama_costumer,c.alamat from penjualan_cabang p
                        JOIN customer c ON p.id_customer = c.id
                        where p.no_surat_jalan_cabang='$_GET[id]'");
    $k=mysql_fetch_array($sql10);
     echo"   
       <table>
          <tr><td width=100px>Surat Jalan Customer</td>  <td> : <input type=text id='surat_jalan' name='surat_jalan' size=40 value='$k[no_surat_jalan]'>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   Tanggal : <input type=text id='tanggal' name='tanggal' size=20 value=$a></td></tr>
   <tr><td width=100px rowspan=2>Nama Customer</td>  <td> : <input type=text id='tanggal' name='tanggal' size=20 value='$k[nama_costumer]'></td></tr>
          <tr>  <td>&nbsp; <textarea id='alamat' name='alamat' style='width: 270px; height: 100px;'>$k[alamat]</textarea></td></tr>
          </table></br>
          <p>&nbsp;</p><p>&nbsp;
          <h3>Detail Barang</h3>
      </br>";
      $tampil2=mysql_query("SELECT pen.no_surat_jalan_cabang as no_surat_jalan,dpen.id_detail_penjualan_cabang as id_detail_penjualan, dpen.catalog_number, dpen.item, dpen.qty, dpen.tgl_expaid, dpen.lot_number, dpen.satuan, c.nama_costumer,dpen.no_so_so
                        FROM penjualan_cabang pen
                        JOIN detail_penjualan_cabang dpen ON pen.no_surat_jalan_cabang = dpen.penjualan_cabang_no_surat_jalan_cabang
                        JOIN customer c ON pen.id_customer = c.id
                        WHERE pen.no_surat_jalan_cabang ='$k[no_surat_jalan]' and dpen.qty_terpenuhi=dpen.qty");
      
     echo" <table>
<tr><th>No SO</th><th width='100px'>Catalog_number</th><th>Lot Number</th><th>item</th><th width=20px>qty</th><th width=20px>satuan</th>
<th>Tgl Expaid</th><th>Aksi</th></tr>";
 $no=1;
    while($r=mysql_fetch_array($tampil2)){
       echo"
       <tr><td align='center'>$r[no_so_so] <input type=hidden id='no_so$no' name='no_so_so[$no]' value='$r[no_so_so]'></td>
       <td align='center'>$r[catalog_number] <input type=hidden id='catalog_number$no' name='catalog_number[$no]' value='$r[catalog_number]'></td>
       <td align='center'>$r[lot_number] <input type=hidden id='lot_number$no' name='lot_number[$no]' value='$r[lot_number]'></td>
        <td align='center'>$r[item]</td>
        <td align='center'>$r[qty] <input type=hidden id='qty$no' name='qty[$no]' value='$r[qty]'></td>
        <td align='center'>$r[satuan] <input type=hidden id='satuan$no' name='satuan[$no]' value='$r[satuan]'></td>
        <td align='center'>$r[tgl_expaid]</td>
        <td align='center'><a href=?mod=surat_jalangudang&act=ubahqty&id=$r[id_detail_penjualan]>Ubah</a></td>
        </tr>";
        $no++; 
    }
  echo" </table> </br>
  <table class='table2'>
      <tr id='th'>
      <td valign='top' width=80px class='td'>keterangan Batal:</td><td class='td'> <textarea id='ket' name='ket' style='width: 270px; height: 100px;'></textarea></td></br>
      </td></tr>
      </table>";
    
    break;
    
    case "ubahqty" :
    $sql2=mysql_query("select * from detail_penjualan_cabang where id_detail_penjualan_cabang='$_GET[id]'");
    $hasil2=mysql_fetch_array($sql2);
    echo"<form method=post action='$aksi?mod=surat_jalangudang&act=ubahqty'>
    <table>
    <tr><th>Catalog Number</th><td><input type=hidden id='id_detail' name='id_detail' value='$_GET[id]'>$hasil2[catalog_number]</td></tr>
    <tr><th>Item</th><td><input type=hidden id='surat_jalan' name='surat_jalan' value='$hasil2[penjualan_cabang_no_surat_jalan_cabang]'>$hasil2[item]</td></tr>
    <tr><th>Lot Number</th><td>$hasil2[lot_number]</td></tr>
    <tr><th>Qty</th><td><input type=hidden id='qty_asli' name='qty_asli' value='$hasil2[qty]'>
    <input type=hidden id='satuan_asli' name='satuan_asli' value='$hasil2[satuan]'>$hasil2[qty] $hasil2[satuan]</td></tr>
    <tr><th>Menjadi Qty</th><td><input type=text id='qty_rubah' name='qty_rubah'></td></tr>
    <tr><th>Satuan</th><td><select id='satuan' name='satuan'>
        <option selected>Pilih satuan</option>";
        while($satuan=mysql_fetch_array($sqlsatuan)){
              echo "<option value='$satuan[satuan]'>$satuan[satuan]</option>";
            }
    echo "
        <select></td></tr>
        
          <tr><td colspan=2><input type=submit value=Simpan ></a>
                            <input type=button value=Batal onclick=?mod=surat_jalangudang></td></tr>
          </table></form>";
    break;
   
    case "daftartt" :
     echo "<h1>Surat Jalan</h1><br>
            <div class=message id='message'>
	</div><br>";
   $a=date("Y-m-d");
    $c=mysql_query("select * from sequen_penjualan_cabang_jakarta where id_customer='$_SESSION[id_customer]'");
  $d=mysql_fetch_array($c);
  $z=mysql_query("SELECT date_format(curdate(),'%Y' )as tahun");
   $c=mysql_fetch_array($z);
  if($d['tahun']==$c['tahun']){
  $e=$d['no_surat_jalan_cabang'] ;
  }
  else{  
    $e=1;
  } 
  $shortcutcabang=$d['shortcutcabang'];
 // mysql_query("insert into penjualan (no_so_so,tanggal,no_surat_jalan,id_customer,keterangan,username)
   //             VALUES('$no_so','$_POST[tanggal] $jam_sekarang','$_POST[surat_jalan]','$_POST[customer_id]','$_POST[ket]','$_SESSION[username]')");
     echo" <form method=post action='$aksi?mod=surat_jalangudang&act=insertttbarang'>
       <table><td width=100px>Surat Jalan</td>  <td> : <input type=text id='surat_jalan' name='surat_jalan' size=40 value='$e/DN$shortcutcabang/GVP/$thn_sekarang'>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   Tanggal : <input type=text id='tanggal' name='tanggal' size=20 value=$a></td></tr>
    <tr><td>Nama Customer TT</td>  <td> : <select id='customer' name='customer'>
       <option value=0 selected>- Pilih Nama Customer -</option>";
       $sql=mysql_query("select c.id,c.nama_costumer from tt_barangcabang a
       left join detail_ttbarangcabang b on b.tt_barangcabang_idttbarangcabang=a.id_ttbarangcabang and id_cabang='$_SESSION[id_customer]'
       left join customer c on c.id=a.id_customer
       where (b.qty = b.qty_terpenuhi) and ket_foc=''
       group by c.id 
order by nama_costumer");
       while($db=mysql_fetch_array($sql)){
        echo"<option value='$db[id]'>$db[nama_costumer]</option>";
       }
       echo"</select></td></tr> 
    </table>
       <input type=submit value=Simpan>
       </form>
      ";
      mysql_free_result($sql);  
      
      break;
      
      
     case "detailttbarang" :
            $data=mysql_query("select no_surat_jalan_cabang,nama_costumer from penjualan_cabang a
                                join customer b on a.id_customer=b.id
                                where no_surat_jalan_cabang='$_GET[id]'") ;
        $i=mysql_fetch_array($data);
    $hasil=mysql_query("select b.no_ttbarangcabang,a.catalog_number,a.item,a.lot_number,a.qty,a.satuan,a.id_detailttbarangcabang,a.tgl_expaid,
    b.tanggal,b.keterangan,b.id_customer,c.nama_costumer
                        from detail_ttbarangcabang a
                        right join tt_barangcabang b on a.tt_barangcabang_idttbarangcabang=b.id_ttbarangcabang
                        left join customer c on c.id=b.id_customer
                        where b.ket_foc='' and (qty_terpenuhi_sj < qty and qty=qty_terpenuhi) and b.flag_batal=0 and c.nama_costumer='$i[nama_costumer]'
                        order by no_ttbarangcabang,item"
                        );
  echo" 
      <form method=post action=$aksi?mod=surat_jalangudang&act=ubahttbarang>
    <table><tr><td width=100px>Surat Jalan</td>  <td colspan=6> : <input type=text id='surat_jalan' name='surat_jalan' size=40 value='$i[no_surat_jalan_cabang]'>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   Tanggal : <input type=text id='tanggal' name='tanggal' size=20 value=$a></td></tr>

    <tr><td width=100px rowspan=2>Nama Customer</td>  <td colspan=6> : <select id='customer' name='customer' readonly>
          <option value='$i[id_customer]' selected >$i[nama_costumer]</option>";
    echo "</select></td></tr>
    
          <tr>  <td colspan=6>&nbsp; <textarea id='alamat' name='alamat' style='width: 270px; height: 100px;' disabled>$r[alamat]</textarea></td></tr>
          </table>
          <table>
<tr><th width='150px'>No TT</th><th width='150px'>Catalog Nnumber</th><th width='300px'>Item</th><th>Lot Number</th><th>Tgl Expaid</th><th>Qty</th><th>Satuan</th><th>Aksi</th></tr>";
   
    $no=1;
    while($r=mysql_fetch_array($hasil)){
       echo"<tr>
       <td align='center'>$r[no_ttbarangcabang] <input type='hidden' name='no_tt[$no]' id='no_tt$no' value='$r[no_ttbarangcabang]'> 
       <td align='center'>$r[catalog_number] <input type='hidden' name='catalog_number[$no]' id='catalog_number$no' value='$r[catalog_number]'> 
       <input type=hidden name=id[$no] value=$r[id_detailttbarangcabang]></td>
        <td align='center'>$r[item]<input type=hidden id='item$no' name='item[$no]' value='$r[item]' size=50></td>
        <td align='center'>$r[lot_number]<input type=hidden id='lot_number$no' name='lot_number[$no]' value='$r[lot_number]' size=50></td>
        <td align='center'>$r[tgl_expaid]<input type=hidden id='tgl_expaid$no' name='tgl_expaid[$no]' value='$r[tgl_expaid]' size=50></td>
        <td align='center'><input type=text name='qty[$no]' value=$r[qty] size=5 readonly></td>
        <td align='center'><input type=text name='satuan[$no]' value='$r[satuan]' size=5 readonly></td>
        <td align='center'><input type='checkbox' value='1' id='check[$no]' name='check[$no]'></td>
        </tr>";
        $no++;
        $ket=$r['keterangan'];
        }
       echo" <tr id='th'>
      <td valign='top' width=80px class='td'>keterangan :</td><td class='td' colspan=4> <textarea id='ket' name='ket' style='width: 270px; height: 100px;'>$ket</textarea></td></br>
      </td></tr> </table>
      <br>
      <input type=submit value=Simpan>"; 
      
    mysql_free_result($c);
    mysql_free_result($hasil);
    break; 
  
 }
 ?>
