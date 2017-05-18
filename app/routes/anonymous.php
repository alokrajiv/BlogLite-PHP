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

$router->filter('deflect', function() {
    if (isset($_SESSION['user_data'])) {
        header('Location: /dash/');
        exit();
        return FALSE;
    }
});
//anonymous routes not available after login
$router->group(['before' => 'deflect'], function($router) {
    $router->get('/login/', function() {
        (new LoginController($this->view, $this->entity_manager))->display();
    });
    $router->post('/login/authenticate/', function() {
        (new AuthenticationController($this->view, $this->entity_manager));
    });
    $router->get('/login/fb-callback/', function() {
        (new FbLoginCallbackController($this->view, $this->entity_manager))->display();
    });
    $router->get('/join/', function() {
        (new JoinController($this->view, $this->entity_manager))->display();
    });
    $router->get('/signup/{id:i}/', function($id) {
        (new SignupController($this->view, $this->entity_manager, $id))->display();
    });
    $router->post('/signup/handle/', function() {
        (new SignupHandleController($this->view, $this->entity_manager))->display();
    });
    $router->get('/signup/fb-callback/{id:i}/', function($id) {
        (new FbSignupHandler($this->view, $this->entity_manager, $id))->display();
    });
});
