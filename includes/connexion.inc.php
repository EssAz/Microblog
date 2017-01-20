<?php
$pdo = new PDO('mysql:host=localhost;dbname=micro_blog', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

$query='SELECT * FROM utilisateur WHERE sid=:sid';
$prep=$pdo->prepare($query);
$prep->bindValue(':sid', $_COOKIE['cookie']);
$prep->execute();
$count=$prep->rowCount();
if($count!=0){
	while ($data=$prep->fetch())
	{
		$pseudo=$data['pseudo'];
	}	
}
else{
	$pseudo="";
}
?>