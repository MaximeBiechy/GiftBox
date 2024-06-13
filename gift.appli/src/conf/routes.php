<?php
declare(strict_types=1);

use gift\appli\app\actions\GetBoxAction;
use gift\appli\app\actions\GetBoxPredefinisAction;
use gift\appli\app\actions\GetCategoryAction;
use gift\appli\app\actions\GetCategoryActionById;
use gift\appli\app\actions\GetHomeAction;
use gift\appli\app\actions\GetConnexionAction;
use gift\appli\app\actions\GetCreateBox;
use gift\appli\app\actions\GetCreateCategorie;
use gift\appli\app\actions\GetDetailBoxAction;
use gift\appli\app\actions\GetDetailBoxPredefinieAction;
use gift\appli\app\actions\GetInscriptionAction;
use gift\appli\app\actions\GetLogoutAction;
use gift\appli\app\actions\GetPrestationByACategory;
use gift\appli\app\actions\GetPrestationByIdAction;
use gift\appli\app\actions\GetPrestationsAction;
use gift\appli\app\actions\PostAddPrestationToBoxAction;
use gift\appli\app\actions\PostConnexionAction;
use gift\appli\app\actions\PostCreateBoxAction;
use gift\appli\app\actions\PostCreateCategorieAction;
use gift\appli\app\actions\PostDefineCurrentBoxAction;
use gift\appli\app\actions\PostDeletePrestationFromBoxAction;
use gift\appli\app\actions\PostInscriptionAction;

return function (\Slim\App $app): \Slim\App {

    // Page d'accueil
    $app->get('/',
        GetHomeAction::class
        )->setName('/');

    // 1) Affiche toutes les prestations
    $app->get('/prestations[/]',
        GetPrestationsAction::class
        )->setName('prestations');

    // 2) Affiche les détails d'une prestation en fonction de son id
    $app->get('/prestation[/]',
        GetPrestationByIdAction::class
        )->setName('prestation');
    
    // 3) Affiche la liste des prestations d'une catégorie
    $app->get(
        '/prestationDeLaCategorie[/]',
        GetPrestationByACategory::class
        )->setName('prestationDeLaCategorie');

    // 4) Affiche toutes les catégories
    $app->get(
        '/categories[/]',
        GetCategoryAction::class
        )->setName('categories');

    // 6) Formulaire de création d'un coffret
    $app->get('/box/create[/]',
        GetCreateBox::class
        )->setName('/box/create');
        
    // 7) Ajoute une prestation à un coffret
    $app->post('/box/addPrestation[/]', 
        PostAddPrestationToBoxAction::class
        )->setName('/box/addPrestation');

    // 11) Suppression de prestations dans un coffret
    $app->post('/deletePrestationFromBox[/]', 
        PostDeletePrestationFromBoxAction::class
        )->setName('/deletePrestationFromBox');
    
    // 14) Affiche les détails d'une box
    $app->get('/detailBox[/]',
        GetDetailBoxAction::class
        )->setName('/detailBox');

    $app->get('/detailBoxPredefinie[/]',
        GetDetailBoxPredefinieAction::class
        )->setName('/detailBoxPredefinie');

    // 15) Affiche la page de connexion 
    $app->get('/connexion[/]',
        GetConnexionAction::class
        )->setName('connexion');
        
    // 15) Connexion de l'utilisateur
    $app->post('/connexion[/]',
        PostConnexionAction::class
        )->setName('connexion');

    // 16) Affiche la page d'inscription
    $app->get('/inscription[/]', 
        GetInscriptionAction::class)
        ->setName('inscription');
        
    // 16) Inscription de l'utilisateur
    $app->post('/inscription[/]',
        PostInscriptionAction::class
        )->setName('inscription');
        
    // 17) Affiche toutes les box créées par l'utilisateur
    $app->get('/box[/]',
        GetBoxAction::class
        )->setName('/box');

    // 18) Afficher les box prédéfinis
    $app->get('/box_predefinies[/]',
        GetBoxPredefinisAction::class
        )->setName('box_predefinies');

    // Affiche une catégorie en fonction de son id
    $app->get('/categorie/{id}[/]',
        GetCategoryActionById::class
        )->setName('categorie');
        
    // Affiche la box créée par l'utilisateur depuis le formulaire
    $app->post('/box/create[/]',
        PostCreateBoxAction::class
        )->setName('/box/created');
    
    // Affiche la page de création d'une catégorie
    $app->get('/categories/create[/]',
        GetCreateCategorie::class)
        ->setName('/categories/create');
        
    // Définir le coffret courant
    $app->post('/defineCurrentBox[/]', 
        PostDefineCurrentBoxAction::class
        )->setName('/defineCurrentBox');

    // Création d'une catégorie
    $app->post('/categories/create[/]',
        PostCreateCategorieAction::class
        )->setName('/categories/created');

    // Déconnexion de l'utilisateur
    $app->get('/logout[/]', 
        GetLogoutAction::class
        )->setName('logout');

    return $app;
};
