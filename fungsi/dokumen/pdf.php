<?php
$pathfile = $_GET['path'];
$namafile = $_GET['nama'];
$file = $pathfile.'/'.$namafile;
$a = explode (".",$namafile);
$eks = $a[1];
if ($eks == "pdf") {
  header('Content-type: application/pdf');
  header('Content-Disposition: inline; filename="' . $file .'"');
  header('Content-Transfer-Encoding: binary');
  header('Accept-Ranges: bytes');
  @readfile($file);
}else{
  header("Content-type: application/msword");
  header("Content-disposition: inline; filename=$file");
  readfile($file);
}
?>
