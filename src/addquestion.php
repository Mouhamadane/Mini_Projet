<?php
    $error=["question"=>"","point"=>"","type"=>"","text"=>"","radio"=>"","multiple"=>""];
    $bonneReponse = [];
    $badReponse = [];
    if (isset($_POST['btn'])) {
        $question = $_POST['question'];
        $point = $_POST['nbrePoint'];
        $typeReponse = $_POST['type'];
        if ($typeReponse=="radio") {
            if (isset($_POST['radio'])) {
                $tabRef = array();
                for ($i=0; $i <count($_POST['reference']) ; $i++) { 
                    $tabRef[$_POST['reference'][$i]]= $_POST['radio'][$i];
                }
                foreach ($tabRef as $key=>$value) {
                    if (in_array($key,$_POST['radio'])) {
                        array_push($bonneReponse,$_POST['radiotext'][$key]);
                    }
                }
               
                $badReponse = array_diff($_POST['radiotext'],$bonneReponse);
            }
                ajouterQuestion($question,$point,$typeReponse,$bonneReponse,$badReponse);
        }elseif($typeReponse=="multiple"){
            $tabMulti = array();
            for ($i=0; $i <count($_POST['refM']) ; $i++) { 
                $tabMulti[$_POST['refM'][$i]]= $_POST['radio'][$i];
            }
            if (isset($_POST['multiple'])) {
                foreach ($tabMulti as  $key=>$value) {
                    if (in_array($key,$_POST['multi'])) {
                        array_push($bonneReponse,$_POST['multiple'][$key]);
                    }
                }
                $badReponse = array_diff($_POST['multiple'],$badReponse);
            }
            ajouterQuestion($question,$point,$typeReponse,$bonneReponse,$badReponse);

        }else {
            array_push($bonneReponse,$_POST['reponsetext']);
            ajouterQuestion($question,$point,$typeReponse,$bonneReponse,$badReponse);

        }
       
    }


?>

<div class="addQuestion">
    <div class="ask-text">PARAMETRER VOS QUESTIONS</div>
    <div>
        <form id="myform" method="post" class="ask-form">
            <div>
                <label for="" class="label-form">Questions</label>
                <textarea name="question" id="" error="error-1" cols="30" rows="10" class="kest-form"></textarea>
            </div>
            <div>
                <label for=""  class="label-form">Nbre de points</label>
                <input type="number" error="error-2" name="nbrePoint" class="point-form">
                <div class="error-form" id="error-2"></div>
            </div>
            <div class="formControl">
                <div class="plus-form" onclick="onaddInput()" name="" id="" ></div>
                <label for="" class="nature-label">Type de réponse</label>
                <select name="type" id="type" class="nature-form">
                    <option value="nothing" checked>Donnez le type de réponse</option>
                    <option value="text">Texte</option>
                    <option value="radio">Choix simple</option>
                    <option value="multiple">Choix multiple</option>
                </select>
                <div id="error" class="error-form"></div>
            </div>
            <div id="inputs"></div>
            
            <div>
                <button type="submit" name="btn" class="enregistrer-form"> Enregistrer</button>
            </div>
            
        </form>
    </div>
      
</div>
<script>
    var rep = 0;
    var nbRow = 0;
    function onaddInput() {
        rep++;
        nbRow++;
        var divInputs = document.getElementById('inputs');
        var newInput = document.createElement('div');
        newInput.setAttribute('class','formControl');
        newInput.setAttribute('id','formControl_'+nbRow);
        if (document.getElementById('type').value=="nothing") {
            var divError = document.getElementById('error');
            divError.innerText = "Veuillez choisir un type";
            rep--;
            nbRow--;
        }
        if (document.getElementById('type').value=="text") {
                var divError = document.getElementById('error');
                divError.innerText = "";
                newInput.innerHTML = `<label for="" class="label-form">Réponse `+rep+`</label>
                <input type="text" class="reponse-form" name="reponsetext" error="error-" id="text">
                <div class="supprimer-form" onclick="onDeleteInput(${nbRow})"></div>`;
                divInputs.appendChild(newInput);
        }
        if (document.getElementById('type').value=="radio") {
                var divError = document.getElementById('error');
                divError.innerText = "";
                newInput.innerHTML = `<label for="" class="label-form">Réponse `+rep+`</label>
                <input type="text" class="reponse-form" name="radiotext[]" error="error-4" id="text">
                <div class="error-form" id="error-4"></div>
                <input type="radio" name="radio[]" value="${nbRow-1}" class="choix-unique">
                <input type="hidden" name="reference[]" value="${nbRow-1}">
                <div class="supprimer-form" onclick="onDeleteInput(${nbRow})"></div>`;
                divInputs.appendChild(newInput);
        }
        if (document.getElementById('type').value=="multiple") {
                var divError = document.getElementById('error');
                divError.innerText = "";
                newInput.innerHTML = `<label for="" class="label-form">Réponse `+rep+`</label>
                <input type="text" class="reponse-form" name="multiple[]" error="error-4" id="text">
                <input type="checkbox" name="multi[]" value="${nbRow-1}" class="choix-multiple">
                <input type="hidden" name="refM[]" value="${nbRow-1}">
                <div class="supprimer-form" onclick="onDeleteInput(${nbRow})"></div>`;
                divInputs.appendChild(newInput);
        }
        
    }
    function fadeOut(idTarget) {
        var target = document.getElementById('idTarget');
        var effect = setInterval(function () {
            if (!target.style.opacity) {
                target.style.opacity = 1;
            }
            if (target.style.opacity>0) {
                target.style.opacity-=0.1;
            }else{
                clearInterval(effect);
            }
        }, 200); 
    }
    function onDeleteInput(n) {
        var target = document.getElementById('formControl_'+n);
        setTimeout(function(){
            target.remove();
        }, 500);
        fadeOut('formControl_'+n);
    }

</script>