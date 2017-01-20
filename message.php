<?php
include('includes/connexion.inc.php');

if($pseudo=""){
	$query='SELECT id FROM utilisateurs WHERE pseudo="'.$pseudo.'"';
	$stmt = $pdo->query($query);
	while ($data = $stmt->fetch()){
		$userid=$data['id'];
	}
	
}


if (isset($_POST['message']) && !empty($_POST['message'])) {
	if(!isset($_POST['id']) || empty($_POST['id'])){
		$query = 'INSERT INTO messages (contenu, date, userid) VALUES (:contenu, UNIX_TIMESTAMP())';
		$prep = $pdo->prepare($query);
	}
	else{
		$query = 'UPDATE messages set contenu=(:contenu),  date= UNIX_TIMESTAMP(), userid=(:userid) WHERE id=(:id)';
		$prep = $pdo->prepare($query);
		$prep->bindValue(':id', $_POST['id']);
	}
	$prep->bindValue(':userid', $userid);
	$prep->bindValue(':contenu', $_POST['message']);
	$prep->execute();
}
header('Location:index.php');
?>