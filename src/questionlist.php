
<?php
    $tab = getQuestion();

?>

<div class="plateauQuestion">
    <form action="" method="post" class="formlist-form">
        <div class="boutinput">
            <div class="text1">Nbre de question/jeu</div>
            <input type="inputnombre" name="num" class="inputnombre" value="" autocomplete="off">
            <button type="submit" name="btn" class="bouton">OK</button>
        </div>
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
                        foreach ($tab[$i]['bonne'] as $value) {
                            echo '<input type="checkbox" class="radioKest" checked="checked">';
                            echo '<strong>'.$value.'</strong><br>';
                        }
                        foreach ($tab[$i]['mauvaise'] as $value) {
                            echo '<input type="checkbox" class="radioKest">';
                            echo '<strong>'.$value.'</strong><br>';
                        }
                    }elseif ($tab[$i]['type']=="radio") {
                        foreach ($tab[$i]['bonne'] as $value) {
                            echo '<input type="radio" class="radioKest" checked="checked">';
                            echo '<strong>'.$value.'</strong><br>';
                        }
                        foreach ($tab[$i]['mauvaise'] as $value) {
                            echo '<input type="radio" class="radioKest">';
                            echo '<strong>'.$value.'</strong><br>';
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