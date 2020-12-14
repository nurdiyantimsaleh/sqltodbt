
<?php
ini_set('display_errors',FALSE);
mysql_connect('192.168.68.229','edp','123456') 
or die ("Gagal Koneksi 229");
mysql_select_db('edpmdo');
set_time_limit(1200000);
?>