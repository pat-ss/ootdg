<?php

require_once "controller.php";

if (isset($_POST['op']) && $_POST['op'] == 1){

    $generateOutfit = new Outfit();
    $result = $generateOutfit -> generateOutfit();
    print_r($result);
    
} else if (isset($_POST['op']) && $_POST['op'] == 2){
    
    $getSeasons = new Outfit();
    $result = $getSeasons -> getSeasons();
    echo($result);

} else if (isset($_POST['op']) && $_POST['op'] == 3){

    $getType = new Outfit();
    $result = $getType -> getType();
    echo($result);

} else if (isset($_POST['op']) && $_POST['op'] == 4){

    $getSubtype = new Outfit();
    $result = $getSubtype -> getSubtype($_POST['type']);
    echo($result);

} else if (isset($_POST['op']) && $_POST['op'] == 5){

    $getColors = new Outfit();
    $result = $getColors -> getColors();
    echo($result);

} else if (isset($_POST['op']) && $_POST['op'] == 6){

    $saveClothes = new Outfit();
    $result = $saveClothes -> saveClothes($_POST['description'], $_POST['season'], $_POST['type'], $_POST['subtype'], $_POST['pattern'], $_POST['colors'], $_POST['img']);
    print_r($result);

} else if (isset($_POST['op']) && $_POST['op'] == 7){

    $getClothesList = new Outfit();
    $result = $getClothesList -> getClothesList();
    echo($result);

} else if (isset($_POST['op']) && $_POST['op'] == 8){

    $editItem = new Outfit();
    $result = $editItem -> editItem($_POST['idItem']);
    print_r($result);

} else if (isset($_POST['op']) && $_POST['op'] == 9){

    $saveEditItem = new Outfit();
    $result = $saveEditItem -> saveEditItem($_POST['idItem'], $_POST['description'], $_POST['season'], $_POST['type'], $_POST['subtype'], $_POST['pattern'], );
    echo($result);

} else if (isset($_POST['op']) && $_POST['op'] == 10){

    $getItemsRules = new Outfit();
    $result = $getItemsRules -> getItemsRules();
    echo($result);

} else if (isset($_POST['op']) && $_POST['op'] == 11){

    $getColorsRules = new Outfit();
    $result = $getColorsRules -> getColorsRules();
    echo($result);

} else if (isset($_POST['op']) && $_POST['op'] == 12){

    $getTopsRules = new Outfit();
    $result = $getTopsRules -> getTopsRules();
    echo($result);

} else if (isset($_POST['op']) && $_POST['op'] == 13){

    $saveItemsThatDontGoTogether = new Outfit();
    $result = $saveItemsThatDontGoTogether -> saveItemsThatDontGoTogether($_POST['first_item'], $_POST['second_item']);
    echo($result);

} else if (isset($_POST['op']) && $_POST['op'] == 14){

    $saveColorsThatDoGoTogether = new Outfit();
    $result = $saveColorsThatDoGoTogether -> saveColorsThatDontGoTogether($_POST['first_color'], $_POST['second_color']);
    echo($result);

} else if (isset($_POST['op']) && $_POST['op'] == 15){

    $saveTopsThatCanHaveASecondLayer = new Outfit();
    $result = $saveTopsThatCanHaveASecondLayer -> saveTopsThatCanHaveASecondLayer($_POST['first_top'], $_POST['second_top']);
    echo($result);
    
} else if (isset($_POST['op']) && $_POST['op'] == 16){

    $getRulesList = new Outfit();
    $result = $getRulesList -> getRulesList();
    echo($result);

} else if (isset($_POST['op']) && $_POST['op'] == 17){

    $editRule = new Outfit();
    $result = $editRule -> editRule($_POST['idRule']);
    echo($result);

} else if (isset($_POST['op']) && $_POST['op'] == 18){

    $saveEditRule = new Outfit();
    $result = $saveEditRule -> saveEditRule($_POST['rule_one'], $_POST['rule_two'], $_POST['rule_type'], $_POST['idRule']);
    echo($result);

} else if (isset($_POST['op']) && $_POST['op'] == 19){

    $removeRule = new Outfit();
    $result = $removeRule -> removeRule($_POST['idRule']);
    echo($result);

} else if (isset($_POST['op']) && $_POST['op'] == 20){

    $editPossibility = new Outfit();
    $result = $editPossibility -> editPossibility($_POST['idPossibility']);
    echo($result);

} else if (isset($_POST['op']) && $_POST['op'] == 21){

    $saveEditPossibility = new Outfit();
    $result = $saveEditPossibility -> saveEditPossibility($_POST['idPossibility'], $_POST['possibility_one'], $_POST['possibility_two']);
    echo($result);

} else if (isset($_POST['op']) && $_POST['op'] == 22){

    $removePossibility = new Outfit();
    $result = $removePossibility -> removePossibility($_POST['idPossibility']);
    echo($result);

} else if (isset($_POST['op']) && $_POST['op'] == 23){

    $saveOutfit = new Outfit();
    $result = $saveOutfit -> saveOutfit($_POST['ids']);
    echo($result);

} else if (isset($_POST['op']) && $_POST['op'] == 24){

    $getOutfits = new Outfit();
    $result = $getOutfits -> getOutfits();
    echo($result);

} else if (isset($_POST['op']) && $_POST['op'] == 25){

    $deleteOutfit = new Outfit();
    $result = $deleteOutfit -> deleteOutfit($_POST['idOutfit']);
    echo($result);
    
} else if (isset($_POST['op']) && $_POST['op'] == 26){

    $deleteItem = new Outfit();
    $result = $deleteItem -> deleteItem($_POST['idItem']);
    echo($result);

} else if (isset($_POST['op']) && $_POST['op'] == 27){

    $generateOutfitWithRules = new Outfit();
    $result = $generateOutfitWithRules -> generateOutfitWithRules();
    echo($result);

} else if (isset($_POST['op']) && $_POST['op'] == 28){

    $generateImages = new Outfit();
    $result = $generateImages -> generateImages($_POST['ids']);
    echo($result);
    
}


?>