<?php
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
        <caption> LISTE DES JOUEURS PAR SCORE</caption>
        <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Score</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($players as $key => $player) { ?>
            <tr>
                <td><?= $player['nom']?></td>
                <td><?= $player['prenom']?></td>
                <td><?= $player['score']?></td>
            </tr>
       <?php } ?>
        </tbody>
                    
    </table>
    <button type="submit" style="margin-left:70%">suivant</button>
</div>