<?php
declare(strict_types=1);

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\core\services\box\BoxService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class PostAddPrestationToBoxAction extends AbstractAction
{
    private BoxService $boxService;

    public function __construct()
    {
        $this->boxService = new BoxService();
    }

    function __invoke(Request $rq, Response $rs, $args): Response
    {
        try {
            $body = $rq->getParsedBody();

            $prestation_id = $body['prestation_id'];
            
            if (isset($_SESSION['box'])) {
                $box = $_SESSION['box'];
            } else {
                return $rs->withStatus(302)->withHeader('Location', '/prestations'); 
            }

            if($_SESSION['state_box_detail'] === 1){
                $this->boxService->addPrestationToBox($prestation_id, $box->id);
                return $rs->withStatus(302)->withHeader('Location', '/box');
            }else{
                echo "<script type='text/javascript'>
                alert('La box courrante est déjà validé');
                window.location.href = '/box';
              </script>";
                exit;
            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }
}
