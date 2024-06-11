<?php
declare(strict_types=1);

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\core\services\box\BoxService;
use gift\appli\core\services\box\BoxServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GetDetailBoxAction extends AbstractAction
{

    private string $template;
    private BoxServiceInterface $boxService;

    public function __construct()
    {
        $this->template = 'detailsBoxView.html.twig';
        $this->boxService = new BoxService();
    }

    function __invoke(Request $rq, Response $rs, $args): Response
    {
        $queryID = $rq->getQueryParams()['id'];
        $idBox = $queryID ? $queryID : null;

        $prestations = $this->boxService->getPrestationFromBox($idBox);
        $view = Twig::fromRequest($rq);
        return $view->render($rs, $this->template, ['prestations' => $prestations, 'box_id' => $idBox]);
    }
}
