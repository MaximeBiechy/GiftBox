<?php 
declare(strict_types=1);

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\app\utils\CsrfService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GetCreateCategorie extends AbstractAction {

    public string $template;

    public function __construct()
    {
        $this->template = 'categorieFormView.html.twig';
    }

    function __invoke(Request $rq, Response $rs, $args): Response
    {
        if (!isset($_SESSION['user'])) {
            return $rs->withHeader('Location', '/')->withStatus(302);
        }
        if ($_SESSION['user']['role'] !== 100) {
            return $rs->withHeader('Location', '/')->withStatus(302);
        }
        $view = Twig::fromRequest($rq);
        return $view->render($rs, $this->template, ['csrf' => CsrfService::generate()]);
    }
}