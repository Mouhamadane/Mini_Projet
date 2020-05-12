<?php
session_start();
require_once("./functions.php");
is_connect();
if(empty($_SESSION['reload'])){
    $_SESSION['reload'] = 1; 
 }

$page_num=1;
$class="";
if(isset($_GET['page'])){
    $page_num=$_GET['page'];
    $class ="active";
}else {
    $page_num=1; 
    $class = "active";
}
/*
* Récupération des questions et tirages de manières aléatoires
* Mettre affecter 2 à la valeur Session pour que array_random ne se réexecute pas
*/
$param = getNombreQuestion();
$tab = getQuestion();
$nbreQuestion = $param['num'];
if($_SESSION['reload'] == 1){
    $_SESSION['question']  = array_random($tab,$nbreQuestion);
    $_SESSION['reload'] = 2;
}
$tabQuestion = $_SESSION['question'];
/* 
* Les buttons suivant et précédent 
*/
$end = false;
if (isset($_POST['btn']) && $_SESSION['fin']<$nbreQuestion) {
    $debut = $_SESSION['fin'];
    $fin = $_SESSION['fin']+1;
}elseif (isset($_POST['btn2']) && $_SESSION['fin']>1) {
    $debut = $_SESSION['fin']-2;
    $fin = $_SESSION['fin']-1;
}else {
    $debut = 0;
    $fin = 1;
}
// Recuperation des reponses
if (isset($_POST['btn'])) {
    if (isset($_POST['text'])) {
        $_SESSION['reponseTexte'] = $_POST['text'];
    }
    if (isset($_POST['multiple'])) {
        
        foreach ($_POST['multiple'] as $rep) {
            if (isset($rep)) {
                $_SESSION['multiple'][] = $rep;
            }
        }
        
        
    }
    
    if (isset($_POST['radio'])) {
        foreach ($_POST['radio'] as $rep) {
            if (isset($rep)) {
                $_SESSION['radio'][] = $rep;
            }
        }
    }
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
                    <?php 
                        for ($i=$debut; $i < $fin; $i++) { 
                            $_SESSION['j']=$i+1;
                            if ($i<$nbreQuestion) {?>
                            <div class="interface-header">
                                QUESTION (<?= $_SESSION['j']?>/<?=$nbreQuestion?>) <br>
                                <?= $tabQuestion[$i]['question']?> 
                            </div>
                            <form action="" method="post" class="rein"> 
                            <div class="score"> <?= $tabQuestion[$i]['point'] ?>pts</div>
                                <?php
                                if ($tabQuestion[$i]['type']=="multiple") {
                                    foreach ($tabQuestion[$i]['reponse'] as $key=>$value) {
                                        echo '<input type="checkbox" class="multiJeu" name="multiple[]" value="'.$key.'">';
                                        echo '<strong class="title-question">  '.$key.'</strong><br>';
                                        }
                                        
                                }elseif ($tabQuestion[$i]['type']=="radio") {
                                    foreach ($tabQuestion[$i]['reponse'] as $radio=>$radioValeur) {
                                        echo '<input type="radio" class="radioJeu" name="radio[]" value="'.$radio.'">';
                                        echo '<strong class="title-question">'.$radio.'</strong><br>';
                                    }
                                }else {
                                    echo '<input type="text" class="reponse-input" name="texte[]" id="" >';
                                }
                            }
                        }
                        $_SESSION['fin']=$fin;  ?>
                    <?php if ((isset($_POST['btn']) || $_SESSION['fin']>=2) && !$end) {?>
                        <button type="submit" style="float:leftt; margin-left:4%; margin-top: 25%" name="btn2">précédent</button>  
                    <?php }
                        if ($_SESSION['fin']<=$nbreQuestion && !$end) {?>
                        <button type="submit" style="float:right; margin-right:4%;margin-top: 25%" name="btn">suivant</button>         
                    <?php }?>
                </form>
                <?php
                    if ($end) {
                        echo " Votre score est ".$score." points";
                        echo "<br>";
                        for ($j=0; $j <$nbreQuestion ; $j++) { 
                            
                            echo $tabQuestion[$i]['question'];
                            echo "<br>";
                            if ($tabQuestion[$j]['type']=="multiple") {
                                foreach ($tabQuestion[$j]['reponse'] as $reponse => $value) {
                                    foreach ($_SESSION['multiple'][$j] as $reponseUser) {
                                        if ($reponseUser==$reponse) {
                                            echo '<input type="checkbox" class="radioKest" checked="checked">';
                                            echo '<strong>'.$reponse.'</strong><br>';
                                        }else {
                                            echo 'faux <input type="checkbox" class="radioKest">';
                                            echo '<strong>'.$reponse.'</strong><br>';
                                        }
                                    }
                                    
                                }
                            }elseif ($tabQuestion[$j]['type']=="radio") {
                                foreach ($tabQuestion[$j]['reponse'] as $reponse => $value) {
                                    foreach ($_SESSION['radio'][$j] as $reponseUser) {
                                        if ($reponseUser==$reponse) {
                                            echo '<input type="radio" class="radioKest" checked="checked">';
                                            echo '<strong>'.$reponse.'</strong><br>';
                                        }else {
                                            echo 'faux <input type="checkbox" class="radioKest">';
                                            echo '<strong>'.$reponse.'</strong><br>';
                                        }
                                    }
                                    
                                }
                                   
                            }else {
                                echo '<input type="text" class="reponse-input" name="texte[]" id="" >';
                            }
                        }
                        
                    }
                
                
                
                
                ?>
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