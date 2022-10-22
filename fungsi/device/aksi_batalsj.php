<?php
error_reporting(0);
session_start();
include "../../../../config/koneksi.php";
include "../../../../config/library.php";

$module=$_GET[mod];
$act=$_GET[act];
$surat_jalan= $_POST['surat_jalan'];
$no_so= $_POST['no_so_so'];
$item = $_POST['item'];
$cus = $_POST['customer_id'];
// Hapus produk
if ($module=='surat_jalan' AND $act=='batalsj'){
    $catalog_number   = $_POST[catalog_number];
    
 $id       = $_POST[catalog_number];
  $jml_data = count($id);
  $jumlah   = $_POST[qty]; 
  $id_tt       = $_POST[id_tt];
  
  $lot_number   = $_POST[lot_number];
$id_detail_penjualan_cabang=$_POST[id_detail_penjualan_cabang];
  $satuan=$_POST[satuan];
  $sj=mysql_query("select a.* from penjualan_cabang a
                    where no_surat_jalan_cabang='$_POST[surat_jalan]' and id_cabang='$_SESSION[id_customer]'");
    if (mysql_num_rows($sj) > 0) {

    $k=mysql_fetch_array($sj);
    
        for ($i=1; $i <= $jml_data; $i++){
            if ($id_tt[$i] != 0) {
                // UPDATE TABEL DETAIL TANDA TERIMA
                mysql_query("update detail_ttbarangcabang set qty_terpenuhi_sj=qty_terpenuhi_sj - '".$jumlah[$i]."' 
                where id_detailttbarangcabang='".$id_tt[$i]."' and item='".$item[$i]."' and lot_number='".$lot_number[$i]."'");
                
                // UPDATE TABEL DETAIL SALES ORDER
                $ambil_so= mysql_query("select no_so_so as nmr_so from detail_ttbarangcabang 
                    where id_detailttbarangcabang='".$id_tt[$i]."'");
                $pp= mysql_fetch_array($ambil_so);             
                $dataso= mysql_query("select qty_terpenuhi from detail_so where no_so_so='".$pp[nmr_so]."' and catalog_number='".$id[$i]."' and satuan='".$satuan[$i]."'");
                $ii= mysql_fetch_array($dataso);
                mysql_query("update detail_so set qty_terpenuhi=$ii[qty_terpenuhi]-$jumlah[$i],status=0 
                    where no_so_so='".$pp[nmr_so]."' and catalog_number='".$id[$i]."' and satuan='".$satuan[$i]."' "); 
            }else{
                mysql_query("update detail_barang_gudang set stock=stock + '".$jumlah[$i]."' 
                where catalog_number='".$id[$i]."' and satuan='".$satuan[$i]."' and id_cabang='$_SESSION[id_customer]' and lot_number='".$lot_number[$i]."'");
         
                mysql_query("update barang_gudang set stock=stock + '".$jumlah[$i]."' 
                where catalog_number='".$id[$i]."' and satuan='".$satuan[$i]."' and id_cabang='$_SESSION[id_customer]'");
     
                mysql_query("update history_detail_barang_gudang2 set keterangan='Batal Transaksi',no_transaksi='$surat_jalan',log='$_POST[ket]' 
                            where catalog_number='".$id[$i]."' and satuan='".$satuan[$i]."' and lot_number='".$lot_number[$i]."' and id_cabang='$_SESSION[id_customer]' 
                            order by id_history_detail_barang_gudang2 desc limit 1");
                mysql_query("update history_barang_gudang set keterangan='Batal Transaksi',no_transaksi='$surat_jalan' 
                            where catalog_number='".$id[$i]."' and satuan='".$satuan[$i]."' and id_cabang='$_SESSION[id_customer]' 
                            order by id_history_barang_gudang desc limit 1");

                if($k[no_pbi]!=''){
                $cekpbi=explode('/',$k[no_pbi]);
                    if($cekpbi[2]=='PBI'){
                        mysql_query("update detail_pbi set flag=0 where no_pbi_pbi='$k[no_pbi]' and catalog_number='".$id[$i]."'"); 
                    }else{
                        $query=mysql_query("select id_pbfoc from pbfoc where no_pbfoc='$k[no_pbi]'") ; 
                        $h= mysql_fetch_array($query)  ;
                        mysql_query("update detail_pbi set flag=0 where pbfoc_idpbfoc='$h[id_pbfoc]' and catalog_number='".$id[$i]."'");     
                    }
                }else{
                    $dataso= mysql_query("select qty_terpenuhi from detail_so where no_so_so='".$no_so[$i]."' and catalog_number='".$id[$i]."' and satuan='".$satuan[$i]."'");
                    $ii= mysql_fetch_array($dataso);
                    mysql_query("update detail_so set qty_terpenuhi=$ii[qty_terpenuhi]-$jumlah[$i],status=0 
                    where no_so_so='".$no_so[$i]."' and catalog_number='".$id[$i]."' and satuan='".$satuan[$i]."'"); 
                }

                $cek=mysql_query("select * from detail_penjualan_cabang_barcode where id_detail_penjualan_cabang='$id_detail_penjualan_cabang[$i]'");
            
                if(mysql_num_rows($cek) > 0) {
                    mysql_query("update detail_barang_barcode set flg=0 where catalog_number='".$id[$i]."' and id_detail_penjualan_cabang='$id_detail_penjualan_cabang[$i]'");
                }
            }
                mysql_query("update penjualan_cabang set keterangan='$_POST[ket]', flag_batal=1 
                            where no_surat_jalan_cabang='$_POST[surat_jalan]'");
                 header('location:../../media.php?mod=surat_jalangudang');         
        }
                                            
}else {
    echo "Error tidak Ada Surat Jalan Atau Anda tidak punya hak Akses Batalkan  ";
    
   } 
   
} 
else if ($module=='surat_jalan' AND $act=='batalsj2'){
    
  //  mysql_query("select * from detail_penjualan where id_detail_penjualan='$_GET[id]'");

/*   mysql_query("update detail_barang set stock=stock+ ".$jumlah[$i]." 
                    where catalog_number='".$id[$i]."' and lot_number='".$lot_number[$i]."' and satuan='".$satuan[$i]."'");
     
     mysql_query("update barang set stock=stock+ ".$jumlah[$i]." where catalog_number='".$id[$i]."' and satuan='".$satuan[$i]."' ");
     
     mysql_query("update history_detail_barang set keterangan='Batal Transaksi',no_transaksi='$surat_jalan' 
         where catalog_number='".$id[$i]."' and lot_number='".$lot_number[$i]."' and satuan='".$satuan[$i]."' order by id desc limit 1");
         */
  //  $catalog_number   = $_get
    }
		
	
?>