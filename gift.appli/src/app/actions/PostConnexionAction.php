<?php
declare(strict_types=1);

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\app\providers\auth\AuthProviderInterface;
use gift\appli\app\providers\auth\SessionAuthProvider;
use gift\appli\core\services\auth\AuthServiceNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

class PostConnexionAction extends AbstractAction {
    
    private AuthProviderInterface $authProvider;

    public function __construct()
    {
        $this->authProvider = new SessionAuthProvider();
    }

    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        try {
            $body = $rq->getParsedBody();
            $user = $this->authProvider->signin($body['email'], $body['password']);           
        } catch (AuthServiceNotFoundException $e) {
            throw new HttpNotFoundException($rq, $e->getMessage());
        }

        return $rs->withStatus(302)->withHeader('Location', '/categories');
    }
}
