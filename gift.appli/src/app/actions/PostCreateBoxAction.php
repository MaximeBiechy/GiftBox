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
            $libelle = $body['libelle'];
            $description = $body['description'];
            $cadeau = $body['cadeau'];
            if (isset($body['cadeau'])) {
                $cadeau = 1;
                $message_kdo = $body['message_kdo'];
            } else {
                $cadeau = 0;
            }
            $data = [
                'libelle' => $libelle,
                'description' => $description,
                'cadeau' => $cadeau,
                'message_kdo' => $message_kdo ?? ''
            ];

            $box_id = $this->boxService->createBox($data);
            return $rs->withStatus(302)->withHeader('Location', '/box');

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }
}
