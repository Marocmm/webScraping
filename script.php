<?php
require 'vendor/autoload.php';
require 'data.php';

use Symfony\Component\DomCrawler\Crawler;

$upcs = [];
$productsTypes = [];
$taxs = [];
$reviews = [];
$titles = [];
$prices = [];
$availabilitys = [];
$descriptions = [];


$h1 = '.product_main h1';
$p_description = '.sub-header + p';
$td = '.product_page .table tr td';

foreach($hrefs as $href){
    $url = 'https://books.toscrape.com/catalogue/'.$href;
    $html = file_get_contents($url);

    $crawler = new Crawler($html);

    $titles = [...$titles,...$crawler->filter($h1)->each(function ($node){
        return $node->text();
    })];

    $descriptions = [...$descriptions,substr($crawler->filter($p_description)->text(),0,30).'...'];

    $tables = $crawler->filter($td)->each(function ($node){
        return $node->text();
    });

    $upcs = [...$upcs,$tables[0]];

    $productsTypes = [...$productsTypes,$tables[1]];

    $prices = [...$prices,$tables[2]];

    $taxs = [...$taxs,$tables[4]];

    $availabilitys = [...$availabilitys,$tables[5]];

    $reviews = [...$reviews,$tables[6]];


}

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="data.csv');
header('Pragma: no-cache');
header('Expires: 0');

$output = fopen('php://output', 'w');
fputcsv($output, ['Upc', 'Title', 'Product type', 'Description','Price','Tax','Availability','Number of reviews'],";");

for($i=0;$i<count($titles);$i++){
    fputcsv($output, [$upcs[$i], $titles[$i], $productsTypes[$i], $descriptions[$i], $prices[$i], $taxs[$i], $availabilitys[$i], $reviews[$i]],";");
}

fclose($output);
exit;