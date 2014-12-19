<?php
/**
 * Created by PhpStorm.
 * User: markus-studium
 * Date: 17.12.14
 * Time: 19:57
 */

class RequestTypeException extends NotImplementedException {
    public function __construct(){
        parent::__construct('Der Anfrage-Typ wird nicht unterstützt.');
    }
}

?>