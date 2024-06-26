<?php
declare(strict_types=1);

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\app\utils\CsrfService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GetInscriptionAction extends AbstractAction {
    
    private string $template;

    public function __construct()
    {
        $this->template = 'inscription.html.twig';
    }

    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        $view = Twig::fromRequest($rq);

        return $view->render($rs, $this->template, ['csrf' => CsrfService::generate()]);
    }
}
