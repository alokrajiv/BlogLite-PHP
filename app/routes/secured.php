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

$router->filter('auth', function() {
    if (!isset($_SESSION['user_data'])) {
        header('Location: /login/?err=0');
        exit();
        return false;
    }
});

//secured routes
$router->group(['before' => 'auth'], function($router) {
    $router->get('/dash/', function() {
        (new DashController($this->view, $this->entity_manager))->display();
    });

    $router->get('/settings/', function() {
        (new SettingsController($this->view, $this->entity_manager))->display();
    });

    $router->get('/in/me/', function() {
        header('Location: /in/' . $_SESSION['user_data']['username']);
        exit();
    });

    $router->get('/logout/', function() {
        (new LogoutController($this->view, $this->entity_manager))->display();
    });


    //SECURED API ROUTES

    $router->get('/api/post/{id:i}/', function($post_id = null) {
        $ctrl = (new PostController($this->view, $this->entity_manager));
        $ctrl->readById($post_id);
        $ctrl->display();
    });

    $router->post('/api/post/', function() {
        $ctrl = (new PostController($this->view, $this->entity_manager));
        $ctrl->create();
        $ctrl->display();
    });

    $router->get('/api/post/feed/prepare/', function() {
        $ctrl = (new PostController($this->view, $this->entity_manager));
        $ctrl->prepare_read_list();
        $ctrl->display();
    });

    $router->get('/api/post/aggregate/', function() {
        $ctrl = (new PostController($this->view, $this->entity_manager));
        $ctrl->aggregate();
        $ctrl->display();
    });

    $router->post('/api/file-upload/img/', function() {
        (new ImageUploadController($this->view, $this->entity_manager))->display();
    });

    $router->post('/api/file-upload/dp/', function() {
        (new ProfileUploadController($this->view, $this->entity_manager))->display();
    });
});
