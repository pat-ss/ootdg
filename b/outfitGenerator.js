//save outfit ideas
//show saved ideas

function back(){

    window.location.href = "index.html";

}

function goToGenerateOutfit(){

    window.location.href = "generate_outfit.html";

}

function goToSavedOutfits(){

    window.location.href = "saved_outfits.html";

}

function goToAddClothes(){

    window.location.href = "add_clothes.html";

}

function goToEditClothes(){

    window.location.href = "edit_clothes.html";

}

function goToAddRule(){

    window.location.href = "add_rule.html";

}

function goToEditRules(){

    window.location.href = "edit_rules.html";

}

function isLetter(str) {

    return str.length === 1 && str.match(/[a-z]/i);

}

function generateOutfit(){

    var rules = "";

    if(document.getElementById("ignoreRules").checked == true){

        rules = "with no rules";

    } else {

        rules = "with rules";

    }


    $.ajax({

        type: 'POST',
        data: {

            op: 1,
            rules: rules

        },
        url: "model.php",
        success: function(result){

            console.log(result);
            var obJSON = JSON.parse(result);
            document.getElementById("generate").style.display = "block";
            document.getElementById("top").innerHTML = obJSON.top;
            document.getElementById("top").style.color = "white";
            document.getElementById("top_possibilities").innerHTML = obJSON.second_top;
            document.getElementById("top_possibilities").style.color = "white";
            document.getElementById("bottom").innerHTML = obJSON.bottom;
            document.getElementById("bottom").style.color = "white";
            document.getElementById("shoes").innerHTML = obJSON.shoes;
            document.getElementById("shoes").style.color = "white";
            document.getElementById("jacket").innerHTML = obJSON.jacket;
            //document.getElementById("jacket").style.color = "white";
            document.getElementById("saveOutfit").style.display = "block";

            var ids = [obJSON.id_top, obJSON.id_second_top, obJSON.id_bottom, obJSON.id_shoes, obJSON.id_jacket];
            document.getElementById("ids").value = ids;

        }

    })

}

function getSeasons(){

    $.ajax({

        type: 'POST',
        data: {
            op: 2
        },
        url: "model.php",
        success: function(result){

            document.getElementById("season").innerHTML = result;

        }

    })

}

function getType(){

    $.ajax({

        type: 'POST',
        data: {
            op: 3
        },
        url: "model.php",
        success: function(result){

            document.getElementById("type").innerHTML = result;

        }

    })

}

function showSubtype(){

    var type = document.getElementById("type").value;

    if (type != "empty"){

        document.getElementById("subtype_div").style.visibility = "visible";
        getSubtype();

    }

}

function getSubtype(){

    var type = document.getElementById("type").value;

    $.ajax({

        type: 'POST',
        data: {
            op: 4,
            type: type
        },
        url: "model.php",
        success: function(result){

            document.getElementById("subtype").innerHTML = result;

        }

    })

}

function getColors(){

    $.ajax({

        type: 'POST',
        data:{

            op: 5

        },
        url: "model.php",
        success: function(result){

            var obJSON = JSON.parse(result);
            document.getElementById("colors").innerHTML = obJSON.res;

            var color_ids = [];
            var id = "";

            for(i = 0; i < obJSON.color_ids.length-1; i++){

                if(isNaN(obJSON.color_ids[i]) == false){

                    id += obJSON.color_ids[i];

                    if(isNaN(obJSON.color_ids[i+1])){

                        color_ids.push(id);
                        id = "";

                    }

                }

            }
            
            document.getElementById("colors_ids").value = color_ids;

        }

    })

}

function saveClothes(){

    var description = document.getElementById("description").value;
    var season = document.getElementById("season").value;
    var type = document.getElementById("type").value;
    var subtype = document.getElementById("subtype").value;
    var pattern = document.getElementById("pattern").value;
    var colors_ids = document.getElementById("colors_ids").value;
    var colors = [];
    var flags = [];

    for(i = 0; i < colors_ids.length; i++){

        var id = "color" + colors_ids[i];

        if(document.getElementById(id).checked){

            colors.push(colors_ids[i]);
            flags.push(0);
            

        } else {

            flags.push(1);

        }

    }

    if(flags.includes(0) && description != "" && season != "empty" && type != "empty" && subtype != "empty"){

        $.ajax({

            type: 'POST',
            data: {
    
                op: 6,
                description: description,
                season: season,
                type: type,
                subtype: subtype,
                pattern: pattern,
                colors: colors
    
            },
            url: "..model.php",
            success: function(result){
    
                $('#saved').modal('show');
    
            }
    
        })

    } else {

        alert("Pattern is the only field allowed to be empty");

    }

}

function getClothesList(){

    $.ajax({

        type: 'POST',
        data: {

            op: 7

        },
        url: "model.php",
        success: function(result){

            document.getElementById("clothesList").innerHTML = result;

        }

    })

}

function editItem(idItem){

    $('#modalItem').modal('show');

    $.ajax({

        type: 'POST',
        data: {

            op: 8,
            idItem: idItem

        },
        url: "model.php",
        success: function(result){

            var obJSON = JSON.parse(result);
            document.getElementById("description").value = obJSON.description;
            document.getElementById("season").innerHTML = obJSON.season;
            document.getElementById("type").value = obJSON.type;
            document.getElementById("subtype").value = obJSON.subtype;
            document.getElementById("pattern").value = obJSON.pattern;
            $('#buttonSave').attr('onclick', 'saveEditItem('+obJSON.idItem+')');

        }

    })

}

function saveEditItem(idItem){

    var description = document.getElementById("description").value;
    var season = document.getElementById("season").value;
    var type = document.getElementById("type").value;
    var subtype = document.getElementById("subtype").value;
    var pattern = document.getElementById("pattern").value;

    $.ajax({

        type: 'POST',
        data:{

            op: 9,
            idItem: idItem,
            description: description,
            season: season,
            type: type,
            subtype: subtype,
            pattern: pattern

        },
        url: "model.php",
        success: function(result){

            $('#modalItem').modal('hide');
            $('#saved').modal('show');

        }

    })

}

function itemsThatDontGoTogether(){

    
    document.getElementById("colorsThatDontGoTogether").style.display = "none";
    document.getElementById("topsThatCanHaveASecondLayer").style.display = "none";
    document.getElementById("itemsThatDontGoTogether").style.display = "block";
    getItemsRules();

}

function colorsThatDontGoTogether(){

    document.getElementById("colorsThatDontGoTogether").style.display = "block";
    document.getElementById("topsThatCanHaveASecondLayer").style.display = "none";
    document.getElementById("itemsThatDontGoTogether").style.display = "none";
    getColorsRules();

}

function topsThatCanHaveASecondLayer(){

    
    document.getElementById("colorsThatDontGoTogether").style.display = "none";
    document.getElementById("topsThatCanHaveASecondLayer").style.display = "block";
    document.getElementById("itemsThatDontGoTogether").style.display = "none";
    getTopsRules();

}

function getItemsRules(){

    $.ajax({

        type: 'POST',
        data:{

            op: 10

        },
        url: "model.php",
        success: function(result){

            document.getElementById("second_item").innerHTML = result;
            document.getElementById("first_item").innerHTML = result;

        }

    })

}

function getColorsRules(){

    $.ajax({

        type: 'POST',
        data: {

            op: 11

        },
        url: "model.php",
        success: function(result){

            document.getElementById("first_color").innerHTML = result;
            document.getElementById("second_color").innerHTML = result;

        }

    })

}

function getTopsRules(){

    $.ajax({

        type: 'POST',
        data: {

            op: 12

        },
        url: "model.php",
        success: function(result){

            document.getElementById("first_top").innerHTML = result;
            document.getElementById("second_top").innerHTML = result;

        }

    })

}

function saveItemsThatDontGoTogether(){

    var first_item = document.getElementById("first_item").value;
    var second_item = document.getElementById("second_item").value;

    $.ajax({

        type: 'POST',
        data: {

            op: 13,
            first_item: first_item,
            second_item: second_item

        },
        url: "model.php",
        success: function(result){

            document.getElementById("form1").reset();
            $('#saved').modal('show');

        }

    })

}

function saveColorsThatDontGoTogether(){

    var first_color = document.getElementById("first_color").value;
    var second_color = document.getElementById("second_color").value;

    $.ajax({

        type: 'POST',
        data: {

            op: 14,
            first_color: first_color,
            second_color: second_color

        },
        url: "model.php",
        success: function(result){

            document.getElementById("form2").reset();
            $('#saved').modal('show');

        }

    })

}

function saveTopsThatCanHaveASecondLayer(){

    var first_top = document.getElementById("first_top").value;
    var second_top = document.getElementById("second_top").value;

    $.ajax({

        type: 'POST',
        data: {

            op: 15,
            first_top: first_top,
            second_top: second_top

        },
        url: "model.php",
        success: function(result){

            document.getElementById('form3').reset();
            $('#saved').modal('show');

        }

    })
    
}

function getRulesList(){

    $.ajax({

        type: 'POST',
        data: {

            op: 16

        },
        url: "model.php",
        success: function(result){

            document.getElementById('rulesList').innerHTML = result;

        }

    })

}

function editRule(idRule){

    $('#modalRules').modal('show');

    $.ajax({

        type: 'POST',
        data: {

            op: 17,
            idRule: idRule

        },
        url: "model.php",
        success: function(result){

            var obJSON = JSON.parse(result);
            document.getElementById("rule_one").innerHTML = obJSON.rule_one;
            document.getElementById("rule_two").innerHTML = obJSON.rule_two;
            document.getElementById("rule_type").innerHTML = obJSON.rule_type;
            $('#buttonSaveRule').attr('onclick', 'saveEditRule('+obJSON.idRule+')');

        }

    })

}

function saveEditRule(idRule){

    var rule_one = document.getElementById("rule_one").value;
    var rule_two = document.getElementById("rule_two").value;
    var rule_type = document.getElementById("rule_type").textContent;

    $.ajax({

        type: 'POST',
        data: {

            op: 18,
            rule_one: rule_one,
            rule_two: rule_two,
            rule_type: rule_type,
            idRule: idRule

        },
        url: "model.php",
        success: function(result){

            getRulesList();
            $('#modalRules').modal('hide');
            $('#saved').modal("show");

        }

    })

}

function removeRule(idRule){

    $.ajax({

        type: 'POST',
        data: {

            op: 19,
            idRule: idRule

        },
        url: "model.php",
        success: function(result){

            getRulesList();

        }

    })

}

function editPossibility(idPossibility){

    $('#modalPossibility').modal('show');

    $.ajax({

        type: 'POST',
        data: {

            op: 20,
            idPossibility: idPossibility

        },
        url: "model.php",
        success: function(result){

            var obJSON = JSON.parse(result);
            document.getElementById("possibility_one").innerHTML = obJSON.possibility_one;
            document.getElementById("possibility_two").innerHTML = obJSON.possibility_two;
            $('#buttonSavePossibility').attr('onclick', 'saveEditPossibility('+obJSON.idPossibility+')');

        }

    })

}

function saveEditPossibility(idPossibility){

    var possibility_one = document.getElementById("possibility_one").value;
    var possibility_two = document.getElementById("possibility_two").value;

    $.ajax({

        type: 'POST',
        data: {

            op: 21,
            idPossibility: idPossibility,
            possibility_one: possibility_one,
            possibility_two: possibility_two

        },
        url: "model.php",
        success: function(result){

            getRulesList();
            $('#modalPossibility').modal('hide');
            $('#saved').modal('show');

        }

    })

}

function removePossibility(idPossibility){

    $.ajax({

        type: 'POST',
        data: {

            op: 22,
            idPossibility: idPossibility

        },
        url: "model.php",
        success: function(result){

            getRulesList();

        }

    })

}

function saveOutfit(){

    var ids = document.getElementById("ids").value;
    console.log(ids);

    $.ajax({

        type: 'POST',
        data: {
            op: 23,
            ids: ids
        },
        url: "model.php",
        success: function(result){

            alert(result);

        }

    })

}

function getOutfits(){

    $.ajax({

        type: 'POST',
        data:{

            op: 24

        },
        url: "model.php",
        success: function(result){

            document.getElementById("outfitsList").innerHTML = result;

        }

    })

}

function removeOutfit(idOutfit){

    $.ajax({

        type: 'POST',
        data: {

            op: 25,
            idOutfit: idOutfit

        },
        url: "model.php",
        success: function(result){

            alert(result);
            getOutfits();

        }

    })

}


function startTime() {

    const today = new Date();
    let h = today.getHours();
    let m = today.getMinutes();
    let s = today.getSeconds();
    const weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
    let d = weekday[today.getDay()];
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML = d + "<br>" + h + ":" + m + ":" + s;
    setTimeout(startTime, 1000);

}
  
function checkTime(i) {

    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;

}

//apply rules on outfits (or not()) -> controller -> calças, sapatos e casacos
// falta adicionar acessórios (suspensórios, gravatas, chapeús)