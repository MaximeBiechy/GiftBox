<?php
declare(strict_types=1);

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\core\services\box\BoxService;
use gift\appli\core\services\box\BoxServiceInterface;
use gift\appli\core\services\box\BoxServiceNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class GetBoxPredefinisAction extends AbstractAction
{
    private string $template;
    private BoxServiceInterface $boxService;

    public function __construct()
    {
        $this->template = 'boxPredefinisView.html.twig';
        $this->boxService = new BoxService();
    }

    function __invoke(Request $rq, Response $rs, $args): Response
    {
        try {
            $boxes = $this->boxService->getBoxPredefinis();
            $view = Twig::fromRequest($rq);
            return $view->render($rs, $this->template, ['boxes' => $boxes]);
        } catch (BoxServiceNotFoundException $e) {
            throw new HttpNotFoundException($rq , $e->getMessage());        
        }

    }
}
