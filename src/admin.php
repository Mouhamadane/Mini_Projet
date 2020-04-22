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
    <link rel="stylesheet" href="../asset/css/accueil.css">
    <script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui-1.8.22.custom.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/jquery-ui-1.8.22.custom.css"  media="screen" />
    <title>Accueil</title>
</head>
<body>
    <img class="image" src="../asset/img/logo-QuizzSA.png" alt="">
    <div class="haut">Le plaisir de jouer</div>
    <div class="container">
        <div class="beforebox">
            <div class="header-text">CREER ET PARAMETTRER VOS QUIZZ</div>
            <a href="logout.php" onclick="return(confirm('Vous vous déconnectez ?'));"><button type="submit"  class="disconnect">Déconnexion</button></a>
        </div>
        <div class="afterbox"> 
            <div class="promenu">
                <div class="profil">
                   <div class="avatar"><img src="../asset/img/<?=$_SESSION['user']['image']?>" class="tof" alt=""> </div>              
                
                <p class="prenom"><?= strtoupper($_SESSION['user']['prenom']);?></p>  
                <p class="nom"><?= strtoupper($_SESSION['user']['nom']);?></p>  
                </div> 
                <div class="menu">
                    <div class="sous">
                    <div class="sous"><a class="<?php if($page_num==1){echo $class;} ?>" href="admin.php?page=1">Liste Questions</a><img class="icons" src="asset/img/Icones/ic-liste.png" alt=""></div>
                    <div class="sous"><a class="<?php if($page_num==2){echo $class;} ?>" href="admin.php?page=2">Créer Admin</a><img class="icons" src="asset/img/Icones/ic-ajout-active.png" alt=""></div>
                    <div class="sous"><a class="<?php if($page_num==3){echo $class;} ?>" href="admin.php?page=3">Liste Joueurs</a><img class="icons" src="asset/img/Icones/ic-liste.png" alt=""></div>
                    <div class="sous"><a class="<?php if($page_num==4){echo $class;} ?>" href="admin.php?page=4" class="<?=$class;?>">Créer Questions</a><img class="icons" src="asset/img/Icones/ic-ajout.png" alt=""></div>
                </div>
            </div> 
        </div>
        <?php 
        if(isset($_GET['page'])){
            $page_num=$_GET['page'];
                if ($page_num==1) {
                    require_once('questionlist.php');  
                }
                elseif ($page_num==2) {
                    require_once('addadmin.php');  
                }
                elseif ($page_num==3) {
                    require_once('listeJoueur.php');  
                }else{
                    require_once('addquestion.php');
                }
                
        }else {
            require_once('questionlist.php');  
        }
            ?>
    </div>
</body>
</html>