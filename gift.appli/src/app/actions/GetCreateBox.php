<?php 
declare(strict_types=1);

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\app\utils\CsrfService;
use gift\appli\core\services\authorization\AuthorizationService;
use gift\appli\core\services\authorization\AuthorizationServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GetCreateBox extends AbstractAction {

    public string $template;
    private AuthorizationServiceInterface $authorizationService;

    public function __construct()
    {
        $this->template = 'boxFormView.html.twig';
        $this->authorizationService = new AuthorizationService();
    }

    function __invoke(Request $rq, Response $rs, $args): Response
    {
        if ($_SESSION['user'] && !$this->authorizationService->isGranted($_SESSION['user']['id'], CREATE_BOX, '')) {
            return $rs->withHeader('Location', '/connexion')->withStatus(302);
        } else if (!isset($_SESSION['user'])) {
            return $rs->withHeader('Location', '/connexion')->withStatus(302);
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, $this->template, ['csrf' => CsrfService::generate()]);
    }
}