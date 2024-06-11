<?php
declare(strict_types=1);

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\core\services\box\BoxService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class PostAddPrestationToBoxAction extends AbstractAction
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

            $prestation_id = $body['prestation_id'];
            
            if (isset($_SESSION['box'])) {
                $box = $_SESSION['box'];
            } else {
                return $rs->withStatus(302)->withHeader('Location', '/prestations'); 
            }

            $this->boxService->addPrestationToBox($prestation_id, $box->id);
            
            return $rs->withStatus(302)->withHeader('Location', '/box');

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }
}
