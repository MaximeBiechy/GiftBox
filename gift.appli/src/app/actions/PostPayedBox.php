<?php
declare(strict_types=1);

namespace gift\appli\app\actions;

use gift\appli\core\services\box\BoxService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PostPayedBox extends AbstractAction {
    private BoxService $boxService;

    public function __construct()
    {
        $this->boxService = new BoxService();
    }

    function __invoke(Request $rq, Response $rs, $args): Response
    {
        return $rq;
    }
}