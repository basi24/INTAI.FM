<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include_once('include.php');

require 'vendor/autoload.php';

use Niiknow\Bayes;
$classifier_master = new Bayes();

// TRAIN
$classifier_master->learn('siti web responsive, gestione dominio, sito, immagine, vetrina, one page, funnel, presenza', 'siti-web'); 
$classifier_master->learn('piattaforme vendita online, gestione catalogo prodotti, carrello elettronico', 'e-commerce'); 
$classifier_master->learn('gestione profili social, pianificazione post, engagement audience', 'smm'); 
$classifier_master->learn('lancio campagne pubblicitarie, target mercato, budget advertising', 'campagne'); 
$classifier_master->learn('software misura aziende, sviluppo app personalizzate, sistemi gestionali ERP', 'software'); 
$classifier_master->learn('strategie marketing digitale, consulenze, analisi mercato', 'mkt'); 
$classifier_master->learn('servizi fotografici advertising, video promozionali, editing professionale', 'shooting'); 
$classifier_master->learn('corsi formazione digital marketing, workshop,', 'formazione'); 
$classifier_master->learn('applicazione AI segmentazione cliente, personalizzazione offerte, previsione vendite', 'ai-mkt'); 
$classifier_master->learn('machine learning, soluzioni intelligenza artificiale ottimizzazione processi', 'ai-algoritmi');


$classifier_master->learn('migliorare visibilità online, hosting, dominio, velocità caricamento sito', 'siti-web'); 
$classifier_master->learn('conversioni negozio online, logistica e-commerce, gateway pagamento, ricerca, acquisti', 'e-commerce'); 
$classifier_master->learn('aumentare follower, Tiktok, tiktok, tik tok, instagram, Instagram, programmazione post, facebook, Facebook, social media', 'smm'); 
$classifier_master->learn('ROI campagne AdWords, sponsorizzare, tendenze pubblicitarie, campagna social, estero', 'campagne'); 
$classifier_master->learn('integrare sistema prenotazione software aziendale, sviluppo app mobile, automazione processi aziendali software personalizzato', 'software'); 
$classifier_master->learn('inbound marketing, strategia content marketing, brochure, catalogo, prodotto, offerta', 'mkt'); 
$classifier_master->learn('shooting fotografico, creazione contenuti visivi, video making, spot, TV, live, set, still life, foto', 'shooting'); 
$classifier_master->learn('corsi avanzati, excel, office, formazione certificata, digitale, masterclass, seminari, seminario, staff, dipendenti, venditori, competenze, sicurezza', 'formazione'); 
$classifier_master->learn('chatbot intelligenti, utilizzo dell’AI, sentiment, personalizzazione esperienza utente AI', 'ai-mkt'); 
$classifier_master->learn('algoritmi predittivi, analisi predittiva, sviluppo sistemi raccomandazione, implementazione soluzioni AI automatizzare', 'ai-algoritmi');


$classifier_master->learn('web design, UX/UI, SEO, responsive, CMS, WordPress, landing page, velocità, mobile, sito web', 'siti-web'); 
$classifier_master->learn('shopify, magento, woocommerce, carrello, checkout, gateway pagamento, SKU, tracking ordini, e-commerce, commerce, ecommerce, vendere online', 'e-commerce'); 
$classifier_master->learn('facebook, instagram, twitter, linkedin, post, stories, engagement, hashtag, follower, social, gestione social', 'smm'); 
$classifier_master->learn('google ads, facebook ads, CPC, CPM, targeting, retargeting, banner, influencer, viral, vendere online, pubblicità web, pubblicità online', 'campagne'); 
$classifier_master->learn('app, ERP, CRM, API, custom development, engineering, database, cloud, configuratore, gestionale', 'software'); 
$classifier_master->learn('digital marketing, content marketing, inbound, SEO, SEM, analytics, KPI, funnel, lead generation, email marketing, marketing tradizionale, fiere, strategie', 'mkt'); 
$classifier_master->learn('shooting, fotografia, video, editing, post-produzione, ADV, storyboard, casting, styling, riprese, montaggio, fotomontaggio', 'shooting'); 
$classifier_master->learn('e-learning, webinar, course, training, corso, coding, analytics, certification, rete agenti, stile, presentazioni, insegnare', 'formazione'); 
$classifier_master->learn('chatbot, NLP, machine learning, predictive analytics, customer segmentation, AI tools, big data, intelligenza artificiale marketing', 'ai-mkt'); 
$classifier_master->learn('algorithm development, neural networks, computer vision, natural language processing, AI artificial intelligence, software intelligenza artificiale', 'ai-algoritmi'); 

//33 termini per classe

$stateJson = $classifier_master->toJson();


$conn = mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die ("Impossibile trovare host destinazione. Contattare l'assistenza tecnica.");


do_query("INSERT INTO intai_bayes_models (train_json, stato) VALUES ('$stateJson', '1')");


mysqli_close($conn);

//echo "DONE";



//Test Set
$test_set = [
    ["Vorrei un sito web veloce e ottimizzato per i motori di ricerca.","siti-web"],
    ["Sto cercando di migliorare l'esperienza di acquisto sul mio sito e-commerce.","e-commerce"],
    ["Ho bisogno di aumentare l'engagement sui miei canali social.","smm"],
    ["Desidero una campagna pubblicitaria che targetizzi specificamente i giovani adulti.","campagne"],
    ["Cerco una soluzione software per la gestione dei miei clienti.","software"],
    ["Voglio sviluppare una nuova strategia di content marketing.","mkt"],
    ["Ho bisogno di un shooting fotografico per un evento invernale.","shooting"],
    ["Sono interessato a corsi di formazione su pacchetto Office.","formazione"],
    ["Voglio implementare l'AI per analizzare i comportamenti dei clienti.","ai-mkt"],
    ["Cerco esperti per sviluppare algoritmi di machine learning per il mio business.","ai-algoritmi"]
]; 

//Validation Set
$validation_set = [
    ["Mi serve un nuovo sito che sia responsive e adatto ai dispositivi mobile.","siti-web"],
    ["Come posso ottimizzare la gestione del catalogo prodotti sul mio e-commerce?","e-commerce"],
    ["Cerco strategie per migliorare la visibilità del mio brand sui social media.","smm"],
    ["Qual è il miglior modo per gestire il budget di una campagna pubblicitaria online?","campagne"],
    ["Sono alla ricerca di un ERP personalizzato per il mio settore industriale.","software"],
    ["Quali sono le ultime tendenze nel digital marketing per incrementare le vendite?", "mkt"],
    ["Mi servono delle riprese video per uno shooting di moda.","shooting"],
    ["Desidero ampliare le competenze digitali del mio team attraverso seminari specifici.","formazione"],
    ["Quali strumenti di AI posso utilizzare per personalizzare le offerte ai miei clienti?","ai-mkt"],
    ["Ho bisogno di consulenza per integrare l'intelligenza artificiale nel mio processo decisionale aziendale.","ai-algoritmi"]
];

$test_true_positives = 0;
$test_false_positives = 0;

echo "TEST SET ";
echo " <br><br>";


foreach($test_set as $test){

    $text_to_cat = $test[0];
    $test_result = $classifier_master->categorize("$text_to_cat");
    $test_true_probs = $classifier_master->true_probabilities("$text_to_cat");

    if($test[1] == $test_result){
        $test_true_positives++;
        $test_esit = "TRUE POSITIVE";
    }
    else
    {
        $test_false_positives++;
        $test_esit = "FALSE POSITIVE";
    }

    echo "Text: $text_to_cat | Result: $test_result - Esit: <b>$test_esit</b> <br>  Probability: <pre>";
    print_r($test_true_probs);
    echo "</pre><br><br>";

}

echo "<br><br>";
echo "TEST TRUE POSITIVES: $test_true_positives <br>";
echo "TEST FALSE POSITIVES: $test_false_positives <br>";
echo "<br><br>";





$validation_true_positives = 0;
$validation_false_positives = 0;

echo "VALIDATION SET ";
echo " <br><br>";


foreach($validation_set as $validation){

    $text_to_cat = $validation[0];
    $validation_result = $classifier_master->categorize("$text_to_cat");
    $validation_true_probs = $classifier_master->true_probabilities("$text_to_cat");

    if($validation[1] == $validation_result){
        $validation_true_positives++;
        $validation_esit = "TRUE POSITIVE";
    }
    else
    {
        $validation_false_positives++;
        $validation_esit = "FALSE POSITIVE";
    }

    echo "Text: $text_to_cat | Result: $validation_result - Esit: <b>$validation_esit</b> <br>  Probability: <pre>";
    print_r($validation_true_probs);
    echo "</pre><br><br>";

}

echo "<br><br>";
echo "VALIDATION TRUE POSITIVES: $validation_true_positives <br>";
echo "VALIDATION FALSE POSITIVES: $validation_false_positives <br>";
echo "<br><br>";




// now ask it to categorize a document it has never seen before

//$classifier_master->categorize('awesome, cool, amazing!! Yay.');
// => 'positive'

// serialize the classifier's state as a JSON string.




// load the classifier back from its JSON representation.

//$classifier_master->fromJson($stateJson);


?>