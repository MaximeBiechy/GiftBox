<?php
declare(strict_types=1);

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\app\providers\auth\AuthProviderInterface;
use gift\appli\app\providers\auth\SessionAuthProvider;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetLogoutAction extends AbstractAction
{

    public AuthProviderInterface $authProvider;

    public function __construct()
    {
        $this->authProvider = new SessionAuthProvider();
    }

    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        $this->authProvider->signout();
        
        return $rs->withHeader('Location', '/')->withStatus(302);
    }
}
