<?php
declare(strict_types=1);

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\core\services\box\BoxService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class PostCreateBoxAction extends AbstractAction
{
    private BoxService $boxService;

    public function __construct()
    {
        $this->boxService = new BoxService();
    }

    function __invoke(Request $rq, Response $rs, $args): Response
    {
        try {
            $body = $rq->getParsedBody();

            if ($body['libelle'] !== filter_var($body['libelle'], FILTER_SANITIZE_SPECIAL_CHARS) || $body['description'] !== filter_var($body['description'], FILTER_SANITIZE_SPECIAL_CHARS)) {
                throw new \Exception('Erreur de saisie');
            }
            $libelle = $body['libelle'];
            $description = $body['description'];
            $cadeau = isset($body['cadeau']) ? 1 : 0;
            if ($cadeau) {
                if ($body['message_kdo'] !== filter_var($body['message_kdo'], FILTER_SANITIZE_SPECIAL_CHARS)) {
                    throw new \Exception('Erreur de saisie');
                } 
            }
            $message_kdo = $cadeau ? filter_var($body['message_kdo'], FILTER_SANITIZE_SPECIAL_CHARS) : '';

            $data = [
                'libelle' => $libelle,
                'description' => $description,
                'cadeau' => $cadeau,
                'message_kdo' => $message_kdo
            ];

            $box_id = $this->boxService->createBox($data);
            return $rs->withStatus(302)->withHeader('Location', '/box');

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
