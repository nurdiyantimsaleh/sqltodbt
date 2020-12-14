<?php
$prd = date("ym",strtotime("-1 months"));	
$prds=$prd-1;
$prdss=$prds-1;

?><head></head>
<title>BULANAN TOKO</title>
<style>
        body{
            max-width: 1180px;
            width: 60%;
            margin: 56px auto;
            text-align: left;
		
        }
		input {
			  padding: 10px 15px;
			  width: 100%;
		}
		input[type=text]:focus {
		background-color: lightblue;
		}
		select {
		  width: 100%;
		  padding: 10px 15px;
		  border: none;
		  border-radius: 4px;
		  background-color: #f1f1f1;
		}
		table {
			border-radius: 5px;
		}
		p {
			color:#ffffff;
		}
</style>
  
  
  
<table style="text-align: left; width: 100%; height: 180px;" border="0" cellpadding="2" cellspacing="2">	
	<tbody>
		<tr></tr>
		<tr align="center">
			<td colspan="6" rowspan="1" style="vertical-align: top; width: 408px;" class="text_judul" bgcolor="#000000"><h3><p align="center">DBT<?php echo $prd; ?></p>
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top; width: 526px;">
			
			<table style="text-align: left; width: " border="1" cellpadding="2" cellspacing="2">
				<tbody>
					<tr>
						<td style="vertical-align: top; width: 250px;">PROSES DBT</td>
						<td style="vertical-align: top;">:</td>
						<td style="vertical-align: top; width: 250px;"> 
							<form action="http://192.168.68.57/ccd" method="post"> <input value="UNZIP DBT" name="copy" type="submit"></form>	
							<form action="index.php" method="post"> <input type='date' name='tgl'><input value="PROSES" name="proses" type="submit"></form>
						</td>
					</tr>
					
				</tbody>
			</table>
			
			</td>
			<td style="vertical-align: top; width: 526px;">
			
			<table style="text-align: left; 525px;" border="1" cellpadding="2" cellspacing="2">
				<tbody>
					<tr>
						<td style="vertical-align: top; width: 200px;">DOWNLOAD</td>
						<td style="vertical-align: top;">:</td>
						<td style="vertical-align: top; width: 250px;">
							<form action='index.php' method='post'>
								<input name="dbt" value="DBT" type="submit">
							</form>
							<form action='CIN.php' method='post'>
								<input name="cin" value="CIN" type="submit">
							</form>
							<form action='index.php' method='post'>
								<input name="crt" value="CRT" type="submit">
							</form>
						</td>
					</tr>
					
					
				</tbody>
			</table>
			
			</td>
		</tr>
	</tbody>
</table>


<?php 
if (isset($_POST['proses'])){
$tgl=$_POST['tgl'];
$bln=substr($tgl,5,2);
$tgl=substr($tgl,8,2);
include'kon.php';
$del=mysql_query("DELETE FROM CIN");
$del2=mysql_query("DELETE FROM CRT");
$del3=mysql_query("DELETE FROM DBT");

$qry=mysql_query("SELECT * FROM TOKO_STRUKTUR");
while ($d=mysql_fetch_array($qry)){
$kdtk=$d['KDTK'];
$awl=substr($kdtk,0,1);
$akh=substr($kdtk,1,3);

$cin="CIN".$bln.$tgl.$awl.".".$akh;
$dbt="DBT".$bln.$tgl.$awl.".".$akh;
$crt="CRT".$bln.$tgl.$awl.".".$akh;

$del1=mysql_query("DELETE FROM TMP_CIN");
$updcrt=mysql_query("LOAD DATA LOCAL INFILE 'D://XAMPP//HTDOCS//DBT//CRT//$crt' INTO TABLE CRT FIELDS TERMINATED BY ',' ENCLOSED BY '\'' LINES TERMINATED BY '\r\n'  IGNORE 1 LINES");
$updbt=mysql_query("LOAD DATA LOCAL INFILE 'D://XAMPP//HTDOCS//DBT//DBT//$dbt' INTO TABLE DBT FIELDS TERMINATED BY ',' ENCLOSED BY '\'' LINES TERMINATED BY '\r\n'  IGNORE 1 LINES");
$upcin=mysql_query("LOAD DATA LOCAL INFILE 'D://XAMPP//HTDOCS//DBT//CIN//$cin' INTO TABLE TMP_CIN FIELDS TERMINATED BY ',' ENCLOSED BY '\'' LINES TERMINATED BY '\r\n'  IGNORE 1 LINES");
$ins=mysql_query("INSERT INTO CIN SELECT *,'$kdtk' AS KDTK FROM TMP_CIN");

}

}


if (isset($_POST['dbt'])){
$con205=mysql_connect("192.168.68.229","edp","123456") or die('Gagal konek server : '.mysql_error());
	mysql_select_db("edpmdo",$con205)or die('Gagal konek dbase : '.mysql_error());
	
	
	$period = date("ym",strtotime("-1 months"));	
	//=======================================================================================
		$cfile = "D:/XAMPP/HTDOCS/DBT/OK/DEBITTOK.DBF";
		$newfile = array(array("RECID","C",1),
						array("TOKO","C",4),
						array("NAMA","C",35),
						array("STATION","C",2),
						array("SHIFT","C",1),
						array("DOCNO","C",9),
						array("TANGGAL","C",10),
						array("SALESRP","N",12,0),
						array("KDBANK","C",3),
						array("KD_BIN","C",15),
						array("NMBANK","C",30),
						array("NOMOR","C",20),
						array("DEBIT","N",12,0),
						array("AMBILTN","N",12,0),
						array("TYPE","C",1),
						array("TRX_ID","C",20),
						array("TRX_USER","C",10),
						array("TP_TRAN","C",2),
						array("TRANDATE","C",10),
						array("APPRO_CD","C",6),
						array("TRC_NO","C",20),
						array("TRM_ID","C",8),
						array("MERCH_ID","C",15),
						array("MEMBERID","C",16),
						array("EXPIRYDT","C",4),
						array("STS_KRM","C",1),
						array("BATH_NO","C",20),
						array("FEE","N",10,0),
						array("TYPE","C",1),
						array("KASIR_NAME","C",25),
						array("TRANTIME","C",10),);
		if (!dbase_create($cfile,$newfile)) {
		  echo "Error, can't create the database";
		}else {
		$sql_txt="
SELECT A.*,B.NAMA FROM DBT A,TOKO_STRUKTUR B WHERE A.TOKO=B.KDTK;";
		
		$qrtampil=mysql_query($sql_txt) or die("Query gagal !");
						while ($baris = mysql_fetch_array($qrtampil)){
						$db=dbase_open($cfile,2);
						echo "Proses Toko ==>".$baris['TOKO']."\n";
						$val=array($baris[RECID],
									$baris[TOKO],
									$baris[NAMA],
									$baris[STATION],
									$baris[SHIFT],
									$baris[DOCNO],
									$baris[TANGGAL],
									$baris[SALESRP],
									$baris[KDBANK],
									$baris[KD_BIN],
									$baris[NMBANK],
									$baris[NOMOR],
									$baris[DEBIT],
									$baris[AMBILTN],
									$baris[TYPE],
									$baris[TRX_ID],
									$baris[TRX_USER],
									$baris[TP_TRAN],
									$baris[TRANDATE],
									$baris[APPRO_CD],
									$baris[TRC_NO],
									$baris[TRM_ID],
									$baris[MERCH_ID],
									$baris[MEMBERID],
									$baris[EXPIRYDT],
									$baris[STS_KRM],
									$baris[BATH_NO],
									$baris[FEE],
									$baris[TYPE],
									$baris[KASIR_NAME],
									$baris[TRANTIME]);
						$update=dbase_add_record($db,$val) or die ("$baris[recid]");
						echo"$baris[Toko]";
						dbase_close($db);
						}} 
	//=======================================================================================
	
	echo"<script>alert('DBT'); window.location = 'index.php'</script>";

}
if (isset($_POST['cin'])){
$con205=mysql_connect("192.168.68.229","edp","123456") or die('Gagal konek server : '.mysql_error());
	mysql_select_db("edpmdo",$con205)or die('Gagal konek dbase : '.mysql_error());
	
	
	$period = date("ym",strtotime("-1 months"));	
	//=======================================================================================
		$cfile = "D:/XAMPP/HTDOCS/DBT/OK/CINTOK.DBF";
		$newfile = array(array("KDTK","C",4),
						array("NAMA","C",35),
						array("SHIFT","C",1),
						array("STATION","C",2),
						array("DOCNO","C",9),
						array("PRDCD","C",8),
						array("QTY","N",5,0),
						array("CASHIN","N",20,0),
						array("FEE","N",20,0),
						array("NO_HP","C",20),
						array("NO_TRXID","C",20),
						array("TGLTRXID","C",15),
						array("JAMTRXID","C",15),
						array("KD_TRX","C",2),
						array("DBT","C",1),
						array("NO_DBT","C",20),
						array("JENIS","C",20),
						array("KET_JNS","C",30),
						array("ID_PEL","C",14),
						array("NO_TID","C",8),
						array("NO_PAN","C",6),
						array("NO_TRACE","C",10),
						array("NO_APPRO","C",6),
						array("NO_BATCH","C",6),);
		if (!dbase_create($cfile,$newfile)) {
		  echo "Error, can't create the database";
		}else {
		$sql_txt="
SELECT A.*,B.NAMA FROM CIN A,TOKO_STRUKTUR B WHERE A.KDTK=B.KDTK;";
		
		$qrtampil=mysql_query($sql_txt) or die("Query gagal !");
						while ($baris = mysql_fetch_array($qrtampil)){
						$db=dbase_open($cfile,2);
						echo "Proses Toko ==>".$baris['TOKO']."\n";
						$val=array($baris[KDTK],
									$baris[NAMA],
									$baris[SHIFT],
									$baris[STATION],
									$baris[DOCNO],
									$baris[PRDCD],
									$baris[QTY],
									$baris[CASHIN],
									$baris[FEE],
									$baris[NO_HP],
									$baris[NO_TRXID],
									$baris[TGLTRXID],
									$baris[JAMTRXID],
									$baris[KD_TRX],
									$baris[DBT],
									$baris[NO_DBT],
									$baris[JENIS],
									$baris[KET_JNS],
									$baris[ID_PEL],
									$baris[NO_TID],
									$baris[NO_PAN],
									$baris[NO_TRACE],
									$baris[NO_APPRO],
									$baris[NO_BATCH]);
						$update=dbase_add_record($db,$val) or die ("$baris[recid]");
						echo"$baris[KDTK]";
						dbase_close($db);
						}} 
	//=======================================================================================
	
	echo"<script>alert('CIN'); window.location = 'index.php'</script>";

}


if (isset($_POST['crt'])){
$con205=mysql_connect("192.168.68.229","edp","123456") or die('Gagal konek server : '.mysql_error());
	mysql_select_db("edpmdo",$con205)or die('Gagal konek dbase : '.mysql_error());
	
	
	$period = date("ym",strtotime("-1 months"));	
	//=======================================================================================
		$cfile = "D:/XAMPP/HTDOCS/DBT/OK/CRT.DBF";
		$newfile = array(array("RECID","C",1),
						array("TOKO","C",4),
						array("NAMA","C",35),
						array("STATION","C",2),
						array("SHIFT","C",1),
						array("DOCNO","C",9),
						array("TANGGAL","C",10),
						array("SALESRP","N",13,0),
						array("KDBANK","C",3),
						array("KD_BIN","C",15),
						array("NMBANK","C",30),
						array("NOMOR","C",20),
						array("KREDIT","N",12,0),
						array("TRX_ID","C",20),
						array("TRX_USER","C",10),
						array("TP_TRAN","C",2),
						array("TRANDATE","C",10),
						array("APPRO_CD","C",6),
						array("TRC_NO","C",20),
						array("TRM_ID","C",8),
						array("MERCH_ID","C",15),
						array("MEMBERID","C",16),
						array("EXPIRYDT","C",4),
						array("STS_KRM","C",1),
						array("BATH_NO","C",20),
						array("TRANTIME","C",10),);
		if (!dbase_create($cfile,$newfile)) {
		  echo "Error, can't create the database";
		}else {
		$sql_txt="
SELECT A.*,'' AS TRX_USER,'' AS TP_TRAN,'' AS APPRO_CD,'' AS TRC_NO,'' AS TRM_ID,'' AS MERCH_ID,'' AS MEMBERID,'' AS EXPIRYDT,'' AS STS_KRM,'' AS BATH_NO, B.NAMA FROM CRT A,TOKO_STRUKTUR B WHERE A.TOKO=B.KDTK;";
		
		$qrtampil=mysql_query($sql_txt) or die("Query gagal !");
						while ($baris = mysql_fetch_array($qrtampil)){
						$db=dbase_open($cfile,2);
						echo "Proses Toko ==>".$baris['TOKO']."\n";
						$val=array($baris[RECID],
									$baris[TOKO],
									$baris[NAMA],
									$baris[STATION],
									$baris[SHIFT],
									$baris[DOCNO],
									$baris[TANGGAL],
									$baris[SALESRP],
									$baris[KDBANK],
									$baris[KD_BIN],
									$baris[NMBANK],
									$baris[NOMOR],
									$baris[KREDIT],
									$baris[TRX_ID],
									$baris[TRX_USER],
									$baris[TP_TRAN],
									$baris[TRANDATE],
									$baris[APPRO_CD],
									$baris[TRC_NO],
									$baris[TRM_ID],
									$baris[MERCH_ID],
									$baris[MEMBERID],
									$baris[EXPIRYDT],
									$baris[STS_KRM],
									$baris[BATH_NO],
									$baris[TRANTIME]);
						$update=dbase_add_record($db,$val) or die ("$baris[recid]");
						echo"$baris[Toko]";
						dbase_close($db);
						}} 
	//=======================================================================================
	
	echo"<script>alert('CRT'); window.location = 'index.php'</script>";

}

?>