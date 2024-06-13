<?php

namespace gift\api\app\actions;

use gift\api\core\services\catalogue\CatalogueService;
use gift\api\core\services\catalogue\CatalogueServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetCategoriesAction extends Action
{
    // Propriété pour le service de gestion des catégories
    private CatalogueServiceInterface $categoryService;

    // Constructeur initialisant le service de gestion des catégories
    public function __construct()
    {
        $this->categoryService = new CatalogueService();
    }

    // Méthode invoquée lorsque l'action est appelée
    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        // Récupération des données des catégories à partir du service
        $categoriesData = $this->categoryService->getCategories();

        // Formatage des données des catégories pour l'inclusion dans la réponse
        $categoriesFormatted = [];
        foreach ($categoriesData as $category) {
            $categoriesFormatted[] = [
                'categorie' => [
                    'id' => $category['id'],
                    'libelle' => $category['libelle'],
                    'description' => $category['description']
                ],
                'links' => [
                    'self' => ['href' => '/categories/' . $category['id'] . '/']
                ]
            ];
        }

        // Création du contenu de la réponse
        $responseContent = [
            'type' => 'collection',
            'count' => count($categoriesFormatted),
            'categories' => $categoriesFormatted
        ];

        // Encodage du contenu de la réponse en JSON
        $responseJson = json_encode($responseContent);
        $rs->getBody()->write($responseJson);

        // Retourne la réponse avec l'en-tête Content-Type JSON
        return $rs->withHeader('Content-Type', 'application/json');
    }
}
