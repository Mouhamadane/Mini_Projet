
<?php
$error=["nom"=>"","prenom"=>"","adress"=>"","login"=>"",'pwd'=>""];
$nom="";
$prenom ="";
$login="";
$uploads_dir = 'C:/xampp/htdocs/Mouhamadane/asset/img';
include_once("./functions.php");
if (isset($_POST['btn'])) {
    $profil="admin";
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
    $password2=$_POST['pwdconf'];
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
        
       
    }
}
?>

<div class="plateau">
    <div class="inshaut">
        <div class="text-inscrire">S'INSCRIRE</div>
        <div class="message-inscrire">Pour proposer des quizz ! </div>
        <img src="" id="tof" alt="" class="avatarInscription">
        <div class="avatartext">Avatar Admin</div>
        <form action="" method="post" enctype="multipart/form-data" id="form">
            <div>
                <label for="">Prénom</label>
                <input type="text" class="putins" error="error-1" name="prenom" autocomplete="off">
            </div>
            <span id="error-1"><?= $error['prenom']; ?></span>
            <div>
                <label for="">Nom</label>
                <input type="text" class="putins" error="error-3" name="nom" autocomplete="off">
            </div>
            <span id="error-3"><?= $error['nom']; ?></span>
            <div>
                <label for="">Login</label>
                <input type="text" class="putins" error="error-4" name="login" autocomplete="off">
            </div>
            <span id="error-4"><?= $error['login']; ?></span>
            <div>
                <label for="">Password</label>
                <input type="password" class="putins" error="error-5" name="pwd" autocomplete="off">
            </div>
            <span id="error-5"></span>
            <div>
                <label for="">Confirmer Password</label> 
                <input type="password" class="putins" error="error-6" name="pwdconf">
            </div>
            <span id="error-6"><?= $error['pwd']; ?></span>
            <div>
                Avatar
                <input class="input-file" name="my-file" error="error-7" id="my-file" type="file" onchange="document.getElementById('tof').src=window.URL.createObjectURL(this.files[0])">
                <label for="my-file" class="input-file-trigger" tabindex="0">Choisir un fichier</label>
            </div>
            <span id="error-7" class="avatarerror"></span>
            <div>
                <button type="submit" name="btn" class="btn">Créer compte</button>
            </div>
            
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
</div>
