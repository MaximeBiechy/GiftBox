<?php

namespace gift\appli\app\actions;


use gift\appli\core\services\box\BoxService;
use gift\appli\core\services\box\BoxServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GetCoffret extends AbstractAction
{

    private string $template;
    private BoxServiceInterface $boxService;

    public function __construct()
    {
        $this->template = 'coffret.html.twig';
        $this->boxService = new BoxService();
    }

    function __invoke(Request $rq, Response $rs, $args): Response
    {
        $queryID = $rq->getQueryParams()['id'];
        $idBox = $queryID ? $queryID : null;

        $prestations = $this->boxService->getBoxBuy($idBox);

        $this->boxService->usedBox($idBox);

        $view = Twig::fromRequest($rq);

        return $view->render($rs, $this->template, ['prestations' => $prestations]);
    }
}