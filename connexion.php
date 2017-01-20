
<?php
include('includes/connexion.inc.php');


$query = 'SELECT pseudo FROM utilisateur WHERE email=:email AND mdp=:mdp';
$prep = $pdo->prepare($query);
$prep->bindValue(':email', $_POST['email']);
$prep->bindValue(':mdp', md5($_POST['mdp']));
$prep->execute();
$count=$prep->rowCount();

if($count!=0){
	$sid=md5($_POST['email'].$_POST['mdp'].time());
	setcookie("cookie", $sid, time()+300);
	$query = 'UPDATE utilisateur SET sid=:sid WHERE email=:email AND mdp=:mdp';
	$prep= $pdo->prepare($query);
	$prep->bindValue(':sid', $sid);
	$prep->bindValue(':email', $_POST['email']);
	$prep->bindValue(':mdp', md5($_POST['mdp']));
	$prep->execute();
	header('Location:index.php');
}
else{
	include('includes/haut.inc.php');
	?>

	<div style="text-align: center;">
		<p class="panel" style="font-size: 2em">Email ou mot de passe incorrect</p>
		<a class="btn btn-danger"  style="font-size: 1.5em" href="index.php">Retour a l'accueil</a>
	</div>
	<?php
	include('includes/bas.inc.php');
}

 ?>
 <script>
 $(document).ready(function(){
 	var idemail=$(input[name=email]);
 	var idmdp=$(input[name=mdp]);
 	
 		$('#form').submit(function()){
 			if($idmdp.val()==null||$idemail.val()=null)
 			{

 			}

 		}
 	})
 </script>