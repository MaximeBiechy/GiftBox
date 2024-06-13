<?php

namespace gift\api\app\actions;

use gift\api\core\services\catalogue\CatalogueService;
use gift\api\core\services\catalogue\CatalogueServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetPrestationsAction extends Action
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
        // Récupération des données des prestations à partir du service
        $prestationsData = $this->categoryService->getPrestations();

        // Formatage des données des prestations pour l'inclusion dans la réponse
        $formattedPrestations = [
            'type' => 'collection',
            'count' => count($prestationsData),
            'prestations' => []
        ];

        foreach ($prestationsData as $prestation) {
            $formattedPrestations['prestations'][] = [
                'prestation' => [
                    'id' => $prestation['id'],
                    'libelle' => $prestation['libelle'],
                    'description' => $prestation['description'],
                    'unite' => $prestation['unite'],
                    'tarif' => $prestation['tarif'],
                ],
                'links' => [
                    'self' => [
                        'href' => '/prestation?id=' . $prestation['id']
                    ],
                    'categorie' => [
                        'href' => '/categorie/' . $prestation['categorie']['id']
                    ]
                ]
            ];
        }

        // Encodage du contenu de la réponse en JSON
        $responseJson = json_encode($formattedPrestations);
        $rs->getBody()->write($responseJson);

        // Retourne la réponse avec l'en-tête Content-Type JSON
        return $rs->withHeader('Content-Type', 'application/json');
    }
}
