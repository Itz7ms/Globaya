<?php
// === CONFIGURATION ===
$webhook_url = 'https://discord.com/api/webhooks/1437250013586788425/_d8T4G9QwiPpciNvkj_hPgwOcyAxXRe4o9DRc-cWF1r4ZXlM6d4e3ur_5BfqWu8EISaN'; // Mets l’URL de ton webhook Discord ici
// =====================

// Récupération de l’IP visiteur
$ip = $_SERVER['REMOTE_ADDR'];

// Récupération de la date et page visitée
$page = $_SERVER['REQUEST_URI'];
$date = date('d/m/Y H:i:s');

// Optionnel : géolocalisation via une base ou une autre API côté serveur

$data = [
    "embeds" => [
        [
            "title" => "Nouvelle visite détectée !",
            "color" => 5814783,
            "fields" => [
                ["name" => "IP", "value" => $ip, "inline" => true],
                ["name" => "Page visitée", "value" => $page, "inline" => false],
                ["name" => "Heure", "value" => $date, "inline" => true]
            ],
            "footer" => ["text" => "IP Tracker - Grok Security"],
            "timestamp" => date('c')
        ]
    ]
];

// Envoi POST vers Discord
$options = [
    'http' => [
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data),
    ]
];
$context  = stream_context_create($options);
file_get_contents($webhook_url, false, $context);
?>
