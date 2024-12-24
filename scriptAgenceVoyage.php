<?php

require 'vendor/autoload.php';
require 'urls.php';


use Symfony\Component\DomCrawler\Crawler;



$titres = [];
$telephones = [];




$titre = 'div.I9iumb div.rgnuSb';
$telephone = 'div.I9iumb:nth-child(3) span.hGz87c:last-child span';

$url = 'https://www.google.com/localservices/prolist?g2lbs=AOHF13kL-YgLoD9ow9TCjxRrPP69xDvApiyv3-rOQfvURcRNy-vxoh61vcsDF9SR6IZSnK8S2Aqa&hl=ar-MA&gl=ma&cs=1&ssta=1&q=agence%20de%20voyage%20maroc&oq=agence%20de%20voyage%20maroc&slp=MgBSAggCYACSAasCCgwvZy8xMmhsNTB2d20KDS9nLzExYjZoX3pxZHYKDS9nLzExczFibHdfMmIKDS9nLzExY3J6anJnMWYKDS9nLzExYjZqZ3o3aGIKDS9nLzExaDBicjdiZnQKDS9nLzExanJfa21jYzUKDS9nLzExZnNxNnNxbmIKDS9nLzExY203Y3h2bjEKDS9nLzExZzZ6ZzJmd2cKDS9nLzExYjZqZ3FrXzUKDS9nLzExYzBxeTV6ZjUKDS9nLzExYzVfeGZyNGQKDS9nLzExYnR4Y2dqMGgKDS9nLzExYjZqMmQwMjEKDS9nLzExZzJ2XzZsc3YKDS9nLzExZHhqdzh3YjUKDS9nLzExYnRtMGN6cHYKDS9nLzExYjZqODJoYmIKDS9nLzExZm02Nmg3MmKaAQYKAhcZEAA%3D&src=2&serdesk=1&sa=X&ved=2ahUKEwiWmKmz75-KAxWXcKQEHca6DvoQjGp6BAghEAE&scp=ChBnY2lkOnRvdXJfYWdlbmN5EjoSEgmNxVGWYYgLDRHD_yzEgZPT2SIM2KfZhNmF2LrYsdioKhQNtbB9EBXf6BH4HYAnaxUlo99n_zAAGgZhZ2VuY2UiFmFnZW5jZSBkZSB2b3lhZ2UgbWFyb2MqF9mI2YPYp9mE2Kkg2LPZitin2K3Zitip&lci=20';


$html = file_get_contents($url);

$crawler = new Crawler($html);

$html = file_get_contents($url);

$crawler = new Crawler($html);

$titres = [...$titres,...$crawler->filter($titre)->each(function($node){
    return $node->text();
})];



// for($i = 1;$i<= 10;$i++){
//     $url = 'https://www.google.com/localservices/prolist?g2lbs=AOHF13kL-YgLoD9ow9TCjxRrPP69xDvApiyv3-rOQfvURcRNy-vxoh61vcsDF9SR6IZSnK8S2Aqa&hl=ar-MA&gl=ma&cs=1&ssta=1&q=agence%20de%20voyage%20maroc&oq=agence%20de%20voyage%20maroc&slp=MgBSAggCYACSAasCCgwvZy8xMmhsNTB2d20KDS9nLzExYjZoX3pxZHYKDS9nLzExczFibHdfMmIKDS9nLzExY3J6anJnMWYKDS9nLzExYjZqZ3o3aGIKDS9nLzExaDBicjdiZnQKDS9nLzExanJfa21jYzUKDS9nLzExZnNxNnNxbmIKDS9nLzExY203Y3h2bjEKDS9nLzExZzZ6ZzJmd2cKDS9nLzExYjZqZ3FrXzUKDS9nLzExYzBxeTV6ZjUKDS9nLzExYzVfeGZyNGQKDS9nLzExYnR4Y2dqMGgKDS9nLzExYjZqMmQwMjEKDS9nLzExZzJ2XzZsc3YKDS9nLzExZHhqdzh3YjUKDS9nLzExYnRtMGN6cHYKDS9nLzExYjZqODJoYmIKDS9nLzExZm02Nmg3MmKaAQYKAhcZEAA%3D&src=2&serdesk=1&sa=X&ved=2ahUKEwiWmKmz75-KAxWXcKQEHca6DvoQjGp6BAghEAE&scp=ChJnY2lkOnRyYXZlbF9hZ2VuY3kSOhISCY3FUZZhiAsNEcP_LMSBk9PZIgzYp9mE2YXYutix2KgqFA21sH0QFd_oEfgdgCdrFSWj32f_MAAaBmFnZW5jZSIWYWdlbmNlIGRlIHZveWFnZSBtYXJvYyoV2YXZg9iq2Kgg2LPZgdix2YrYp9iq&lci=0';



// $html = file_get_contents($url);

// $crawler = new Crawler($html);

// $titres = [...$titres,...$crawler->filter($titre)->each(function($node){
//     return $node->text();
// })];
// }
// $nouveau = [];
// foreach($titres as $title){
//     for($i = 1;$i<= count($titres);$i++){
//         if($title !== $titres[$i]){
//             $nouveau[$i] = $title;
//         }
//     }
// }
// $telephones = [
//     ...$telephones,
//     ...$crawler->filter($telephone)->each(function($node){
//         return $node->text();
//     })
// ];

print_r($titres);


// foreach($urls as $url){
//     $html = file_get_contents($url);

//     $crawler = new Crawler($html);

//     $titres = [...$titres,...$crawler->filter($titre)->each(function($node){
//         return $node->text();
//     })];
    

//     $telephones = [...$telephones,...$crawler->filter($telephone)->each(function($node){
//         return $node->text();
//     })];
// }



// header('Content-Type: text/csv');
// header('Content-Disposition: attachment; filename="data.csv');
// header('Pragma: no-cache');
// header('Expires: 0');

// $output = fopen('php://output', 'w');
// fputcsv($output, ['Title','Telephone'],";");

// for($i=0;$i<count($titres);$i++){
//     fputcsv($output, [ $titres[$i], $telephones[$i]],";");
// }

// fclose($output);
// exit;
