<?php error_reporting(E_ERROR | E_WARNING | E_PARSE);


    switch($_GET['page'])
    {
      	 
		case 'dokumen'  : include "modul/dokumen/v_dokumen.php";
		break;	
		case 'pengaturan'  : include "modul/pengaturan/v_pengaturan.php";
		break;
		// master data
		case 'dokumen_tipe'  : include "modul/master/dokumen_tipe/v_dokumen_tipe.php";
		break;	
		case 'device'  : include "modul/master/device/v_device.php";
		break;	
			
		default : include "home.php"; break;
    } ;
?>	