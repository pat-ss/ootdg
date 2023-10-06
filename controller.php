<?php

require_once "config.php";

class Outfit{

    function generateImages($ids){

        global $conn;

        $topImage = "no image provided";
        $second_topImage = "no image provided";
        $bottomImage = "no image provided";
        $shoesImage = "no image provided";
        $jacketImage = "no image provided";
        $url_array = "";
        $res = "<div class='card shadow h-100 '>
        <div class='card-body' style='padding-bottom: 0;'>
            <div class='row no-gutters align-items-center'>
                <div class='col'>";
                    
                    
        
        $images = array();

        for($i = 0; $i < count($ids); $i++){

            $sql = "SELECT image FROM items WHERE idItem = '".$ids[$i]."';";

            $result = $conn -> query($sql);

            if($result -> num_rows > 0){

                while($row = $result -> fetch_assoc()){

                    $res .= "<img src='".$row['image']."' style='width: 20%;'><br>";

                }

            }

        }

        $res .= "
        </div>
    </div>
</div>
</div>";

        return($res);

    }

    function generateOutfit(){

        global $conn;

        $top = "";
        $id_top = 0;
        $top_count = "";
        $top_possibilities = [];
        $random = "";
        $bottom = "";
        $id_bottom = 0;
        $bottom_count = "";
        $shoes = "";
        $id_shoes = 0;
        $shoes_count = "";
        $all_tops = [];
        $all_bottoms = [];
        $all_shoes = [];
        $id_jacket = 0;
        $jacket_count = "";
        $all_jackets = [];
        $jacket = "";
        $second_top = "no second top";
        $id_second_top = 0;
        $r34 = 0;
        $r35 = 0;
        $r37 = 0;
        $r38 = 0;
        $random = 0;

        $sql = "SELECT COUNT(idItem) as count FROM items, type WHERE type_description = 'top' AND items.type = type.idType;";

        $fetched = $conn -> query($sql);

        while($row = $fetched -> fetch_assoc()){

            if($row['count'] > 0){

                $top_count = $row['count'];
                $random = rand(0, $top_count-1);
                
                $sql5 = "SELECT * FROM items, type WHERE type_description = 'top' AND items.type = type.idType;";

                $fetched5 = $conn -> query($sql5);

                if($fetched5 -> num_rows > 0){

                    while($row5 = $fetched5 -> fetch_assoc()){

                        array_push($all_tops, $row5['idItem']);

                    }
                }
                
            }

            $sql2 = "SELECT * FROM items WHERE idItem = '".$all_tops[$random]."';";

            $fetched2 = $conn -> query($sql2);

            if($fetched2 -> num_rows > 0){

                while($row2 = $fetched2 -> fetch_assoc()){

                    $id_top = $row2['idItem'];
                    $top = $row2['item_description'];

                    $sql3 = "SELECT * FROM possibilities WHERE id_one = '".$row2['sub_type']."' OR id_two = '".$row2['sub_type']."';";

                    $fetched3 = $conn -> query($sql3);

                    if($fetched3 -> num_rows > 0){

                        while($row3 = $fetched3 -> fetch_assoc()){

                            if($row3['id_one'] == $row2['sub_type']){

                                $sql4 = "SELECT item_description FROM items WHERE sub_type = '".$row3['id_two']."';";

                                $fetched4 = $conn -> query($sql4);

                                if($fetched4 -> num_rows > 0){

                                    while($row4 = $fetched4 -> fetch_assoc()){

                                        array_push($top_possibilities, $row4['item_description']);

                                    }

                                }

                                $random = rand(0, count($top_possibilities)-1);
                                $second_top = $top_possibilities[$random];

                                if($second_top != ""){

                                    $sql34 = "SELECT idItem FROM items WHERE item_description = '".$second_top."';";

                                    $result34 = $conn -> query($sql34);

                                    if($result34 -> num_rows > 0){

                                        while($row34 = $result34 -> fetch_assoc()){

                                            $id_second_top = $row34['idItem'];
                                            $r34 = $row34['idItem'];

                                        }
                                    }

                                }
                                
                            } else {

                                $sql4 = "SELECT item_description FROM items WHERE sub_type = '".$row3['id_one']."';";

                                $fetched4 = $conn -> query($sql4);

                                if($fetched4 -> num_rows > 0){

                                    while($row4 = $fetched4 -> fetch_assoc()){

                                        array_push($top_possibilities, $row4['item_description']);

                                    }

                                }

                                $random = rand(0, count($top_possibilities)-1);
                                $second_top = $top_possibilities[$random];

                                if($second_top != ""){

                                    $sql35 = "SELECT idItem FROM items WHERE item_description = '".$second_top."';";

                                    $result35 = $conn -> query($sql35);

                                    if($result35 -> num_rows > 0){

                                        while($row35 = $result35 -> fetch_assoc()){

                                            $id_second_top = $row35['idItem'];
                                            $r35 = $row35['idItem'];

                                        }
                                    }

                                }

                            }
                            
                        }

                    }

                }

            } else {

                $top = "no top parts on database";

            }

        }

        $sql6 = "SELECT COUNT(idItem) as count FROM items, type WHERE type_description = 'bottom' AND items.type = type.idType;";

        $fetched6 = $conn -> query($sql6);

        while($row6 = $fetched6 -> fetch_assoc()){

            if($row6['count'] > 0){

                $bottom_count = $row6['count'];
                $random = rand(0, $bottom_count-1);
                
                $sql7 = "SELECT * FROM items, type WHERE type_description = 'bottom' AND items.type = type.idType;";

                $fetched7 = $conn -> query($sql7);

                if($fetched7 -> num_rows > 0){

                    while($row7 = $fetched7 -> fetch_assoc()){

                        array_push($all_bottoms, $row7['idItem']);

                    }

                }

                $sql8 = "SELECT * FROM items WHERE idItem = '".$all_bottoms[$random]."';";

                $fetched8 = $conn -> query($sql8);

                if($fetched8 -> num_rows > 0){

                    while($row8 = $fetched8 -> fetch_assoc()){

                        $id_bottom = $row8['idItem'];
                        $bottom = $row8['item_description'];

                    }

                }

            } else {

                $bottom = "no bottom pieces on database";

            }

        } 

        $sql9 = "SELECT COUNT(idItem) as count FROM items, type WHERE type_description = 'shoes' AND items.type = type.idType;";

        $fetched9 = $conn -> query($sql9);

        while($row9 = $fetched9 -> fetch_assoc()){

            if($row9['count'] > 0){

                $shoes_count = $row9['count'];
                $random = rand(0, $shoes_count-1);

                $sql10 = "SELECT * FROM items, type WHERE type_description = 'shoes' AND items.type = type.idType;";

                $fetched10 = $conn -> query($sql10);

                if($fetched10 -> num_rows > 0){

                    while($row10 = $fetched10 -> fetch_assoc()){

                        array_push($all_shoes, $row10['idItem']);

                    }

                }

                $sql11 = "SELECT * FROM items WHERE idItem = '".$all_shoes[$random]."';";

                $fetched11 = $conn -> query($sql11);

                if($fetched11 -> num_rows > 0){

                    while($row11 = $fetched11 -> fetch_assoc()){

                        $id_shoes= $row11['idItem'];
                        $shoes = $row11['item_description'];


                    }

                }

            } else {

                $shoes = "no shoes on database";

            }

        } 

        $sql12 = "SELECT COUNT(idItem) as count FROM items, type WHERE type_description = 'jacket' AND items.type = type.idType;";

        $fetched12 = $conn -> query($sql12);

        while($row12 = $fetched12 -> fetch_assoc()){

            if($row12['count'] > 0){
            

                $jacket_count = $row12['count'];
                $random = rand(0, $jacket_count-1);

                $sql13 = "SELECT * FROM items, type WHERE type_description = 'jacket' AND items.type = type.idType;";

                $fetched13 = $conn -> query($sql13);

                if($fetched13 -> num_rows > 0){

                    while($row13 = $fetched13 -> fetch_assoc()){

                        array_push($all_jackets, $row13['idItem']);

                    }

                }

                $sql14 = "SELECT * FROM items WHERE idItem = ".$all_jackets[$random].";";

                $fetched14 = $conn -> query($sql14);

                if($fetched14 -> num_rows > 0){

                    while($row14 = $fetched14 -> fetch_assoc()){

                        $id_jacket = $row14['idItem'];
                        $jacket = $row14['item_description'];

                    }

                }

            } else {

                $jacket = "no jackets on database";

            }

        }


        $result = array("top" => $top, "bottom" => $bottom, "shoes" => $shoes, "top_possibilities" => json_encode($top_possibilities), "id_top" => $id_top, "id_bottom" => $id_bottom, "jacket" => $jacket, "id_jacket" => $id_jacket, "second_top" => $second_top, "id_second_top" => $id_second_top, "id_shoes" => $id_shoes, "row34" => $r34, "row35" => $r35, "row37" => $r37, "row38" => $r38);
        $result = json_encode($result);
        return($result);

    }

    function generateOutfitWithRules(){

        global $conn;

        $top = "";
        $id_top = 0;
        $top_count = "";
        $top_possibilities = [];
        $random = "";
        $bottom = "";
        $id_bottom = 0;
        $bottom_count = "";
        $shoes = "";
        $id_shoes = 0;
        $shoes_count = "";
        $all_tops = [];
        $all_bottoms = [];
        $all_shoes = [];
        $id_jacket = 0;
        $jacket_count = "";
        $all_jackets = [];
        $jacket = "";
        $second_top = "no second top";
        $id_second_top = 0;
        $r34 = 0;
        $r35 = 0;
        $r37 = 0;
        $r38 = 0;

        $color_top1 = [];
        $color_top2 = [];

        $sql15 = "SELECT COUNT(idItem) as count FROM items, type WHERE type_description = 'top' AND items.type = type.idType;";

        $fetched15 = $conn -> query($sql15);

        while($row15 = $fetched15 -> fetch_assoc()){

            if($row15['count'] > 0){

                $top_count = $row15['count'];
                $random = rand(0, $top_count-1);
                
                $sql16 = "SELECT * FROM items, type WHERE type_description = 'top' AND items.type = type.idType;";

                $fetched16 = $conn -> query($sql16);

                if($fetched16 -> num_rows > 0){

                    while($row16 = $fetched16 -> fetch_assoc()){

                        array_push($all_tops, $row16['idItem']);

                    }
                }

                $sql17 = "SELECT * FROM items WHERE idItem = '".$all_tops[$random]."';";

                $fetched17 = $conn -> query($sql17);

                if($fetched17 -> num_rows > 0){

                    while($row17 = $fetched17 -> fetch_assoc()){

                        $id_top = $row17['idItem'];
                        $top = $row17['item_description'];

                        $sql20 = "SELECT * FROM items_colors, colors WHERE id_item = ".$id_top." AND items_colors.id_color = colors.idColor;";

                        $fetched20 = $conn -> query($sql20);

                        if($fetched20 -> num_rows > 0){

                            while($row20 = $fetched20 -> fetch_assoc()){

                                array_push($color_top1, $row20['idColor']);

                            }

                        }

                        $flag = 0;

                        while($flag != 1){

                            $sql18 = "SELECT * FROM possibilities WHERE id_one = ".$row17['sub_type']." OR id_two = ".$row17['sub_type'].";";

                            $fetched18 = $conn -> query($sql18);

                            if($fetched18 -> num_rows > 0){

                                while($row18 = $fetched18 -> fetch_assoc()){

                                    if($row18['id_one'] == $row17['sub_type']){

                                        $sql21 = "SELECT * FROM items_colors, colors WHERE items_colors.id_color = colors.idColor AND items_colors.id_item = ".$row18['id_one'].";";

                                        $fetched21 = $conn -> query($sql21);

                                        if($fetched21 -> num_rows > 0){

                                            while($row21 = $fetched21 -> fetch_assoc()){

                                                array_push($color_top2, $row21['idColor']);

                                            }

                                        }

                                        for($i = 0; $i < count($color_top1); $i++){

                                            $sql22 = "SELECT * FROM rules WHERE color_one = ".$color_top1[$i]." OR color_two = ".$color_top1[$i].";";

                                            $fetched22 = $conn -> query($sql22);

                                            if($fetched22 -> num_rows > 0){

                                                while($row22 = $fetched22 -> fetch_assoc()){

                                                    if($row22['color_one'] == $color_top1[$i] || $row22['color_two'] == $color_top1[$i]){

                                                        if(!in_array($row22['color_two'], $color_top2) || !in_array($row22['color_two'], $color_top2)){

                                                            $flag = 1;

                                                        }

                                                    } 

                                                }

                                            }

                                        }

                                        $sql19 = "SELECT item_description FROM items WHERE sub_type = '".$row18['id_two']."';";

                                        $fetched19 = $conn -> query($sql19);

                                        if($fetched19 -> num_rows > 0){

                                            while($row19 = $fetched19 -> fetch_assoc()){

                                                array_push($top_possibilities, $row19['item_description']);

                                            }

                                        }

                                        $random = rand(0, count($top_possibilities)-1);
                                        $second_top = $top_possibilities[$random];

                                        if($second_top != ""){

                                            $sql37 = "SELECT idItem FROM items WHERE item_description = '".$second_top."';";

                                            $result37 = $conn -> query($sql37);

                                            if($result37 -> num_rows > 0){

                                                while($row37 = $result37 -> fetch_assoc()){

                                                    $id_second_top = $row37['idItem'];
                                                    $r37 = $row37['idItem'];

                                                }
                                            }

                                        }

                                    } else {

                                        $sql23 = "SELECT * FROM items_colors, colors WHERE items_colors.id_color = colors.idColor AND items_colors.id_item = ".$row18['id_one'].";";

                                        $fetched23 = $conn -> query($sql23);

                                        if($fetched23 -> num_rows > 0){

                                            while($row23 = $fetched23 -> fetch_assoc()){

                                                array_push($color_top2, $row23['idColor']);

                                            }

                                        }

                                        for($i = 0; $i < count($color_top1); $i++){

                                            $sql24 = "SELECT * FROM rules WHERE color_one = ".$color_top1[$i]." OR color_two = ".$color_top1[$i].";";

                                            $fetched24 = $conn -> query($sql24);

                                            if($fetched24 -> num_rows > 0){

                                                while($row24 = $fetched24 -> fetch_assoc()){

                                                    if($row24['color_one'] == $color_top1[$i] || $row24['color_two'] == $color_top1[$i]){

                                                        if(!in_array($row24['color_two'], $color_top2) || !in_array($row24['color_two'], $color_top2)){

                                                            $flag = 1;

                                                        }

                                                    } 

                                                }

                                            }
                                            
                                        }

                                        $sql19 = "SELECT item_description FROM items WHERE sub_type = ".$row18['id_one'].";";

                                        $fetched19 = $conn -> query($sql19);

                                        if($fetched19 -> num_rows > 0){

                                            while($row19 = $fetched19 -> fetch_assoc()){

                                                array_push($top_possibilities, $row19['item_description']);

                                            }

                                        }

                                        $random = rand(0, count($top_possibilities)-1);
                                        $second_top = $top_possibilities[$random];

                                        if($second_top != ""){

                                            $sql38 = "SELECT idItem FROM items WHERE item_description = '".$second_top."';";

                                            $result38 = $conn -> query($sql38);

                                            if($result38 -> num_rows > 0){

                                                while($row38 = $result38 -> fetch_assoc()){

                                                    $id_second_top = $row38['idItem'];
                                                    $r38 = $row38['idItem'];

                                                }

                                            }

                                        }


                                    }
                                    
                                }

                            } else {

                                $flag = 1;

                            }
                            
                        }

                    }

                }

                $sql25 = "SELECT COUNT(idItem) as count FROM items, type WHERE type_description = 'bottom' AND items.type = type.idType;";

                $fetched25 = $conn -> query($sql25);

                while($row25 = $fetched25 -> fetch_assoc()){

                    if($row25['count'] > 0){

                        $bottom_count = $row25['count'];
                        $random = rand(0, $bottom_count-1);
                        
                        $sql26 = "SELECT * FROM items, type WHERE type_description = 'bottom' AND items.type = type.idType;";

                        $fetched26 = $conn -> query($sql26);

                        if($fetched26 -> num_rows > 0){

                            while($row26 = $fetched26 -> fetch_assoc()){

                                array_push($all_bottoms, $row26['idItem']);

                            }

                        }

                        $sql27 = "SELECT * FROM items WHERE idItem = '".$all_bottoms[$random]."';";

                        $fetched27 = $conn -> query($sql27);

                        if($fetched27 -> num_rows > 0){

                            while($row27 = $fetched27 -> fetch_assoc()){

                                $id_bottom = $row27['idItem'];
                                $bottom = $row27['item_description'];

                            }

                        }

                    } else {

                        $bottom = "no bottom pieces on database";
        
                    }

                } 

                $sql28 = "SELECT COUNT(idItem) as count FROM items, type WHERE type_description = 'shoes' AND items.type = type.idType;";

                $fetched28 = $conn -> query($sql28);

                while($row28 = $fetched28 -> fetch_assoc()){

                    if($row28['count'] > 0){

                        $shoes_count = $row28['count'];
                        $random = rand(0, $shoes_count-1);

                        $sql29 = "SELECT * FROM items, type WHERE type_description = 'shoes' AND items.type = type.idType;";

                        $fetched29 = $conn -> query($sql29);

                        if($fetched29 -> num_rows > 0){

                            while($row29 = $fetched29 -> fetch_assoc()){

                                array_push($all_shoes, $row29['idItem']);

                            }

                        }

                        $sql30 = "SELECT * FROM items WHERE idItem = '".$all_shoes[$random]."';";
        
                        $fetched30 = $conn -> query($sql30);
        
                        if($fetched30 -> num_rows > 0){
        
                            while($row30 = $fetched30 -> fetch_assoc()){
        
                                $id_shoes= $row30['idItem'];
                                $shoes = $row30['item_description'];
        
        
                            }
        
                        }

                    } else {

                        $shoes = "no shoes on database";
        
                    }

                } 

                $sql31 = "SELECT COUNT(idItem) as count FROM items, type WHERE type_description = 'jacket' AND items.type = type.idType;";

                $fetched31 = $conn -> query($sql31);

                while($row31 = $fetched31 -> fetch_assoc()){

                    if($row31['count'] > 0){
                    

                        $jacket_count = $row31['count'];
                        $random = rand(0, $jacket_count-1);

                        $sql32 = "SELECT * FROM items, type WHERE type_description = 'jacket' AND items.type = type.idType;";

                        $fetched32 = $conn -> query($sql32);

                        if($fetched32 -> num_rows > 0){

                            while($row32 = $fetched32 -> fetch_assoc()){

                                array_push($all_jackets, $row32['idItem']);

                            }

                        }

                        $sql33 = "SELECT * FROM items WHERE idItem = ".$all_jackets[$random].";";

                        $fetched33 = $conn -> query($sql33);

                        if($fetched33 -> num_rows > 0){

                            while($row33 = $fetched33 -> fetch_assoc()){

                                $id_jacket = $row33['idItem'];
                                $jacket = $row33['item_description'];

                            }

                        }

                    } else {

                        $jacket = "no jackets on database";

                    }

                }
                
            } else {

                $top = "no top parts on database";

            }

        }

        $result = array("top" => $top, "bottom" => $bottom, "shoes" => $shoes, "top_possibilities" => json_encode($top_possibilities), "id_top" => $id_top, "id_bottom" => $id_bottom, "jacket" => $jacket, "id_jacket" => $id_jacket, "second_top" => $second_top, "id_second_top" => $id_second_top, "id_shoes" => $id_shoes, "row34" => $r34, "row35" => $r35, "row37" => $r37, "row38" => $r38);
        $result = json_encode($result);
        return($result);

    }

    function getSeasons(){

        global $conn;

        $res = "<option value='empty'></option>";

        $sql = "SELECT * FROM seasons;";

        $fetched = $conn -> query($sql);

        if($fetched -> num_rows > 0){

            while($row = $fetched -> fetch_assoc()){

                $res .= "<option value=".$row['idSeason'].">".$row['season_description']."</option>";

            }

        }

        return($res);

    }

    function getType(){

        global $conn;

        $res = "<option value='empty'></option>";

        $sql = "SELECT * FROM type;";

        $fetched = $conn -> query($sql);

        if($fetched -> num_rows > 0){

            while($row = $fetched -> fetch_assoc()){

                $res .= "<option value=".$row['idType'].">".$row['type_description']."</option>";

            }

        }

        return($res);

    }

    function getSubtype($type){

        global $conn;

        $res = "<option value='empty'></option>";

        $sql = "SELECT * FROM sub_type WHERE id_type = '".$type."';";

        $fetched = $conn -> query($sql);

        if($fetched -> num_rows > 0){

            while($row = $fetched -> fetch_assoc()){

                $res .= "<option value=".$row['idSubtype'].">".$row['subtype_description']."</option>";

            }

        }

        return($res);

    }

    function getColors(){

        global $conn;

        $res = "";
        $color_ids = [];

        $sql = "SELECT * FROM colors;";

        $fetched = $conn -> query($sql);

        if($fetched -> num_rows > 0){

            while($row = $fetched -> fetch_assoc()){

                $res .= "<input type='checkbox' style='border: #fff;' id='color".$row['idColor']."' value=".$row['idColor'].">
                <label for='color".$row['idColor']."'> ".$row['color_description']." </label><br>";
                array_push($color_ids, $row['idColor']);

            }

        }

        $result = array("res" => $res, "color_ids" => json_encode($color_ids));
        $result = json_encode($result);

        return($result);

    }

    function saveClothes($description, $season, $type, $subtype, $pattern, $colors, $img){

        global $conn;

        $result1 = "";
        $item_id = "";
        $result3 = "";

        $sql = "INSERT INTO items (idItem, item_description, season, type, sub_type, pattern, image) VALUES (NULL, '".$description."', ".$season.", ".$type.", ".$subtype.", '".$pattern."', '".$img."');";

        if(mysqli_query($conn, $sql)){

            $result1 = "done 1";

            $sql2 = "SELECT idItem FROM items ORDER BY idItem DESC LIMIT 1;";

            $fetched2 = $conn -> query($sql2);

            if($fetched2 -> num_rows > 0){

                while($row2 = $fetched2 -> fetch_assoc()){

                    $item_id = $row2['idItem'];

                    for($i = 0; $i < count($colors); $i++){

                        $sql3 = "INSERT INTO items_colors (idList, id_item, id_color) VALUES (NULL, ".$item_id.", ".$colors[$i].");";

                        if(mysqli_query($conn, $sql3)){

                            $result3 .= $colors[$i]." done";

                        } else {

                            $result3 .= $colors[$i]." ".mysqli_error($conn);

                        }

                    } 

                }

            }

        } else {

            $result1 = mysqli_error($conn);

        }

        $result = array("result1" => $result1, "item_id" => $item_id, "result3" => $result3);
        $result = json_encode($result);

        return($result);

    }

    function getClothesList(){

        global $conn;

        $result = "<tr>
        <th style='text-align: center;'>Description</th>
        <th style='text-align: center;'>Season</th>
        <th style='text-align: center;'>Type</th>
        <th style='text-align: center;'>Subtype</th>
        <th style='text-align: center;'>Pattern</th>
        <th style='text-align: center;'>Picture</th>
        <th style='text-align: center;'></th>";

        $sql = "SELECT * FROM items, seasons, type, sub_type WHERE items.season = seasons.idSeason AND items.type = type.idType AND sub_type.id_type = type.idType AND items.sub_type = sub_type.idSubtype ORDER BY idItem;";

        $fetched = $conn -> query($sql);

        if($fetched -> num_rows > 0){

            while($row = $fetched -> fetch_assoc()){

                $result .= "<tr>
                    <td style='text-align: center; vertical-align: middle;'>".$row["item_description"]."</td>
                    <td style='text-align: center; vertical-align: middle; overflow-wrap: break-word;'>".$row["season_description"]."</td>
                    <td style='text-align: center; vertical-align: middle;'>".$row["type_description"]."</td>
                    <td style='text-align: center; vertical-align: middle;'>".$row["subtype_description"]."</td>
                    <td style='text-align: center; vertical-align: middle;'>".$row["pattern"]."</td>
                    <td style='text-align: center; vertical-align: middle;'><img src='".$row["image"]."' style='max-height: 75px;'></td>
                        
                    <td style='text-align: center; vertical-align: middle;'>
                        <button onclick='editItem(".$row["idItem"].")' style='font-size: smaller; border: none;'  class='btn'>
                            <i class='fas fa-pencil-alt'></i>&nbsp;&nbsp;Edit&nbsp;&nbsp;
                        </button>
                        <br>
                        <button onclick='removeItem(".$row["idItem"].")' style='font-size: smaller; border: none;'  class='btn'>
                            <i class='fas fa-trash'></i>&nbsp;&nbsp;Remove&nbsp;&nbsp;
                        </button>
                        
                    </td>
                </tr>";

            }

        }

        return($result);

    }

    function editItem($idItem){

        global $conn;

        $description = "";
        $season = "";
        $season_id = 0;
        $type = "";
        $subtype = "";
        $pattern = "";

        $sql = "SELECT * FROM items, seasons, type, sub_type WHERE items.season = seasons.idSeason AND items.type = type.idType AND sub_type.id_type = type.idType AND items.sub_type = sub_type.idSubtype AND idItem = '".$idItem."' ORDER BY idItem;";

        $fetched = $conn -> query($sql);

        if($fetched -> num_rows > 0){

            while($row = $fetched -> fetch_assoc()){

                $description = $row['item_description'];

                $season_id = $row['season'];

                $sql2 = "SELECT * FROM seasons;";

                $fetched2 = $conn -> query($sql2);

                if($fetched2 -> num_rows > 0){

                    while($row2 = $fetched2 -> fetch_assoc()){

                        if($row2['idSeason'] == $season_id){

                            $season .= "<option value='".$row2['idSeason']."' selected>".$row2['season_description']."</option>";

                        } else {

                            $season .= "<option value='".$row2['idSeason']."'>".$row2['season_description']."</option>";

                        }
 
                    }
                }

                $type = $row['type_description'];
                $subtype = $row['subtype_description'];
                $pattern = $row['pattern'];

            }

        }

        $result = array("idItem" => $idItem, "description" => $description, "season" => $season, "type" => $type, "subtype" => $subtype, "pattern" => $pattern);
        $result = json_encode($result);

        return($result);

    }

    function saveEditItem($idItem, $description, $season, $type, $subtype, $pattern){

        global $conn;

        $result = "";
        $type_id = 0;
        $subtype_id = 0;

        $sql2 = "SELECT idType FROM type WHERE type_description = '".$type."';";

        $fetched2 = $conn -> query($sql2);

        if($fetched2 -> num_rows > 0){

            while($row2 = $fetched2 -> fetch_assoc()){

                $type_id = $row2['idType'];

                $sql3 = "SELECT idSubtype FROM sub_type WHERE subtype_description = '".$subtype."' AND id_type = ".$type_id.";";

                $fetched3 = $conn -> query($sql3);

                if($fetched3 -> num_rows > 0){

                    while($row3 = $fetched3 -> fetch_assoc()){

                        $subtype_id = $row3['idSubtype'];

                    }

                }

            }

        }

        $sql = "UPDATE items SET item_description = '".$description."', season = ".$season.", type = ".$type_id.", sub_type = ".$subtype_id.", pattern = '".$pattern."' WHERE idItem = ".$idItem.";";

        if(mysqli_query($conn, $sql)){

            $result = "done";

        } else {

            $result = mysqli_error($conn);

        }

        return($result);

    }

    function getItemsRules(){

        global $conn;

        $result = "<option value='empty'></option>";

        $sql = "SELECT * FROM items;";

        $fetched = $conn -> query($sql);

        if($fetched -> num_rows > 0){

            while($row = $fetched -> fetch_assoc()){

                $result .= "<option value=".$row['idItem'].">".$row['item_description']."</option>";

            }

        }

        return($result);

    }

    function getColorsRules(){

        global $conn;

        $result = "<option value='empty'></option>";

        $sql = "SELECT * FROM colors;";
        
        $fetched = $conn -> query($sql);

        if($fetched -> num_rows > 0){

            while($row = $fetched -> fetch_assoc()){

                $result .= "<option value=".$row['idColor'].">".$row['color_description']."</option>";

            }

        }

        return($result);

    }

    function getTopsRules(){

        global $conn;

        $result = "<option value='empty'></option>";

        $sql = "SELECT idSubtype, subtype_description FROM sub_type, type WHERE sub_type.id_type = type.idType AND type.type_description = 'top';";

        $fetched = $conn -> query($sql);

        if($fetched -> num_rows > 0){

            while($row = $fetched -> fetch_assoc()){

                $result .= "<option value=".$row['idSubtype'].">".$row['subtype_description']."</option>";

            }

        }

        return($result);

    }

    function saveItemsThatDontGoTogether($first_item, $second_item){

        global $conn;

        $result = "";

        $sql = "INSERT INTO rules (idRule, item_one, item_two) VALUES (NULL, ".$first_item.", ".$second_item.");";

        if(mysqli_query($conn, $sql)){

            $result = "done";

        } else {

            $result = mysqli_error($conn);

        }

        return($result);

    }

    function saveColorsThatDontGoTogether($first_color, $second_color){

        global $conn;

        $result = "";

        $sql = "INSERT INTO rules (idRule, color_one, color_two) VALUES (NULL, ".$first_color.", ".$second_color.");";

        if(mysqli_query($conn, $sql)){

            $result = "done";

        } else {

            $result = mysqli_error($conn);

        }

        return($result);

    }

    function saveTopsThatCanHaveASecondLayer($first_top, $second_top){

        global $conn;

        $result = "";

        $sql = "INSERT INTO possibilities VALUES (NULL, ".$first_top.", ".$second_top.");";

        if(mysqli_query($conn, $sql)){

            $result = "done";

        } else {

            $result = mysqli_query($conn);

        }

        return($result);
        
    }

    function getRulesList(){

        global $conn;

        $result = "";

        $sql = "SELECT * FROM rules;";

        $fetched = $conn -> query($sql);

        if($fetched -> num_rows > 0){

            while($row = $fetched -> fetch_assoc()){

                if($row['item_one'] != ""){

                    $item_one = "";
                    $item_two = "";

                    $sql2 = "SELECT item_description FROM items WHERE idItem = ".$row['item_one'].";";

                    $fetched2 = $conn -> query($sql2);

                    if($fetched2 -> num_rows > 0){

                        while($row2 = $fetched2 -> fetch_assoc()){

                            $item_one = $row2['item_description'];

                        }

                    }

                    $sql3 = "SELECT item_description FROM items WHERE idItem = ".$row['item_two'].";";

                    $fetched3 = $conn -> query($sql3);

                    if($fetched3 -> num_rows > 0){

                        while($row3 = $fetched3 -> fetch_assoc()){

                            $item_two = $row3['item_description'];

                        }

                    }

                    $result .= "<tr>
                                <td style='text-align: center'>".$item_one."</td>
                                <td style='text-align: center; color: #a83232;'>doesn't go with</td>
                                <td style='text-align: center'>".$item_two."</td>
                                    
                                <td class='project-actions' style='text-align: center;'>
                                    <button class='btn' onclick='editRule(".$row["idRule"].")'>
                                        <i class='fas fa-pencil-alt'></i>&nbsp;&nbsp;Edit&nbsp;&nbsp;
                                    </button>
                                    
                                    <button class='btn' onclick='removeRule(".$row["idRule"].")'>
                                        <i class='fas fa-trash'></i>&nbsp;&nbsp;Remove&nbsp;&nbsp;
                                    </button>
                                    
                                </td>
                            </tr>";

                } else {

                    $color_one = "";
                    $color_two = "";

                    $sql4 = "SELECT color_description FROM colors WHERE idColor = ".$row['color_one'].";";

                    $fetched4 = $conn -> query($sql4);

                    if($fetched4 -> num_rows > 0){

                        while($row4 = $fetched4 -> fetch_assoc()){

                            $color_one = $row4['color_description'];

                        }

                    }

                    $sql5 = "SELECT color_description FROM colors WHERE idColor = ".$row['color_two'].";";

                    $fetched5 = $conn -> query($sql5);

                    if($fetched5 -> num_rows > 0){

                        while($row5 = $fetched5 -> fetch_assoc()){

                            $color_two = $row5['color_description'];

                        }

                    }

                    $result .= "<tr>
                                <td style='text-align: center'>".$color_one."</td>
                                <td style='text-align: center; color: #a83232;'>doesn't go with</td>
                                <td style='text-align: center'>".$color_two."</td>
                                    
                                <td class='project-actions' style='text-align: center;'>
                                    <button class='btn' onclick='editRule(".$row["idRule"].")'>
                                        <i class='fas fa-pencil-alt'></i>&nbsp;&nbsp;Edit&nbsp;&nbsp;
                                    </button>
                                    
                                    <button class='btn' onclick='removeRule(".$row["idRule"].")'>
                                        <i class='fas fa-trash'></i>&nbsp;&nbsp;Remove&nbsp;&nbsp;
                                    </button>
                                    
                                </td>
                            </tr>";

                }

            }

        }

        $sql6 = "SELECT * FROM possibilities;";

        $fetched6 = $conn -> query($sql6);

        if($fetched6 -> num_rows > 0){

            while($row6 = $fetched6 -> fetch_assoc()){

                $possibility_one = "";
                $possibility_two = "";

                $sql7 = "SELECT item_description FROM items WHERE idItem = ".$row6['id_one'].";";

                $fetched7 = $conn -> query($sql7);

                if($fetched7 -> num_rows > 0){

                    while($row7 = $fetched7 -> fetch_assoc()){

                        $possibility_one = $row7['item_description'];

                    }

                }

                $sql8 = "SELECT item_description FROM items WHERE idItem = ".$row6['id_two'].";";

                $fetched8 = $conn -> query($sql8);

                if($fetched8 -> num_rows > 0){

                    while($row8 = $fetched8 -> fetch_assoc()){

                        $possibility_two = $row8['item_description'];

                    }
                    
                }

                $result .= "<tr>
                                <td style='text-align: center'>".$possibility_one."</td>
                                <td style='text-align: center; color: green;'>goes with</td>
                                <td style='text-align: center'>".$possibility_two."</td>
                                    
                                <td class='project-actions' style='text-align: center;'>
                                    <button class='btn' onclick='editPossibility(".$row6["idPossibility"].")'>
                                        <i class='fas fa-pencil-alt'></i>&nbsp;&nbsp;Edit&nbsp;&nbsp;
                                    </button>
                                    
                                    <button class='btn' onclick='removePossibility(".$row6["idPossibility"].")'>
                                        <i class='fas fa-trash'></i>&nbsp;&nbsp;Remove&nbsp;&nbsp;
                                    </button>
                                    
                                </td>
                            </tr>";

            }

        }

        return($result);

    }

    function editRule($idRule){

        global $conn;

        $rule_one = "";
        $rule_two = "";
        $rule_type = "";
        $item_one = 0;

        $sql = "SELECT * FROM rules WHERE idRule = ".$idRule.";";

        $fetched = $conn -> query($sql);

        if($fetched -> num_rows > 0){

            while($row = $fetched -> fetch_assoc()){

                $item_one = $row['item_one'];

                if($row['item_one'] != null){

                    $rule_type = "items";

                    $sql2 = "SELECT * FROM items;";

                    $fetched2 = $conn -> query($sql2);

                    if($fetched2 -> num_rows > 0){

                        while($row2 = $fetched2 -> fetch_assoc()){

                            if($row2['idItem'] == $row['item_one']){

                                $rule_one .= "<option value=".$row2['idItem']." selected>".$row2['item_description']."</option>";

                            } else {

                                $rule_one .= "<option value=".$row2['idItem'].">".$row2['item_description']."</option>";

                            }

                            if($row2['idItem'] == $row['item_two']){

                                $rule_two .= "<option value=".$row2['idItem']." selected>".$row2['item_description']."</option>";

                            } else {

                                $rule_two .= "<option value=".$row2['idItem'].">".$row2['item_description']."</option>";

                            }

                        }

                    }

                } else {

                    $rule_type = "colors";

                    $sql3 = "SELECT * FROM colors;";

                    $fetched3 = $conn -> query($sql3);

                    if($fetched3 -> num_rows > 0){

                        while($row3 = $fetched3 -> fetch_assoc()){

                            if($row3['idColor'] == $row['color_one']){

                                $rule_one .= "<option value=".$row3['idColor']." selected>".$row3['color_description']."</option>";

                            } else {

                                $rule_one .= "<option value=".$row3['idColor'].">".$row3['color_description']."</option>";

                            }

                            if($row3['idColor'] == $row['color_two']){

                                $rule_two .= "<option value=".$row3['idColor']." selected>".$row3['color_description']."</option>";

                            } else {

                                $rule_two .= "<option value=".$row3['idColor'].">".$row3['color_description']."</option>";

                            }

                        }

                    }

                }
                
            }

        }

        $result = array("rule_one" => $rule_one, "rule_two" => $rule_two, "rule_type" => $rule_type, "idRule" => $idRule, "item_one" => $item_one);
        $result = json_encode($result);

        return($result);

    }

    function saveEditRule($rule_one, $rule_two, $rule_type, $idRule){

        global $conn;

        $result = "";

        if($rule_type == "items"){

            $sql = "UPDATE rules SET item_one = ".$rule_one.", item_two = ".$rule_two." WHERE idRule = ".$idRule.";";

            if(mysqli_query($conn, $sql)){

                $result = "done";

            } else {

                $result = mysqli_error($conn);

            }

        } else {

            $sql2 = "UPDATE rules SET color_one = ".$rule_one.", color_two = ".$rule_two." WHERE idRule = ".$idRule.";";

            if(mysqli_query($conn, $sql2)){

                $result = "done";

            } else {

                $result = mysqli_error($conn);

            }

        }

        return($result);

    }

    function removeRule($idRule){

        global $conn;

        $result = "";

        $sql = "DELETE FROM rules WHERE idRule = ".$idRule.";";

        if(mysqli_query($conn, $sql)){

            $result = "done";

        } else {

            $result = mysqli_error($conn);

        }

        return($result);

    }

    function editPossibility($idPossibility){

        global $conn;

        $possibility_one = "";
        $possibility_two = "";

        $sql = "SELECT * FROM possibilities WHERE idPossibility = ".$idPossibility.";";

        $fetched = $conn -> query($sql);

        if($fetched -> num_rows > 0){

            while($row = $fetched -> fetch_assoc()){

                $sql2 = "SELECT * FROM items;";

                $fetched2 = $conn -> query($sql2);

                if($fetched2 -> num_rows > 0){

                    while($row2 = $fetched2 -> fetch_assoc()){

                        if($row2['idItem'] == $row['id_one']){

                            $possibility_one .= "<option value=".$row2['idItem']." selected>".$row2['item_description']."</option>";

                        } else {

                            $possibility_one .= "<option value=".$row2['idItem'].">".$row2['item_description']."</option>";

                        }

                        if($row2['idItem'] == $row['id_two']){

                            $possibility_two .= "<option value=".$row2['idItem']." selected>".$row2['item_description']."</option>";

                        } else {

                            $possibility_two .= "<option value=".$row2['idItem'].">".$row2['item_description']."</option>";
                            
                        }
                        
                    }

                }

            }

        }

        $result = array("possibility_one" => $possibility_one, "possibility_two" => $possibility_two, "idPossibility" => $idPossibility);
        $result = json_encode($result);

        return($result);

    }

    function saveEditPossibility($idPossibility, $possibility_one, $possibility_two){

        global $conn;

        $result = "";

        $sql = "UPDATE possibilities SET id_one = ".$possibility_one.", id_two = ".$possibility_two." WHERE idPossibility = ".$idPossibility.";";

        if(mysqli_query($conn, $sql)){

            $result = "done";

        } else {

            $result = mysqli_error($conn);

        }

        return($result);

    }

    function removePossibility($idPossibility){

        global $conn;

        $result = "";

        $sql = "DELETE FROM possibilities WHERE idPossibility = ".$idPossibility.";";

        if(mysqli_query($conn, $sql)){

            $result = "done";

        } else {

            $result = mysqli_error($conn);

        }

        return($result);

    }

    function saveOutfit($ids){

        global $conn;
        $res = "";

        if($ids[1] == 0){

            $sql = "INSERT INTO saved_outfits (idOutfit, top_outfit, bottom_outfit, shoes_outfit, jacket_outfit) VALUES (NULL, '".$ids[0]."', '".$ids[2]."', '".$ids[3]."', '".$ids[4]."');";

            if(mysqli_query($conn, $sql)){
    
                $res = "done";
    
            } else {
    
                $res = mysqli_error($conn);
    
            }

        } else {

            $sql2 = "INSERT INTO saved_outfits VALUES (NULL, '".$ids[0]."', '".$ids[1]."', '".$ids[2]."', '".$ids[3]."', '".$ids[4]."');";

            if(mysqli_query($conn, $sql2)){

                $res = "done";

            } else {

                $res = mysqli_error($conn);

            }

        }

        
        return($res);

    }

    function getOutfits(){

        global $conn;

        $res = "<tr>
        <th style='padding: 5px; text-align: center; vertical-align: middle;'>Top</th>
        <th style='padding: 5px; text-align: center; vertical-align: middle;'>Second Top</th>
        <th style='padding: 5px; text-align: center; vertical-align: middle;'>Bottom</th>
        <th style='padding: 5px; text-align: center; vertical-align: middle;'>Shoes</th>
        <th style='padding: 5px; text-align: center; vertical-align: middle;'>Jacket</th>
        <th style='padding: 5px; text-align: center; vertical-align: middle;'></th>";

        $sql = "SELECT * FROM saved_outfits";

        $result = $conn -> query($sql);

        if($result -> num_rows > 0){

            while($row = $result -> fetch_assoc()){

                $top = "";
                $second_top = "";
                $bottom = "";
                $shoes = "";
                $jacket = "";

                $sql2 = "SELECT item_description FROM items WHERE idItem = '".$row['top_outfit']."';";

                $result2 = $conn -> query($sql2);

                if($result -> num_rows > 0){

                    while($row2 = $result2 -> fetch_assoc()){

                        $top = $row2['item_description'];

                    }
                }

                if($row['second_top_outfit'] != ""){

                    $sql3 = "SELECT item_description FROM items WHERE idItem = '".$row['second_top_outfit']."';";

                    $result3 = $conn -> query($sql3);

                    if($result3 -> num_rows > 0){

                        while($row3 = $result3 -> fetch_assoc()){

                            $second_top = $row3['item_description'];

                        }

                    }

                }

                $sql4 = "SELECT item_description FROM items WHERE idItem = '".$row['bottom_outfit']."';";

                $result4 = $conn -> query($sql4);

                if($result4 -> num_rows > 0){

                    while($row4 = $result4 -> fetch_assoc()){

                        $bottom = $row4['item_description'];

                    }

                }

                $sql5 = "SELECT item_description FROM items WHERE idItem = '".$row['shoes_outfit']."';";

                $result5 = $conn -> query($sql5);

                if($result5 -> num_rows > 0){

                    while($row5 = $result5 -> fetch_assoc()){

                        $shoes = $row5['item_description'];

                    }

                }

                $sql6 = "SELECT item_description FROM items WHERE idItem = '".$row['jacket_outfit']."';";

                $result6 = $conn -> query($sql6);

                if($result6 -> num_rows > 0){

                    while($row6 = $result6 -> fetch_assoc()){

                        $jacket = $row6['item_description'];

                    }

                }

                $res .= "<tr>
                            <td style='padding: 5px; text-align: center; vertical-align: middle;'>".$top."</td>
                            <td style='padding: 5px; text-align: center; vertical-align: middle;'>".$second_top."</td>
                            <td style='padding: 5px; text-align: center; vertical-align: middle;'>".$bottom."</td>
                            <td style='padding: 5px; text-align: center; vertical-align: middle;'>".$shoes."</td>
                            <td style='padding: 5px; text-align: center; vertical-align: middle;'>".$jacket."</td>
                            <td style='text-align: center;'>
                                
                                <button onclick='removeOutfit(".$row["idOutfit"].")' class='btn'>
                                    <i class='fas fa-trash'></i>&nbsp;&nbsp;Remove&nbsp;&nbsp;
                                </button>
                                
                            </td>
                        </tr>";

            }

        }

        return($res);

    }

    function deleteOutfit($idOutfit){

        global $conn;

        $res = "";

        $sql = "DELETE FROM saved_outfits WHERE idOutfit = '".$idOutfit."';";

        if(mysqli_query($conn, $sql)){

            $res = "done";

        } else {

            $res = mysqli_error($conn);

        }

        return($res);

    }

    function deleteItem($idItem){

        global $conn;

        $res = "";
        $res2 = "";
        $res3 = "";
        $res4 = "";
        $res5 = "";

        $sql = "DELETE FROM items_colors WHERE id_item = '".$idItem."';";

        if(mysqli_query($conn, $sql)){

            $sql2 = "DELETE FROM possibilities WHERE id_one = '".$idItem."' OR id_two = '".$idItem."';";

            if(mysqli_query($conn, $sql2)){

                $sql3 = "DELETE FROM rules WHERE item_one = '".$idItem."' or item_two = '".$idItem."';";

                if(mysqli_query($conn, $sql3)){

                    $sql4 = "DELETE FROM saved_outfits WHERE top_outfit = '".$idItem."' OR second_top_outfit = '".$idItem."' OR bottom_outfit = '".$idItem."' OR shoes_outfit = '".$idItem."' OR jacket_outfit = '".$idItem."';";

                    if(mysqli_query($conn, $sql4)){

                        $sql5 = "DELETE FROM items WHERE idItem = '".$idItem."';";

                        if(mysqli_query($conn, $sql5)){

                            $res5 = "done";

                        } else {

                            $res5 = mysqli_error($conn);
                        }

                    } else {

                        $res4 = mysqli_error($conn);

                    }

                } else {

                    $res3 = mysqli_error($conn);
                }

            } else {

                $res2 = mysqli_error($conn);

            }

        } else {

            $res = mysqli_error($conn);

        }

        $resultado = array("res" => $res, "res2" => $res2, "res3" => $res3, "res4" => $res4, "res5" => $res5);
        $resultado = json_encode($resultado);

        return($resultado);

    }

}

?>