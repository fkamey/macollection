<?php
	 /*
ini_set('display_errors', 1);
	 error_reporting(E_ALL);
*/

try {
    $bdd = new PDO('mysql:host=localhost;dbname=camilleflorquin_collection', 'camilleflorquin', 'cENPyultvNpth67x');
}

catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
}

    session_start();

		$email = $_POST['email'];
		$password = $_POST['password'];


		if($email && $password) {

			
			$reponse = $bdd->query("SELECT id, pseudo, name, img FROM user WHERE email='$email' AND password=password('$password')");
			$donnees = $reponse->fetch();

			if($donnees['id']) {
				$_SESSION['collection'] = $donnees['id'];
				$_SESSION['collectionuser'] = $donnees['pseudo'];
				$_SESSION['collectionname'] = $donnees['name'];
				$_SESSION['collectionimg'] = $donnees['img'];
			}

		}




		if($_GET['action']=='deauth') {
			$_SESSION['collection']='';

			echo "
				<script type='text/javascript'>
					window.location.href='index.php';
				</script>
			";

		}


		if($_GET['action']=='reloadname') {

			$iduser = $_GET['iduser'];
    		$newpseudo = $_GET['newpseudo'];

			$_SESSION['collectionuser']=$newpseudo;
			$reponseiduser = $bdd->query("UPDATE user SET pseudo='$newpseudo' WHERE id=$iduser");

		}


		if($_GET['action']=='reloadimg') {

			$iduser = $_GET['iduser'];
    		$newimg = $_GET['newimg'];

			$_SESSION['collectionimg']=$newimg;
			$reponseiduser = $bdd->query("UPDATE user SET img='$newimg' WHERE id=$iduser");

		}

/*---------------------*/

			if(!empty($_FILES))
		{
			$avatar = $_FILES['thumbnails'];
			$avatar_name = $avatar['name'];
				
			$ext = strtolower(substr(strrchr($avatar_name,'.'),1));
			$ext_aut = array('jpg','jpeg','png','gif' );

			function check_extension($ext,$ext_aut)
			{
				if(in_array($ext, $ext_aut))
				{
					return true;
				}
			}

			$valid = (!check_extension($ext,$ext_aut)) ? false : true;
			$erreur = (!check_extension($ext,$ext_aut)) ? 'Veuillez charger une image' : '';

			if ($valid) {
				$max_size = 8000000;
				if($avatar['size']>$max_size){
					$valid = false;
					$erreur = 'Fichier trop lourd';
				}
			}

			if($valid)
			{
				if ($avatar['error']>0) {
					$valid = false;
					$erreur = 'Erreur lors du transfert';
				}
			}

			if($valid)
			{
				$path_to_image = 'img/cartouches/';

				$filename = sha1(uniqid($avatar_name));

				$source = $avatar['tmp_name'];
				$target = $path_to_image . $filename . '.' . $ext;

				move_uploaded_file($source, $target);

				if($ext == 'jpg' || $ext == 'jpeg'){$im = imagecreatefromjpeg($path_to_image . $filename . '.' . $ext);}

				if($ext == 'png'){$im = imagecreatefrompng($path_to_image . $filename . '.' . $ext);}

				if($ext == 'gif'){$im = imagecreatefromgif($path_to_image . $filename . '.' . $ext);}

				$nom_image = $filename . '.' . $ext;	
				
				$date = $_POST['date'];
				$description = $_POST['description'];
				$title= $_POST['title'];
				$iduser = $_GET['iduser'];

				$req = $bdd->prepare('INSERT INTO notes (user_id, title, date, img, description) VALUES(:user_id, :title, :date, :img, :description)');
				$req ->execute(array('user_id'=>$iduser, 'date'=>$date, 'img'=>$nom_image, 'description'=>$description, 'title'=>$title	));

				$req ->closeCursor();

			}
			
		}	

?>


<!DOCTYPE html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="user-scalable=no, initial-scale=1" />
	<meta name="mobile-web-app-capable" content="yes">

	<title>Ma Collection de Cartouches</title>

	<meta name="apple-mobile-web-app-title" content="Ma Collection de Cartouches">

	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">


	<link rel="stylesheet" type="text/css" href="museo/stylesheet.css">

	<link rel="shortcut icon" href="img/favicon.ico">
	<link rel="icon" type="image/png" href="img/favicon.png">

	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="img/collection-57px.png">

	
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js?ver=1.7.1'></script>

	<script type="text/javascript" src="js/scripthead.js"></script>



  <link rel='stylesheet prefetch' href='http://dimsemenov-static.s3.amazonaws.com/dist/magnific-popup.css'>

  <script src="js/prefixfree.min.js"></script>

</head>



<?php

	if ($_SESSION['collection']=='') {

			$nom=$_POST['nom'];
			$username=$_POST['username'];
			$mdp=$_POST['mdp'];
			$email=$_POST['email'];


			if ($_POST['action']=='adduser') {
				
				if ($nom && $username && $mdp && $email) {
					
					$addinguser = $bdd->query("INSERT INTO user (pseudo, name, email, password, img) VALUES ('$username','$nom','$email',password('$mdp'), 'img/user.jpg')");
					echo "<p class='message'>Votre compte a bien été créé !</p>";
				} else {
					echo "<p class='message'>Oups, il semble qu'il y ai une erreur!</p>";
				} 
				
			}

?>

<body id="start-up">

	<header>
	
		<h1>Ma Collection</h1>
		<p>Complétez votre collection de cartouches</p>
	
	
		<div id="social">
		
				<?php

					// On charge la config et les librairies
					include('../config/config.php');
					
					// create a new TwitterAvatars object
					$ta = new TwitterApp(new tmhOAuth($config));
					
					// check our authentication status
					if($ta->isAuthed()) {
					$success = true;
					}
					// did the user request authorization?
					elseif(isset($_POST['auth'])) {
					
					// start authentication process
					$ta->auth();
					}
					
					
				?>
		
				<?php if(isset($success)): ?>

				
				<?php
				echo 'access_token : '.$_COOKIE['access_token'].'<br />';
				echo 'access_token_secret : '.$_COOKIE['access_token_secret'];
				?>
				
				<?php elseif(isset($error)): ?>
					<p>Error. <a href="index.php">Try again?</a></p>
				
				<?php else: ?>
				<form action="" method="post">
				<input type="hidden" value="1" name="auth" />
				<input class="tw" type="image" src="img/tw.png"
				alt="Connect to Twitter" name="auth" value="1">
				</form>
			
				<?php endif; ?>
			<a href="#" class="fb"><img src="img/fb.png" alt=""></a>
		</div>

	</header>
	


	<div id="connexion">
	
		<form method="post">
			<div id="co">
				<input type="text" class="name" name='email' placeholder="exemple@email.com">
				<input type="password" class="password" name='password' placeholder="Mot de Passe">
			
			</div>
			
			
			<input type="submit" id="log" value="Se connecter">
			
		</form>
			
			<div id="plus">
			
				
				<div class="inline-popups">
					<a href="#test-popup" data-effect="mfp-zoom-in">
					
						<div id="signup">
							<p>S'inscrire</p>
						</div>
					</a>
					
					
				</div>
			</div>
	</div>
	

	
<!-- Popup itself -->
<div id="test-popup" class="white-popup mfp-with-anim mfp-hide">
	
	
	<p class="titrepopup">Créer un nouveau compte</p>
	
	
		<form method="post">
			
			
				<p class="infotext">Nom</p>
				<input type="text" class="nom" name='nom' placeholder="Jean Dupond">
				
				<p class="infotext">Pseudo</p>
				<input type="text" class="username" name='username' placeholder="JeanD">
				
				<p class="infotext">Mot de Passe</p>
				<input type="password" class="mdp" name='mdp' placeholder="Mot de passe">
				
				<p class="infotext">Email</p>
				<input type="text" class="email" name='email' placeholder="exemple@email.com">
			
	
			<input type="hidden" name="action" value="adduser">
			<input type="submit" id="signin" value="S'inscrire">
			
	
			
		</form>
	
	
</div>
	

  <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>
  <script src='http://dimsemenov-static.s3.amazonaws.com/dist/jquery.magnific-popup.min.js'></script>

  <script src="js/index.js"></script>


</body>



<?php
	
	} else { 

		?>

<body id="app" class="clearfix">



<script type='text/javascript' src="js/jquery.sidr.min.js"></script>



 
<div id="sidr" class="menu-reveal">
	
	<a href="javascript:DisplayPages('settingsuser', 'settings');">
	<?php echo "<img src='".$_SESSION['collectionimg']."'>"; ?>

	<?php echo "<h2> ".$_SESSION['collectionuser']."</h2>"; ?>
	<?php echo "<h3> ".$_SESSION['collectionname']."</h3>"; ?>
	</a>

  <ul class="menu-reveal" id="nav">
    <li id="home" class="active"><a href="javascript:DisplayPages('index', 'home');" class="menu-reveal-link">Toutes les Cartouches</a></li>
    <li id="favorites"><a href="javascript:DisplayPages('favorisuser', 'favorites');" class="menu-reveal-link">Mes Cartouches</a></li>
    <li id="about"><a href="javascript:DisplayPages('aboutapp', 'about');" class="menu-reveal-link">A Propos</a></li>
    <li id="settings"><a href="javascript:DisplayPages('settingsuser', 'settings');" class="menu-reveal-link">Mon Compte</a></li>
  </ul>

  <a href="?action=deauth" id="logout">Se Déconnecter</a>
</div>

<div id="page">

	<header>
		<a id="simple-menu" href="#sidr" onclick="activemenu();">Toggle menu</a>

		<a id="search" href="javascript:DisplayPages('searchnote', 'search');">Search</a>

		<h1>Ma Collection</h1>


	</header>

<?php
		if($_GET['action']=='deleteuser') {

			$id=$_SESSION['collection'];
			
			$delete = $bdd->query("DELETE FROM user WHERE id=$id");

			$_SESSION['collection']='';

			echo "<p class='message'>Votre compte a bien été supprimé</p>";
			



			echo "
				<script type='text/javascript'>

				setTimeout(function(){
					window.location.href='index.php';
				}, 2000);

				</script>
			";

		}



?>



	<div id="index" class="clearfix page">
	
	


	
		<p id="presentation">Bienvenue sur "Ma Collection". Vous trouverez ici toutes les cartouches de jeu pour Game Boy. Ajoutez les cartouches que vous possédez à votre collection en cliquant sur le "plus". Vous pouvez aussi compléter "Ma collection" et y apporter votre contribution.</p>
			<h2>Toutes les cartouches</h2>
		<div id="portfolio">
		
		<div class="inline-popups">
		<a href="#donnerinfo" data-effect="mfp-zoom-in" class="bloc">
			<img src="img/cartouches/plus.jpg" alt="Ajoutez une cartouche"/>
		</a>
		<p class="infoplus"> En cliquant sur le bouton "plus", vous pouvez ajouter vous-même des cartouches à la collection</p>
		</div>
		
		

	

	<?

require_once('pagination.php');


try
{
     $dbh = new PDO('mysql:host=localhost;dbname=camilleflorquin_collection', 'camilleflorquin', 'cENPyultvNpth67x');
     $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    print "Error!: " . $e->getMessage() . "<br/>";
}


if(isset($_GET['page']))
{
$page = $_GET['page'];
}
else
{
$page = 1;
}

$options = array(
    'results_per_page' => 5,
    'url' => 'http://camilleflorquin.be/macollection/app/index.php?page=*VAR*',
    'db_handle' => $dbh
);


try
{
    $paginate = new pagination($page, 'SELECT * FROM notes ORDER BY date', $options);
}
catch(paginationException $e)
{
    echo $e;
    exit();
}

if($paginate->success == true)
{

    $result = $paginate->resultset->fetchAll();


    foreach($result as $row)
    {

        
    ?>
    	<div class="present">
	    	<div class="titre">
				
					<p><?php echo $row['title']; ?></p>
					<a href="favoris.php?id=<?php echo $row['id'];?>" name='id'><div id="favoris"></div></a>

	    	</div>
	    	<div class="date">
				
					<p>Ajouté le <?php echo $row['date']; ?></p>
	    	</div>
	    	
	    	
	    	<div class="bloc">
				<a class="thumb" href="#favoris<?php echo $row['id']; ?>">
					<img src="img/cartouches/<?php echo $row['img']; ?>" alt=""></a>
					
					<div class="description">
				
					<p><?php echo utf8_decode ($row['description']);?></p>
	    	</div>
	    	</div>
	    	
			
	    	
    	</div>
<?php
    }
   
    echo '<p class="paginationlink">'.$paginate->links_html.'</p>';

}

?>


		<div id="donnerinfo" class="white-popup mfp-with-anim mfp-hide">
			<form action="index.php" enctype="multipart/form-data" method="post">
				
				<p class="infotext">Nom du jeu</p><input type="text" name="title">
				<p class="infotext">Choisissez une images</p><input type="file" name="thumbnails">
				<p class="infotext">Ajoutez une description</p><textarea name="description" size="150"></textarea>
				<p class="infotext">Date d'ajout</p><input type="date" name="date"> 
				<br>
				<input type="submit" class="submit" value="Charger"/>
				
			</form>
		</div>
				
		</div>		
		

	</div>

	</div>


	<div id="searchnote">

		<script type="text/javascript">
		
		
			    function findnotes(varsearch){
			    	
			    	document.getElementById('findnotes').innerHTML=varsearch;
			    }
		
		
			    function search() {
		
			    	var pattern = document.getElementById("searchpattern").value;
		
			    	if(pattern.length >= 1) {
					xhr.open("GET","search.php?pattern="+pattern,true);
					xhr.onreadystatechange=function(){
					  if(xhr.readyState==4)
					    if(xhr.status==200) {
							eval(xhr.responseText);
					    }
					}
		
					xhr.send();
					}
				}
				
		
		
		</script>

		<form>
			<input type="text" id="searchpattern" onkeyup="search();">
		</form>

		<div id='findnotes'>
		</div>

	</div>




<div id="favorisuser" class="clearfix page">
	<h2>Mes Cartouches</h2>
	<div id="portfolio4">

		<?php
	
			$reponsefavoris = $bdd->query("SELECT * FROM notes WHERE favoris>=1");

			while ($donneesfavoris = $reponsefavoris->fetch()) {
		
		?>
			<a href="deletefavoris.php?id=<?php echo $donneesfavoris['id'];?>" name='id'>Delete</a>

			<div class="bloc">
				<a class="thumb" href="#favoris<?php echo $donneesfavoris['id']; ?>">
					<img src="img/cartouches/<?php echo $donneesfavoris['img']; ?>" alt=""></a>
					

				<div class="info">
					<a href="javascript:FavoriteIt(<?php echo $donneesfavoris['id'] ?>);">
						<img src="img/cartouches/<?php echo $donneesfavoris['img']; ?>" alt=""></a>
				</div>
			</div>

		<?php
			}


		?>
			
	</div>
</div>




<div id="aboutapp" class="page">


	<p class="logoorange">A Propos de "Ma Collection de Cartouches"</p>
	<p class="version">Version beta</p>

	<p class="version">Crédits</p>
	<p>openclassrooms.com</p>
	<p>php.developpez.com</p>
	<p>le site du zero</p>
	<p>code academy</p>


	
</div>


</div>

<div id="settingsuser" class="page">

	<h4>Mon Compte</h4>

	
	<div id="avatar">
	  
	  
	  
	<?php echo "<img src='".$_SESSION['collectionimg']."'>"; ?>
	<?php echo "<h2>".$_SESSION['collectionuser']."</h2>"; ?>
	<?php echo "<h3>".$_SESSION['collectionname']."</h3>"; ?>

	  
	  <p class='message' id='messagechange' style="margin: 30px 0; display:none;">Compte mis à jour</p>
	 

		  <div id="changer">
		  
		  <a class="change" href="javascript:ChangeImg(<?php echo $_SESSION['collection']; ?>);"><p> Changez de photo</p></a>
		  <a class="change" href="javascript:ChangeUsername(<?php echo $_SESSION['collection']; ?>);"><p> Changez de pseudo</p></a>
		  </div>



<!-- Script, changement de photo de profil et de pseudo -->

	<script type="text/javascript">



	    function ChangeUsername(iduser) {

	    	var newpseudo = prompt('Quel est votre nouveau pseudo?');

	    	if(newpseudo.length>3) { 

	    		document.getElementById("messagechange").style.display="block";
			
				setTimeout(function(){
						window.location.href='?action=reloadname&newpseudo='+newpseudo+"&iduser="+iduser;
				}, 2000);

			}
		}


		function ChangeImg(iduser) {

	    	var newimg = prompt('Entrer l url de votre nouvelle photo');

	    	if(newimg.length>10) { 

	    		document.getElementById("messagechange").style.display="block";
			
				setTimeout(function(){
						window.location.href='?action=reloadimg&newimg='+newimg+"&iduser="+iduser;
				}, 2000);

			}
		}</script>	  
	  
	</div>
	
		<a id="supprimer" href="?action=deleteuser">Supprimer mon compte</a></div>

</div>

<?php
	}

?>


 	<script src='http://dimsemenov-static.s3.amazonaws.com/dist/jquery.magnific-popup.min.js'></script>
 	<script src="js/index.js"></script>

<script src="js/jquery.touchwipe.js"></script>
 
<script>
      $(window).touchwipe({
        wipeLeft: function() {
          // Close
          $.sidr('close', 'sidr');
        },
        wipeRight: function() {
          // Open
          $.sidr('open', 'sidr');
        },
        preventDefaultEvents: false
      });

	$(document).ready(

	function() {
		$('#simple-menu').sidr();


	var portfolio = $('#portfolio, #portfolio2, #portfolio3, #portfolio4, #portfolio5');
	portfolio.masonry({
		isAnimated: true,
		itemSelector:'.bloc:not(.hidden)',
		isFitWidth:true,
		columnWidth:75
	});
	

});
	
</script>

</body>
</html>
