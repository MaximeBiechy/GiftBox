<?php
declare(strict_types=1);

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\app\utils\CsrfService;
use gift\appli\core\services\authorization\AuthorizationService;
use gift\appli\core\services\authorization\AuthorizationServiceInterface;
use gift\appli\core\services\box\BoxService;
use gift\appli\core\services\box\BoxServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GetDetailBoxPredefinieAction extends AbstractAction
{

    private string $template;
    private BoxServiceInterface $boxService;
    private AuthorizationServiceInterface $authorizationService;

    public function __construct()
    {
        $this->template = 'detailsBoxPredefinieView.html.twig';
        $this->boxService = new BoxService();
        $this->authorizationService = new AuthorizationService();
    }

    function __invoke(Request $rq, Response $rs, $args): Response
    {
        $queryID = $rq->getQueryParams()['id'];
        $idBox = $queryID ? $queryID : null;

        $prestations = $this->boxService->getPrestationFromBox($idBox);
        $view = Twig::fromRequest($rq);
        return $view->render($rs, $this->template, ['prestations' => $prestations, 'box_id' => $idBox, 'csrf' => CsrfService::generate()]);
    }
}
