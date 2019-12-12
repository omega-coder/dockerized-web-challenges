
<a href="index.php?showsource">Check Source!</a>

<?php

if (isset($_GET["showsource"])) {
    show_source(__FILE__);
    die();
}


$str=@(string)$_GET['str'];

function blackListFilter($black_list, $var){
    foreach ($black_list as $b) {
        if(stripos($var, $b) !== False){
            die("Invaild str: $b\n");
        }
    }
}

$black_list = ["'", '"'];
blackListFilter($black_list, $str);

eval('$str="'.addslashes($str).'";');
?>