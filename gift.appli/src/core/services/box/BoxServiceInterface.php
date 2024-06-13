<?php

namespace gift\appli\core\services\box;

interface BoxServiceInterface {
    
    public function getBoxFromUser(string $idUser):array;
    public function getBoxPredefinis():array;
    public function createBox(array $data):string;
    public function addPrestationToBox(string $idPresta, string $idBox):void;
    public function getPrestationFromBox(string $idBox):array;
    public function deletePrestationFromBox(string $idPresta, string $idBox):void;
    public function defineCurrentBox(string $idBox):void;
}