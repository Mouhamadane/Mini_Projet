<?php
require_once("./functions.php");
$users = getData();
$players = [];
foreach ($users as $key => $user) {
    if ($user["profil"]==="joueur") {
        array_push($players,$user);
    } 
}
foreach ($players as $key => $value) {
    $score[$key] = $value['score'];
}
array_multisort($score,SORT_DESC,$players);
?>
<div class="liste-form">
    <table class="table">
        <tbody>
        <?php for ($i=0; $i <4 ; $i++) {?>
            <tr>
                <td class="efa"><?= $players[$i]['prenom']." ". $players[$i]['nom']?></td>
                <td class="point"><?= $players[$i]['score']?> pts</td>
            </tr>
       <?php } ?>
        </tbody>
    </table>
</div>














