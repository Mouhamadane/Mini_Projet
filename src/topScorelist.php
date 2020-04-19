<?php
require_once("./functions.php");
$users = getData();
$players = [];
foreach ($users as $key => $user) {
    if ($user["profil"]==="joueur") {
        array_push($players,$user);
    } 
}
?>
<div class="liste-form">
    <table class="table">
        <tbody>
        <?php foreach ($players as $key => $player) { ?>
            <tr>
                <td><?= $player['prenom']?></td>
                <td><?= $player['nom']?></td>
                <td><?= $player['score']?> pts</td>
            </tr>
       <?php } ?>
        </tbody>
    </table>
</div>













