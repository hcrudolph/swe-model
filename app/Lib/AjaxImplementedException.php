<?php
/**
 * Created by PhpStorm.
 * User: markus-studium
 * Date: 17.12.14
 * Time: 19:57
 */

class AjaxImplementedException extends NotImplementedException {
    public function __construct(){
        super('Diese Aktion kann nur durch eine Ajax-Anfrage ausgelöst werden.');
    }
}

?>