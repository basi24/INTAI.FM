<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('include.php');

require 'vendor/autoload.php';

use Niiknow\Bayes;
$classifier_master = new Bayes();

// TRAIN
$classifier_master->learn('siti web responsive, ottimizzazione SEO, gestione dominio, sito', 'siti-web');
$classifier_master->learn('piattaforme vendita online, gestione catalogo prodotti, carrello elettronico', 'e-commerce');
$classifier_master->learn('gestione profili social, pianificazione post, engagement audience', 'smm');
$classifier_master->learn('lancio campagne pubblicitarie, target mercato, budget advertising', 'campagne');
$classifier_master->learn('software su misura aziende, sviluppo app personalizzate, sistemi gestionali ERP', 'software');
$classifier_master->learn('strategie marketing digitale, consulenze SEO/SEM, analisi mercato', 'mkt');
$classifier_master->learn('servizi fotografici advertising, video promozionali, editing professionale', 'shooting');
$classifier_master->learn('corsi formazione digital marketing, workshop,', 'formazione');
$classifier_master->learn('applicazione AI segmentazione cliente, personalizzazione offerte, previsione vendite', 'ai-mkt');
$classifier_master->learn('sviluppo algoritmi machine learning personalizzati, soluzioni intelligenza artificiale ottimizzazione processi', 'ai-algoritmi');


$classifier_master->learn('migliorare visibilità online, hosting, dominio, velocità caricamento sito', 'siti-web');
$classifier_master->learn('conversioni negozio online, logistica dell’e-commerce, gateway pagamento', 'e-commerce');
$classifier_master->learn('aumentare follower, Tiktok, tiktok, tik tok, instagram, Instagram, programmazione post, facebook, Facebook, social media', 'smm');
$classifier_master->learn('ROI campagne AdWords, sponsorizzare, tendenze pubblicitarie, campagne social, estero', 'campagne');
$classifier_master->learn('integrare sistema prenotazione software aziendale, sviluppo app mobile, automazione processi aziendali software personalizzato', 'software');
$classifier_master->learn('inbound marketing, strategia content marketing', 'mkt');
$classifier_master->learn('shooting fotografico, creazione contenuti visivi, video making', 'shooting');
$classifier_master->learn('corsi avanzati, Google Analytics, formazione certificata, digitale, masterclass, seminari, seminario', 'formazione');
$classifier_master->learn('chatbot intelligenti, utilizzo dell’AI, sentiment, personalizzazione esperienza utente con AI', 'ai-mkt');
$classifier_master->learn('algoritmi predittivi analisi vendite, analisi predittiva, sviluppo sistemi raccomandazione personalizzati, implementazione soluzioni AI automatizzare', 'ai-algoritmi');


$classifier_master->learn('web design, UX/UI, SEO, responsive, CMS, WordPress, landing page, velocità sito, sito web', 'siti-web');
$classifier_master->learn('shopify, magento, woocommerce, carrello, checkout, gateway pagamento, SKU, tracking ordini, e-commerce, e commerce, ecommerce, vendere online', 'e-commerce');
$classifier_master->learn('facebook, instagram, twitter, linkedin, post, stories, engagement, hashtag, follower, social, gestione social', 'smm');
$classifier_master->learn('google ads, facebook ads, CPC, CPM, targeting, retargeting, banner, influencer, viral, vendere online, pubblicità sul web, pubblicità online', 'campagne');
$classifier_master->learn('app, ERP, CRM, API, custom development, software engineering, database, cloud, configuratore prodotto, gestionale', 'software');
$classifier_master->learn('digital marketing, content marketing, inbound, SEO, SEM, analytics, KPI, funnel, lead generation, email marketing, marketing tradizionale, fiere, strategie', 'mkt');
$classifier_master->learn('shooting, fotografia, video, editing, post-produzione, ADV, storyboard, casting, styling', 'shooting');
$classifier_master->learn('e-learning, webinar, SEO course, digital literacy, coding, UX design, analytics, certification', 'formazione');
$classifier_master->learn('chatbot, NLP, machine learning, predictive analytics, customer segmentation, AI tools, big data, intelligenza artificiale nel marketing', 'ai-mkt');
$classifier_master->learn('algorithm development, neural networks, computer vision, natural language processing, AI research, TensorFlow, PyTorch, software intelligenza artificiale', 'ai-algoritmi');


$stateJson = $classifier_master->toJson();


$conn = mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die ("Impossibile trovare host destinazione. Contattare l'assistenza tecnica.");


do_query("INSERT INTO intai_bayes_models (train_json, stato) VALUES ('$stateJson', '1')");


mysqli_close($conn);

echo "DONE";




// now ask it to categorize a document it has never seen before

//$classifier_master->categorize('awesome, cool, amazing!! Yay.');
// => 'positive'

// serialize the classifier's state as a JSON string.




// load the classifier back from its JSON representation.

//$classifier_master->fromJson($stateJson);


?>