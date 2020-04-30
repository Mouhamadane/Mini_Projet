<?php
$error=["nom"=>"","prenom"=>"","adress"=>"","login"=>"",'pwd'=>""];
$nom="";
$prenom ="";
$login="";
$message="";
if (isset($_POST['btn'])) {
    include("./functions.php");
    $profil="joueur";
    $nom=$_POST['nom'];
    if (!is_name($nom)) {
        $error['nom']='Nom incorrect !';
    }
    $prenom=$_POST['prenom'];
    if (!is_name($prenom)) {
        $error['prenom']='Prénom incorrect !';
    }
    $login=$_POST['login'];
    if (is_login($login)) {
        $error['login']= ' Ce login existe déja !';
    }
    $pwd=$_POST['pwd'];
    $password2=$_POST['pwd2'];
    if ($pwd != $password2) {
        $error['pwd']='Les numéros doivent être identiques !';
    }  
    if (empty($error['nom'])&& empty($error['prenom'])&& empty($error['login'])&& empty($error['pwd'])) {
        $uploads_dir = 'C:/xampp/htdocs/Mouhamadane/asset/img';
        $error = $_FILES["my-file"]["error"];
        if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["my-file"]["tmp_name"];
            $name = basename($_FILES["my-file"]["name"]);
            move_uploaded_file($tmp_name, "$uploads_dir/$name");
        }      
        inscrire($prenom,$nom,$profil,$login,$pwd,$name);
        $nom="";
        $prenom ="";
        $login="";
        echo " <script> alert(\"Utilisateur crée avec succés !!!\")</script>";
        header("Location:../index.php");
       
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/css/style.css">
    <title>Inscription</title>
</head>
<body>
    <img class="image" src="../asset/img/logo-QuizzSA.png" alt="">
    <div class="haut">Le plaisir de jouer</div>
    <div class="inscrire">
        <div class="inshaut">
            <Strong>S'INSCRIRE</Strong>
            <p>Pour tester votre niveau de culture générale ! </p>
            <HR class="sepins">
            <form action="" method="post" enctype="multipart/form-data" id="form">
                <div>
                    <label for="">Prénom</label>
                    <input type="text" name="prenom" error="error-1" value="<?=$prenom?>" class="putins">    
                </div>
                <span id="error-1"><?= $error['prenom']; ?></span>
               
                <div>
                    <label for="">Nom</label>
                    <input type="text" name="nom" error="error-2" value="<?=$nom?>" class="putins">
                </div>
                <span id="error-2"><?= $error['nom']; ?></span>
                <div>
                    <label for="">Login</label>
                    <input type="text" name="login" error="error-3" value="<?=$login?>" class="putins">
                </div>
                <span id="error-3"><?= $error['login']; ?></span>
                <div>
                    <label for="">Password</label>
                    <input type="password" error="error-4" name="pwd" class="putins">
                </div>
                <span id="error-4"></span>
                <div>
                    <label for="">Confirmation</label>
                    <input type="password" error="error-5" name="pwd2" class="putins">
                </div>
                <span id="error-5"> <?= $error['pwd']; ?></span>
                <div> Avatar
                    <input class="input-file" name="my-file" error="error-7" id="my-file" type="file" onchange="document.getElementById('tof').src=window.URL.createObjectURL(this.files[0])">
                    <label for="my-file" class="input-file-trigger" tabindex="0">Choisir un fichier</label>
                    <span id="error-7"></span>                
                </div>
                <img id="tof" src="" class="avatar" alt=""/>
                <div>
                    <button type="submit" name="btn" class="btn">Créer compte</button>
                </div>
                <a href="javascript:window.history.back()">RETOUR</a>
            </form> 
        </div>
       
    </div>
    <script>
    const inputs= document.getElementsByTagName("input"); 
    for(input of inputs){
        input.addEventListener("keyup",function(e){
            if(e.target.hasAttribute("error")){
                var idDivError=e.target.getAttribute("error");
                document.getElementById(idDivError).innerText=""
            }
        })
    }

    document.getElementById("form").addEventListener("submit",function(e){
        const inputs= document.getElementsByTagName("input");
        var error = false;
        for(input of inputs){
            if(input.hasAttribute("error")){
                var idDivError = input.getAttribute("error");
                if(!input.value){
                    document.getElementById(idDivError).innerText="Ce champ est obligatoire !";
                    error=true;
                }
               
            }
        }
        if(error){
            e.preventDefault();
            return false; 
        }
    });
</script>
</body>
</html>