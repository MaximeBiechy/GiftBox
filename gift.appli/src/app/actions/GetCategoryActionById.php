<?php
declare(strict_types=1);

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\core\services\catalogue\CatalogueService;
use gift\appli\core\services\catalogue\CatalogueServiceInterface;
use gift\appli\core\services\catalogue\CatalogueServiceNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class GetCategoryActionById extends AbstractAction
{
    private string $template;
    private CatalogueServiceInterface $catalogueService;

    public function __construct()
    {
        $this->template = 'categoryByIdView.html.twig';
        $this->catalogueService = new CatalogueService();
    }

    function __invoke(Request $rq, Response $rs, $args): Response
    {
        $id = (int)$args['id'];

        try {
            $categorie = $this->catalogueService->getCategorieById($id);
        } catch (CatalogueServiceNotFoundException $e) {
            throw new HttpNotFoundException($rq, $e->getMessage());
        }
        
        $view = Twig::fromRequest($rq);
        return $view->render($rs, $this->template, ['categorie' => $categorie]);
        
    }
}
