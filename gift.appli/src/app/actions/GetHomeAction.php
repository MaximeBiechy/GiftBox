<?php
declare(strict_types=1);

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GetHomeAction extends AbstractAction {

    private string $template;

    public function __construct()
    {
        $this->template = 'home.html.twig';
    }

    function __invoke(Request $rq, Response $rs, $args): Response
    {

        $view = Twig::fromRequest($rq);

        return $view->render($rs, $this->template, []);
    }
}
