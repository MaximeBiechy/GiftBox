<?php
declare(strict_types=1);

namespace gift\appli\app\actions;

use gift\appli\app\utils\CsrfService;
use gift\appli\core\services\box\BoxService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class PostPayedBox extends AbstractAction {
    private BoxService $boxService;
    public string $template;

    public function __construct()
    {
        $this->boxService = new BoxService();
        $this->template = 'home.html.twig';
    }

    function __invoke(Request $rq, Response $rs, $args): Response
    {
        $user = $rq->getParsedBody();

        if($user['email'] === $_SESSION['user']['user_id'] and password_verify($user['password'], $_SESSION['user']['password'])) {

            $this->boxService->payedBox($_POST['id'], $_POST['csrf']);

            return $rs->withStatus(302)->withHeader('Location', '/box/coffret/?id='.$_POST['csrf']);
        }else{
            return $rs->withStatus(400)->withHeader('Location', '/box');
        }
    }
}