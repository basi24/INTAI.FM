<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('include.php');

require  'vendor/autoload.php';

$text_to_cat = "mi piacerebbe vendere all'estero attraverso piattaforma e-commerce";

use Niiknow\Bayes;
$classifier_master = new Bayes();

$conn = mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die ("Impossibile trovare host di destinazione. Contattare l'assistenza tecnica.");

//prendo l'ultimo aggiornato
$rec_class = sql2val("SELECT * FROM intai_bayes_models WHERE stato='1' ORDER BY data DESC LIMIT 1");

echo "ID model: ";
echo "$rec_class[ID] <br><br>";

echo "txt: ";
echo "$text_to_cat <br><br>";

mysqli_close($conn);

$stateJson = $rec_class['train_json'];

$classifier_master->fromJson($stateJson);

$result = $classifier_master->categorize("$text_to_cat");

$probs = $classifier_master->probabilities("$text_to_cat");

$true_probs = $classifier_master->true_probabilities("$text_to_cat");

$sum_prob = 0;
foreach($true_probs as $key => $value)
{
    $sum_prob += $value;
}

echo "ris: ";
echo "$result <br><br>";


echo "true_probs: <pre>";
print_r($true_probs);
echo "</pre> <br><br>";

echo "Sum true probs: $sum_prob <br><br>";

echo "probs: <pre>";
print_r($probs);
echo "</pre> <br><br>";


// => 'positive'



?>