<?php



if(!isset($_GET["pgAtual"])){
    $init = 0;
}else{
    
    $pg = (int) $_GET["pgAtual"];

    if($pg === 1){
        $init = 0;
    }else{
        $init = -8 + (8 * $pg);
    }

}


    