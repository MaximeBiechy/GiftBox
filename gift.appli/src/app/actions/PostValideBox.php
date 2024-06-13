<?php
declare(strict_types=1);

namespace gift\appli\app\actions;

use gift\appli\core\services\box\BoxService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PostValideBox extends AbstractAction {
    private BoxService $boxService;

    public function __construct()
    {
        $this->boxService = new BoxService();
    }
    function __invoke(Request $rq, Response $rs, $args): Response
    {
        $prestas = $this->boxService->getPrestationFromBox($_POST['id']);
        $cat_ids = array_column($prestas, 'cat_id');

        // Verification qu'il y ait au-moins 2 prestations et 2 categories diff
        if( count($prestas) >= 2 and count(array_unique($cat_ids)) >= 2){
            $this->boxService->validateBox($_POST['id']);
        }

        return  $rs->withStatus(302)->withHeader('Location', '/box');
    }
}