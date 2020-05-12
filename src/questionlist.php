
<?php
    $tab = getQuestion();
    $param = getNombreQuestion();
    $nombreQuestion = $param['num'];
    $error="";
    if (isset($_POST['okbtn'])) {
        $num= $_POST['num'];
        if (!is_chaine_numeric($num)) {
            $error = "Veuillez entrer un nombre positif. ";
        }
        elseif ($num < 5) {
            $error = "Veuillez entrer un nombre supérieur à 5. ";
        }else {
            $nombreQuestion = $num;
            ajouterNombreQuestion($num);
        }
    }

?>

<div class="plateauQuestion">
    <form action="" method="post" class="formlist-form">
        <div class="boutinput">
            <div class="text1">Nbre de question/jeu</div>
            <input type="inputnombre" name="num" class="inputnombre" value="<?= $nombreQuestion?>" autocomplete="off">
            <button type="submit" name="okbtn" class="bouton">OK</button>
        </div>
        <span class="error-form"><?= $error?></span>
        <div class="tablelist-form">
        <?php 
            if (isset($_POST['btn']) && $_SESSION['fin']<count($tab)) {
                $debut = $_SESSION['fin'];
                $fin = $_SESSION['fin']+5;
            }elseif (isset($_POST['btn2']) && $_SESSION['fin']>5) {
                $debut = $_SESSION['fin']-10;
                $fin = $_SESSION['fin']-5;
            }else {
                $debut = 0;
                $fin = 5;
            }
            
            for ($i=$debut; $i < $fin; $i++) { 
                $_SESSION['j']=$i+1;
                if ($i<count($tab)) {?>
                    <p class="titleKest"><?= $_SESSION['j'].". ".$tab[$i]["question"]; ?></p>
                <?php
                    if ($tab[$i]['type']=="multiple") {
                        foreach ($tab[$i]['reponse'] as $key=>$value) {
                            if ($value=="true") {
                                echo '<input type="checkbox" class="radioKest" checked="checked">';
                            }else {
                                echo '<input type="checkbox" class="radioKest">';
                            }
                            echo '<strong>'.$key.'</strong><br>';
                        }
                    }elseif ($tab[$i]['type']=="radio") {
                        foreach ($tab[$i]['reponse'] as $key=>$value) {
                            if ($value=="true") {
                                echo '<input type="radio" class="radioKest" checked="checked">';
                            }else {
                                echo '<input type="radio" class="radioKest">';
                            }
                            echo '<strong>'.$key.'</strong><br>';
                        }
                        
                    }else {
                        echo '<input type="text" class="reponse-input" name="" id="" >';
                    }
                }
            }
            $_SESSION['fin']=$fin;
        ?>
        <?php    
        if (isset($_POST['btn']) || $_SESSION['fin']>=6) {?>
            <button type="submit" style="float:leftt; margin-left:4%" name="btn2">précédent</button>  
        <?php }
            if ($_SESSION['fin']< count($tab)) {?>
            <button type="submit" style="float:right; margin-right:4%" name="btn">suivant</button>         
        <?php } ?>
        </div>  
    </form>
     
</div>