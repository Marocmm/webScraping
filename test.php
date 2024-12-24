<?php
// Inclure la bibliothèque cURL pour effectuer des requêtes HTTP
function fetchData($url) {
    $ch = curl_init();

    // Configurer les options cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    // Exécuter la requête et récupérer la réponse
    $response = curl_exec($ch);

    // Vérifier les erreurs
    if (curl_errno($ch)) {
        echo "cURL Error: " . curl_error($ch);
        curl_close($ch);
        return null;
    }

    curl_close($ch);
    return $response;
}

// URL à scraper
$url = "https://www.google.com/localservices/prolist?g2lbs=AOHF13kL-YgLoD9ow9TCjxRrPP69xDvApiyv3-rOQfvURcRNy-vxoh61vcsDF9SR6IZSnK8S2Aqa&hl=ar-MA&gl=ma&cs=1&ssta=1&q=agence%20de%20voyage%20maroc&oq=agence%20de%20voyage%20maroc&slp=MgBSAggCYACSAasCCgwvZy8xMmhsNTB2d20KDS9nLzExYjZoX3pxZHYKDS9nLzExczFibHdfMmIKDS9nLzExY3J6anJnMWYKDS9nLzExYjZqZ3o3aGIKDS9nLzExaDBicjdiZnQKDS9nLzExanJfa21jYzUKDS9nLzExZnNxNnNxbmIKDS9nLzExY203Y3h2bjEKDS9nLzExZzZ6ZzJmd2cKDS9nLzExYjZqZ3FrXzUKDS9nLzExYzBxeTV6ZjUKDS9nLzExYzVfeGZyNGQKDS9nLzExYnR4Y2dqMGgKDS9nLzExYjZqMmQwMjEKDS9nLzExZzJ2XzZsc3YKDS9nLzExZHhqdzh3YjUKDS9nLzExYnRtMGN6cHYKDS9nLzExYjZqODJoYmIKDS9nLzExZm02Nmg3MmKaAQYKAhcZEAA%3D&src=2&serdesk=1&sa=X&ved=2ahUKEwiWmKmz75-KAxWXcKQEHca6DvoQjGp6BAghEAE&scp=ChJnY2lkOnRyYXZlbF9hZ2VuY3kSOhISCY3FUZZhiAsNEcP_LMSBk9PZIgzYp9mE2YXYutix2KgqFA21sH0QFd_oEfgdgCdrFSWj32f_MAAaBmFnZW5jZSIWYWdlbmNlIGRlIHZveWFnZSBtYXJvYyoV2YXZg9iq2Kgg2LPZgdix2YrYp9iq&lci=20";

// Récupérer les données de l'URL
$response = fetchData($url);

if ($response) {
    // Analyser les données récupérées
    $dom = new DOMDocument();

    // Supprimer les erreurs dues à des balises HTML mal formées
    libxml_use_internal_errors(true);

    $dom->loadHTML($response);
    libxml_clear_errors();

    // Extraire les informations nécessaires (titre et téléphone)
    $xpath = new DOMXPath($dom);

    // Sélectionner les titres
    $titres = $xpath->query("//div[contains(@class, 'I9iumb')]//div[contains(@class, 'rgnuSb')]");

    // Sélectionner les téléphones
    $telephones = $xpath->query("//div[contains(@class, 'I9iumb')]/div[3]//span[contains(@class, 'hGz87c')]/span[last()]");

    if ($titres && $titres->length > 0) {
        foreach ($titres as $index => $titre) {
            $telephone = $telephones->item($index);
            echo "Titre: " . trim($titre->nodeValue) . "\n";
            if ($telephone) {
                echo "Téléphone: " . trim($telephone->nodeValue) . "\n";
            } else {
                echo "Téléphone: Non disponible\n";
            }
            echo "---------------------\n";
        }
    } else {
        echo "Aucune donnée trouvée.\n";
    }
} else {
    echo "Impossible de récupérer les données.\n";
}
?>
