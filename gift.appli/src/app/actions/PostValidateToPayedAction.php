<?php

namespace gift\appli\app\actions;

use gift\appli\app\utils\CsrfService;
use gift\appli\core\services\box\BoxService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class PostValidateToPayedAction extends AbstractAction {
    private BoxService $boxService;
    public string $template;

    public function __construct()
    {
        $this->boxService = new BoxService();
        $this->template = 'payement.html.twig';
    }

    function __invoke(Request $rq, Response $rs, $args): Response
    {

        $view = Twig::fromRequest($rq);
        return $view->render($rs, $this->template, ['csrf' => CsrfService::generate(), 'box_id' => $_POST['id']]);
    }

}