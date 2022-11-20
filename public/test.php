<?php 
$str = "uno, dos, tres, cuatro";


$strd = str_replace(" ", "", $str);
$nums = explode(",", $strd);
var_dump($nums);
?>