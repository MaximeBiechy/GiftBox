<?php 
declare (strict_types = 1);

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\core\services\catalogue\CatalogueService;
use gift\appli\core\services\catalogue\CatalogueServiceInterface;
use gift\appli\core\services\catalogue\CatalogueServiceNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class GetPrestationsAction extends AbstractAction {
   
    private string $template;
    private CatalogueServiceInterface $catalogueService;

    public function __construct()
    {
        $this->template = 'prestationsView.html.twig';
        $this->catalogueService = new CatalogueService();
    }
    
    function __invoke(Request $rq, Response $rs, $args): Response
    {
        try {
            $prestations = $this->catalogueService->getPrestations();
        } catch (CatalogueServiceNotFoundException $e) {
            throw new HttpNotFoundException($rq, $e->getMessage());
        }

        $view = Twig::fromRequest($rq);

        return $view->render($rs, $this->template, ['prestations' => $prestations]);
    }
}