<?php
declare(strict_types=1);

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\core\services\catalogue\CatalogueService;
use gift\appli\core\services\catalogue\CatalogueServiceInterface;
use gift\appli\core\services\catalogue\CatalogueServiceNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class GetPrestationByIdAction extends AbstractAction
{
    private string $template;
    private CatalogueServiceInterface $catalogueService;

    public function __construct()
    {
        $this->template = 'prestationByIdView.html.twig';
        $this->catalogueService = new CatalogueService();
    }

    function __invoke(Request $rq, Response $rs, $args): Response
    {
        $queryID = $rq->getQueryParams()['id'];
        $id = $queryID ? $queryID : null;

        if (is_null($id)) {
            throw new HttpBadRequestException($rq, "Pas d'id dans l'url");
        }

        try {
            $prestation = $this->catalogueService->getPrestationById($id);
        } catch (CatalogueServiceNotFoundException $e) {
            throw new HttpNotFoundException($rq, $e->getMessage());
        }

        if (is_null($prestation)) {
            throw new HttpNotFoundException($rq, "Prestation inexistante");
        }

        $view = Twig::fromRequest($rq);

        return $view->render($rs, $this->template, ['prestation' => $prestation]);
    }
}
