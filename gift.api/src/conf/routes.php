<?php
declare(strict_types=1);


use gift\api\app\actions\GetBoxAction;
use gift\api\app\actions\GetCategoriesAction;
use gift\api\app\actions\GetPrestationsAction;
use gift\api\app\actions\GetPrestationsByCategorieAction;

return function(\Slim\App $app): \Slim\App {

    $app->get('/api/prestations[/]', GetPrestationsAction::class)->setName('prestations');

    $app->get('/api/categories[/]', GetCategoriesAction::class)->setName('categories');

    $app->get('/api/boxes/{id}[/]', GetBoxAction::class)->setName('box');

    $app->get('/api/categories/{id}[/]', GetPrestationsByCategorieAction::class)->setName('prestations_by_category');

    return $app;

};
