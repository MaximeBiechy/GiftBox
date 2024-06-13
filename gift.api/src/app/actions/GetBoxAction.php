<?php

namespace gift\api\app\actions;

use gift\api\core\services\box\BoxService;
use gift\api\core\services\box\BoxServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetBoxAction extends Action
{
    // Propriété pour le service de gestion des boxes
    private BoxServiceInterface $boxService;

    // Constructeur initialisant le service de gestion des boxes
    public function __construct()
    {
        $this->boxService = new BoxService();
    }

    // Méthode invoquée lorsque l'action est appelée
    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        // Récupération de l'ID de la box depuis les arguments de la requête
        $boxId = $args['id'];

        // Récupération des détails de la box et des prestations associées à partir du service
        $box = $this->boxService->getBoxById($boxId);
        $prestations = $this->boxService->getPrestationsFromBox($boxId);

        // Formatage des prestations pour l'inclusion dans la réponse
        $formattedPrestations = array_map(function ($prestation) {
            return [
                'libelle' => $prestation['libelle'],
                'description' => $prestation['description'],
                'contenu' => [
                    'box_id' => $prestation['pivot']['box_id'],
                    'presta_id' => $prestation['pivot']['presta_id'],
                    'quantite' => $prestation['pivot']['quantite'],
                ]
            ];
        }, $prestations);

        // Formatage de la box pour l'inclusion dans la réponse
        $formattedBox = [
            'type' => 'resource',
            'box' => [
                'id' => $box['id'],
                'libelle' => $box['libelle'],
                'description' => $box['description'],
                'message_kdo' => $box['message_kdo'],
                'statut' => $box['statut'],
                'prestations' => $formattedPrestations
            ]
        ];

        // Écriture de la réponse JSON
        $rs->getBody()->write(json_encode($formattedBox));

        // Retourne la réponse avec l'en-tête Content-Type JSON
        return $rs->withHeader('Content-Type', 'application/json');
    }
}
