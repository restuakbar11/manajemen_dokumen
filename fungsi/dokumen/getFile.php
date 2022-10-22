<?php
session_start();
include "../../config/connect.php";
$id = $_POST['id_dokumen'];
$output = "";
$no = 0;
$query = mysqli_query($koneksi,"SELECT T_DocumentDetailName as nama_file, T_DocumentDetailPath as lokasi_file FROM t_documentdetail WHERE T_DocumentDetailT_DocumentID='$id'");
while($row=mysqli_fetch_array($query)) {
     $no++;
	$file = $row['nama_file'];
	$path = $row['lokasi_file'];

     $output .= '
<div>  
     <table >'; 
     $output .= '  
          <tr>  
               <td width="5%"><label>'.$no.'</label></td>  
               <td width="80%"><a href="fungsi/dokumen/pdf.php?path='.$path.'&nama='.$file.'" target="_blank" >'.$file.'</td></a>
               <td width="1%"><a href="fungsi/dokumen/download.php?path='.$path.'&nama='.$file.'" target="_blank" ><i class="fas fa-download"></i></td></a> 
          </tr>

          ';    
$output .= "
     </table>
</div>"; 
}


	
echo $output;  