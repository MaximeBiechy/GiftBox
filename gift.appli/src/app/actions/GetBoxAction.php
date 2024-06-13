<?php
declare(strict_types=1);

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\app\providers\auth\AuthProviderInterface;
use gift\appli\app\providers\auth\SessionAuthProvider;
use gift\appli\core\services\box\BoxService;
use gift\appli\core\services\box\BoxServiceInterface;
use gift\appli\core\services\box\BoxServiceNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class GetBoxAction extends AbstractAction
{
    private string $template;
    private BoxServiceInterface $boxService;
    private AuthProviderInterface $authService;

    public function __construct()
    {
        $this->template = 'boxView.html.twig';
        $this->boxService = new BoxService();
        $this->authService = new SessionAuthProvider();
    }

    function __invoke(Request $rq, Response $rs, $args): Response
    {
        try {
            if ($this->authService->isSignedIn()) {
                $boxes = $this->boxService->getBoxFromUser($this->authService->getSignedInUser()['id']);
                $view = Twig::fromRequest($rq);
                return $view->render($rs, $this->template, ['boxes' => $boxes]);
            }
            return $rs->withHeader('Location', '/connexion')->withStatus(302);
        } catch (BoxServiceNotFoundException $e) {
            throw new HttpNotFoundException($rq , $e->getMessage());        
        }

    }
}
