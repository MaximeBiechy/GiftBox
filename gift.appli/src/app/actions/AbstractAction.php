<?php 
declare(strict_types=1);

namespace gift\appli\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

abstract class AbstractAction {
    
    abstract function __invoke(Request $rq, Response $rs, $args) : Response;
}   