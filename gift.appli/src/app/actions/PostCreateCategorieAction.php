<?php
declare(strict_types=1);

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\app\utils\CsrfService;
use gift\appli\core\services\catalogue\CatalogueService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PostCreateCategorieAction extends AbstractAction
{
    private CatalogueService $catalogueService;

    public function __construct()
    {
        $this->catalogueService = new CatalogueService();
    }

    function __invoke(Request $rq, Response $rs, $args): Response
    {

        
        try {
            $body = $rq->getParsedBody() ?? null;
            CsrfService::check($body['csrf']);
                
            // Création de la catégorie
            $libelle = $body['libelle'];
            $description = $body['description'];
            $img = $body['img'];
            $data = [
                'libelle' => $libelle,
                'description' => $description,
                'img' => $img
            ];
            
            $categorie_id = $this->catalogueService->createCategorie($data);
            
            
            return $rs->withStatus(302)->withHeader('Location', '/categories');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
