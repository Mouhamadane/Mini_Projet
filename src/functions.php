<?php
    function getQuestion(){
        $data = file_get_contents(dirname(__FILE__) .'/questions.json');
        $data = json_decode($data,true);
        return $data;
    }
    function getData(){
        $data = file_get_contents(dirname(__FILE__) .'/bd.json');
        $data = json_decode($data,true);
        return $data;
    }
    // Connexion
    function connexion($login,$pwd){
        $users = getData();
        foreach ($users as $key => $user) {
            if ($user["login"]===$login && $user["password"]===$pwd) {
                $_SESSION['user']=$user;
                $_SESSION['statut']='login';
                if ($user["profil"]==="admin"){
                   return "admin";
                }else{
                    return "jeux";
                }
            }
               
            
        }
        return "error";
    }
    // Verifier connexion
    function is_connect(){
        if (!isset($_SESSION['statut'])) {
            header("Location:../index.php");
        }
    }
    // Deconnecter
    function deconnexion(){
        unset($_SESSION['user']);
        unset($_SESSION['user']);
        session_destroy();
       
    }
    // Inscription
    function inscrire($prenom,$nom,$profil,$login,$pwd,$image){
        $tab=["prenom"=>$prenom,"nom"=>$nom,"profil"=>$profil,"login"=>$login,"password"=>$pwd,"image"=>$image];
        $contenu = file_get_contents("./bd.json");
        $contenu = json_decode($contenu,true);
        $contenu[] = $tab;
        $contenu = json_encode($contenu,JSON_PRETTY_PRINT);
        file_put_contents("./bd.json",$contenu);
    }
    function ajouterQuestion($question,$point,$typeReponse,$bonneReponse,$badReponse){
        $tab=["question"=>$question,"point"=>$point,"type"=>$typeReponse,"bonne"=>$bonneReponse,"mauvaise"=>$badReponse];
        $contenu = file_get_contents("./questions.json");
        $contenu = json_decode($contenu,true);
        $contenu[] = $tab;
        $contenu = json_encode($contenu,JSON_PRETTY_PRINT);
        file_put_contents("./questions.json",$contenu);

    }
    // Tester si un NOM
    function is_name($chaine){
        $chaine = trim($chaine);
        if(preg_match('#(^[A-Z]([a-z]|[" "]([A-Z]{1})){1,})+$#',$chaine)){
            return true;
        }
        return false;
    }
    function is_login($login){
        $users = getData();
        foreach ($users as $user) {
            if ($user["login"]===$login ) {
                return true;
            }        
        }
        return false;      
    }
    function confirmer($string1,$string2){
        if ($string1 != $string2) {
            return false;
        }
        return true;
    }
    // Longueur d'une chaine
    function long_chaine($chaine){
        if (isset($chaine)){
            $i=0;
            for($j=0; isset($chaine[$i]); $j++) {
                $i++;
            }
        return $i;
        }
    }
    // Fonction qui permet de savoir si un caractere est une lettre ou pas
    function is_car_alpha ($car){
        if (($car < "a" ||  $car > "z") && ($car < "A" ||  $car > "Z")|| long_chaine($car)>1){
            return false;
        }
        return true;
    }
    // Fonction qui permet de savoir si une chaine est un mot ou pas
    function is_chaine_alpha($chaine){
        for($i=0; $i<long_chaine($chaine); $i++){
            if(!is_car_alpha($chaine[$i])){
                return false;
            }
        }
        return true;
    }
    // Tester si une chaine est une phrase
    function is_chaine_phrase($chaine){
        if(preg_match('#^[A-Z]{1}[a-z | ].+[.?!]$#',$chaine)){
            return true;
        }
        return false;
    
    }
    //Fonction qui permet de savoir si un caractere est numerique ou pas
    function is_car_numeric ($car){
        if ($car >= '0' &&  $car <= '9'){
            return true;
        }
        return false;
    }
    //Fonction qui permet de savoir si un caractere est numerique ou pas
    function is_chaine_numeric($chaine){
        for ($i=0; $i <long_chaine($chaine); $i++){
            if(!is_car_numeric($chaine[$i])){
            return false;
            } 
        }
        return true; 
    }





?>


































