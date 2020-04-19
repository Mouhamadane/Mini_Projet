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
    $class="active";
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
                <a href="logout.php"><button class="disconnect">Déconnexion</button></a>
            </div>
            <div class="interface">
                <div class="interface-jeu">
                    <div class="interface-header">QUESTION</div>
                    <div class="score">3 pts</div>
                    <?php ?>
                </div>
                <a href="player.php?page=1" class="top-score">Top scores</a>
                <a href="player.php?page=2" class="best-score">Mon meilleur score</a>
                <div class="interface-score">
                <?php
                    if(isset($_GET['page'])){
                        $page_num=$_GET['page'];
                        if ($page_num==1) {
                            require_once('topScorelist.php');  
                        }else{
                            echo $_SESSION['user']['prenom']."<br>";
                            echo $_SESSION['user']['score']."<br>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>