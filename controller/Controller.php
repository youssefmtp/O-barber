<?php
/**
 * /controller/Controller.php
 * class technique pour définir les membres communs aux controllers
 *
 * @author Y.Ennour
 * @date 06/2023
 */


    class Controller {
        public static function render($view, $params){
            extract($params);
            require_once $view;
        }
    }
?>