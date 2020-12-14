<?PHP

$con205=mysql_connect("192.168.68.229","edp","123456") or die('Gagal konek server : '.mysql_error());
	mysql_select_db("edpmdo",$con205)or die('Gagal konek dbase : '.mysql_error());
	
	
	$period = date("ym",strtotime("-1 months"));	
	//=======================================================================================
		$cfile = "D:/XAMPP/HTDOCS/DBT/OK/CIN.DBF";
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
	
	?>