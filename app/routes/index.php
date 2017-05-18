<?php

/*
 * @author Alok Rajiv <mail@alokrajiv.com>
 *
 * ---- LICENSE ----
 * Proprietary License
 * Copyright (C) Convoice Inc. - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

class Router {
    /* @var $view \Twig_Environment */
    /* @var $entity_manager Doctrine\ORM\EntityManager */

    var $view, $entity_manager;

    function __construct($view, $entity_manager) {
        $this->view = $view;
        $this->entity_manager = $entity_manager;
    }

    function dispatch() {
        $router = new Phroute\Phroute\RouteCollector();

        // Any thing other than null returned from a filter will prevent the route handler from being dispatched

        session_start();

        require_once __DIR__ . '/secured.php';

        require_once __DIR__ . '/anonymous.php';

        require_once __DIR__ . '/generic.php';

        $router->get('/dev/', function() {
            require BASE_DIR . "dev.php";
        });

        $dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

        try {
            $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        } catch (Exception $exc) {
            if ($exc instanceof Phroute\Phroute\Exception\HttpRouteNotFoundException) {
                (new E404Controller($this->view, $this->entity_manager))->display();
            } else if ($exc instanceof Phroute\Phroute\Exception\HttpMethodNotAllowedException) {
                header("HTTP/1.0 405 Method Not Allowed", 405);
                (new E405Controller($this->view, $this->entity_manager))->display();
            }
        }
    }

}
