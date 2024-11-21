<?php
function limterDescription($str){
    $description = $crawler->filter($str)->text();
    return substr($description,0,20);
}