<?php

namespace gift\api\app\actions;

use gift\api\core\services\catalogue\CatalogueService;
use gift\api\core\services\catalogue\CatalogueServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetPrestationsByCategorieAction extends Action
{
    // Propriété pour le service de gestion du catalogue
    private CatalogueServiceInterface $categoryService;

    // Constructeur initialisant le service de gestion du catalogue
    public function __construct()
    {
        $this->categoryService = new CatalogueService();
    }

    // Méthode invoquée lorsque l'action est appelée
    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        // Récupération de l'ID de la catégorie à partir des arguments de la requête
        $categoryId = $args['id'];

        // Récupération des détails de la catégorie et des prestations associées à partir du service
        $categorie = $this->categoryService->getCategorieById($categoryId);
        $prestationsData = $this->categoryService->getPrestationsByCategorie($categoryId);

        // Formatage des données des prestations pour l'inclusion dans la réponse
        $formattedPrestations = array_map(function ($prestation) {
            return [
                'libelle' => $prestation['libelle'],
                'description' => $prestation['description'],
                'tarif' => $prestation['tarif'],
                'img' => $prestation['img'],
                'unite' => $prestation['unite'],
            ];
        }, $prestationsData);

        // Création du contenu de la réponse
        $formattedResponse = [
            'type' => 'resource',
            'name' => $categorie['libelle'],
            'count' => count($formattedPrestations),
            'prestations' => $formattedPrestations
        ];

        // Encodage du contenu de la réponse en JSON
        $rs->getBody()->write(json_encode($formattedResponse));

        // Retourne la réponse avec l'en-tête Content-Type JSON
        return $rs->withHeader('Content-Type', 'application/json');
    }
}
