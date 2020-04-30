<?php
$users = getData();
$players = [];
foreach ($users as $key => $user) {
    if ($user["profil"]==="joueur") {
        array_push($players,$user);
    } 
    rsort($players);
}
foreach ($players as $key => $value) {
    $score[$key] = $value['score'];
}
array_multisort($score,SORT_DESC,$players);
?>
<div class="liste-form">
    <form action="" method="post">
        <table class="listK-form">
            <caption> LISTE DES JOUEURS PAR SCORE</caption>
            <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Score</th>
            </tr>
            </thead>
            <tbody>
                <tr>
            <?php 
                if (isset($_POST['btn'])) {
                    $debut = $_SESSION['fin'];
                    $fin = $_SESSION['fin']+3;
                }elseif (isset($_POST['btn2']) && $_SESSION['fin']>3) {
                    $debut = $_SESSION['fin']-6;
                    $fin = $_SESSION['fin']-3;
                }else {
                    $debut = 0;
                    $fin = 3;
                }
                for ($i=$debut; $i<$fin  ; $i++) { 
                    if ($i<count($players)) {?>
                        <td><?= $players[$i]['nom']?></td>
                        <td><?= $players[$i]['prenom']?></td>
                        <td class="style-score"><?= $players[$i]['score']?></td>
                    </tr>
                <?php 
                    } 
                }
                $_SESSION['fin']=$fin; ?>
               
            </tbody>             
        </table>
        <?php    
            if (isset($_POST['btn']) || $_SESSION['fin']>=4) {?>
                <button type="submit" style="float:leftt; margin-left:4%" name="btn2">précédent</button>  
            <?php }
             if ($_SESSION['fin']< count($players)) {?>
                <button type="submit" style="float:right; margin-right:4%" name="btn">suivant</button>         
            <?php } ?>
       
    </form>
</div>
