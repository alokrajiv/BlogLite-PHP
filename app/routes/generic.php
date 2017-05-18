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

$router->get('/', function() {
    header("Location: /home/");
    exit();
});

$router->get('/home/', function() {
    //require_once APP_DIR . "controllers/home/index.php";
    (new HomeController($this->view, $this->entity_manager))->display();
});



$router->post('/api/file-upload/', function() {
    (new UploadController($this->view, $this->entity_manager))->display();
});

$router->get('/in/{username}?', function($username = null) {
    (new ProfileController($this->view, $this->entity_manager, $username))->display();
});



