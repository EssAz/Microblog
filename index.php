<?php
include('includes/connexion.inc.php');
include('includes/haut.inc.php');

?>

<div class="row">              
	<form method="post" action="message.php">
		<div class="col-sm-10">  
			<div class="form-group">
				<textarea id="message" name="message" class="form-control" placeholder="Message"><?php 
					if(isset($_GET['id']) && !empty($_GET['id'])){
						$query='SELECT contenu FROM messages WHERE id='.$_GET['id'];
						$stmt=$pdo->query($query);
						while($data=$stmt->fetch()){
							echo $data['contenu'];
						}
					}
					?></textarea>
					<input type="hidden" id="id" name="id" value="<?php 
					if(isset($_GET['id']) && !empty($_GET['id'])){
						echo $_GET['id'];
					}
					?>"></input>
				</div>
			</div>
			<div class="col-sm-2">
				
				<button type="submit" class="btn btn-success btn-lg">Envoyer</button>
			</div>                        
		</form>
	</div>

	<?php
	$query = 'SELECT contenu, messages.id AS idmess, pseudo, date FROM messages INNER JOIN utilisateur ON utilisateur.id = messages.userid ORDER BY date DESC';
	$stmt = $pdo->query($query);


	while ($data = $stmt->fetch()) {
		?>
		<div class="col-md-8">
			<blockquote>
				<?= $data['contenu'] ?>
				<a role="button" class="btn btn-info btn-default " href="index.php?id=<?=$data['idmess']; ?>">Modifier</a>
				<a role="button" class="btn btn-danger btn-default" href="sup_message.php?id=<?=$data['idmess']; ?>">Supprimer</a>

			</br>
			<?= $data['pseudo'] ?> <?= date("d/m/Y H:i:s", $data['date']) ?> 
		</br>
		
		
		
		
		
	</blockquote></div>
	<?php
}
?>

<?php include('includes/bas.inc.php'); ?>