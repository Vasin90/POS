<?php

$q = $_REQUEST["q"];

$hint = $q;



// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "no suggestion11" : $hint;
?>