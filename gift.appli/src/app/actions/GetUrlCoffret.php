<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GetUrlCoffret extends AbstractAction
{
    private string $template;

    public function __construct()
    {
        $this->template = 'urlGenerate.html.twig';
    }
    function __invoke(Request $rq, Response $rs, $args): Response
    {
        $id = $rq->getQueryParams()['id'];


        $view = Twig::fromRequest($rq);

        return $view->render($rs, $this->template, ['csrf' => $id]);
    }
}