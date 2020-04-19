<?php
session_start();
require_once('src/functions.php');
$class= "beforebox";
$error = "";
$pseudo="";
$message = "Login Form";
 // Fichier Json
if(isset($_POST['btn'])){
    $pseudo=$_POST['login'];
    $password=$_POST['mdp'];
    $result = connexion($pseudo,$password);
    if ($result==="admin") {
        header("Location:./src/admin.php");
    }elseif ($result==="jeux") {
        header("Location:./src/player.php");
    }else{
        $error = "Cet utilisateur n'existe pas";
    }   
}

if (!empty($error)) {
    $class = "beforebox2";
    $message = "";
}
 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/css/style.css">
    <title>Connexion</title>
</head>
<body>
    <img class="image" src="asset/img/logo-QuizzSA.png" alt="">
    <div class="haut">Le plaisir de jouer</div>
    <div class="<?=$class ?>"><?=$message; if(!empty($error)){ echo $error; } ?></div>
    <div class="box">
        <form action="" method="post">
            <div>
                <div class="logtof"><img class="logtoff" src="asset/img/Icones/ic-login.png" alt=""></div>
                <input type="text" name="login" autocomplete="off" placeholder="Login" value="<?= $pseudo?>" required>    
            </div>
            <div>
                <div class="logtof"><img class="logtoff" src="asset/img/Icones/ic-password.png" alt=""></div>
                <input type="password" name="mdp" placeholder="Password" required>               
            </div>
            <div>
                <button type="submit" name="btn"> Connexion</button>
                <div class="inscription"><a href="./src/inscription.php">S'inscrire pour jouer?</a></div>
            </div>
        </form> 
    </div>

</body>
</html>