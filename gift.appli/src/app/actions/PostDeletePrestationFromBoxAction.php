<?php
declare(strict_types=1);

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\core\services\box\BoxService;
use gift\appli\core\services\box\BoxServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PostDeletePrestationFromBoxAction extends AbstractAction
{
    private BoxServiceInterface $boxService;

    public function __construct()
    {
        $this->boxService = new BoxService();
    }

    function __invoke(Request $rq, Response $rs, $args): Response
    {   
        try {
            $idBox = $rq->getParsedBody()['box_id'];
            $idPresta = $rq->getParsedBody()['prestation_id'];            
            $this->boxService->deletePrestationFromBox($idBox, $idPresta);

            return $rs->withStatus(302)->withHeader('Location', '/detailBox?id=' . $idBox);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
