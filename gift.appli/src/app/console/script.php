<?php 
declare(strict_types=1);

require_once '../../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as DB;
use gift\appli\models\Prestation;
use gift\appli\models\Box;
use gift\appli\models\Categorie;
use Illuminate\Support\Str;

// Initialisation de la connexion avec la base de données
$db = new DB();
$db->addConnection(parse_ini_file('../../conf/gift.db.conf.ini.dist'));  
$db->setAsGlobal();
$db->bootEloquent();

// 
// EXERCICE 2
// 
// 1. lister les prestations ; pour chaque prestation, afficher le libellé, la description, 
// le tarif et l'unité
$prestations = Prestation::all();
foreach ($prestations as $prestation) {
    echo $prestation->libelle . ' ' . $prestation->description . ' ' . $prestation->tarif . ' ' . $prestation->unite . "<br>";
}

// 2. idem, mais en affichant de plus la catégorie de la prestation. On utilisera un
// chargement lié (eager loading).
$prestations = Prestation::with('categorie')->get();
foreach ($prestations as $prestation) {
    echo "Libellé: {$prestation->libelle}, Description: {$prestation->description}, Tarif: {$prestation->tarif}, Unité: {$prestation->unite}, Catégorie: {$prestation->categorie->libelle}\n";
}

// 3. afficher la catégorie 3 (libellé) et la liste des prestations (libellé, tarif, unité) de cette
// catégorie.
$categorie = Categorie::with('prestations')->find('3');
if ($categorie) {
    echo "Catégorie: {$categorie->libelle}\n";
    foreach ($categorie->prestations as $prestation) {
        echo "Libellé: {$prestation->libelle}, Tarif: {$prestation->tarif}, Unité: {$prestation->unite}<br>";
    }
} else {
    echo "Catégorie non trouvée.<br>";
}

// 4. afficher la box d'ID 360bb4cc-e092-3f00-9eae-774053730cb2 : libellé, description,
// montant.
$box = Box::find('360bb4cc-e092-3f00-9eae-774053730cb2');
if ($box) {
    echo "Libellé: {$box->libelle}, Description: {$box->description}, Montant: {$box->montant}<br>";
} else {
    echo "Box non trouvée.<br>";
}

// 5. idem, en affichant en plus les prestations prévues dans la box (libellé, tarif, unité,
// quantité).
$box = Box::with('prestations')->find('360bb4cc-e092-3f00-9eae-774053730cb2');
if ($box) {
    echo "Libellé: {$box->libelle}, Description: {$box->description}, Montant: {$box->montant}\n";
    foreach ($box->prestations as $prestation) {
        echo "Libellé: {$prestation->libelle}, Tarif: {$prestation->tarif}, Unité: {$prestation->unite}, Quantité: {$prestation->pivot->quantite}<br>";
    }
} else {
    echo "Box non trouvée.<br>";
}

// 6. Créer une box et lui ajouter 3 prestations. L’identifiant de la box est un UUID.
// Consulter la documentation Eloquent pour la génération de cet identifiant.
$box = Box::create([
    'id' => Str::uuid(),
    'libelle' => 'Nouvelle Box',
    'description' => 'Description de la nouvelle box',
    'montant' => 90.00
]);

$prestations = Prestation::take(3)->get();
foreach ($prestations as $prestation) {
    $box->prestations()->attach($prestation->id, ['quantite' => 1]);
}

echo "Box créée avec succès avec 3 prestations.<br>";
