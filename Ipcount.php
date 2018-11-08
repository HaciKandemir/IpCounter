<?php 
//-----------------------------
		$host = "localhost";
		$db = "****";
		$ad = "****";
		$pw = "****";
		try {
			$vt =new PDO("mysql:host=$host;dbname=$db;","$ad","$pw");
		} catch (PDOException $e) {
			echo $e->getMessage();
		} 
//-----------------------------
		date_default_timezone_set('Europe/Istanbul');
		$onlineIp=$_SERVER['REMOTE_ADDR'];
		$tarih=date('d.m.Y H:i:s');
		echo $onlineIp;
		if ($kontrol=$vt-> query("SELECT COUNT(*) FROM ip WHERE ip='$onlineIp'")) {
			if ($kontrol->fetchColumn()>0) {
				$update=$vt->query("UPDATE ip SET somGiris='$tarih' WHERE ip='$onlineIp' ");
				$metin="Bu Yere 1 den Fazla kez geldiniz";
			}
			else{$metin="Hiç yok";
				$kaydet=$vt->query("INSERT INTO ip SET ip='$onlineIp', adet='1', ilkGiris='$tarih', somGiris='$tarih' ")->fetch(PDO::FETCH_ASSOC);
			}
		}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>ip Sayıcı</title>
</head>
<body>

<h2><?php echo $metin ?></h2>


</body>
</html>
