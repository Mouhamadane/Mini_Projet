<?php
session_start();
require_once("./functions.php");
is_connect();
$page_num=1;
$class="";
if(isset($_GET['page'])){
    $page_num=$_GET['page'];
    $class ="active";
}else {
    $page_num=1; 
    $class = "active";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/css/joueur.css">
    <title>Accueil</title>
</head>
<body>
    <div class="header">
            <div class="logo"></div>
            <div class="header-text">Le plaisir de jouer</div>
    </div>
    <div class="contain">
        <div class="container">
            <div class="container-header">
                <img src="../asset/img/<?=$_SESSION['user']['image']?>" class="profil" alt="">
                <div class="player"><?= strtoupper($_SESSION['user']['prenom']);?></div>
                <div class="container-text"> BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ <br>
                JOUER ET TESTER VOTRE NIVEAU DE CULTURE GENERALE
                </div>
                <a href="logout.php" onclick="return(confirm('Vous vous déconnectez ?'));"><button class="disconnect">Déconnexion</button></a>
            </div>
            <div class="interface">
                <div class="interface-jeu">
                    <div class="interface-header">QUESTION</div>
                    <div class="score">3 pts</div>
                    <?php ?>
                </div>
                <div>
                    <div class="top-score"><a class="<?php if($page_num==1){echo $class;} ?>" href="player.php?page=1">Top scores</a></div>
                    <div class="best-score"><a class="<?php if($page_num==2){echo $class;} ?>"  href="player.php?page=2">Mon meilleur score</a></div>
                </div>
                <div class="interface-score">
                <?php
                    if(isset($_GET['page'])){
                        $page_num=$_GET['page'];
                        if ($page_num==1) {
                            require_once('topScorelist.php');  
                        }else{
                            echo "<p>".$_SESSION['user']['score']."pts </p>";
                        }
                    }else {
                        require_once('topScorelist.php');  
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>