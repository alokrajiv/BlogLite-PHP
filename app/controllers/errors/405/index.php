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

class E405Controller extends Controller {

    /**
     * Display the data
     *
     * @return null
     */
    function display() {
        $data['username'] = $_SESSION['user_data']['username'];
        echo $this->view->render("errors/405/index.twig", array('data' => $data));
    }

    public function action() {
        header("HTTP/1.0 405 Not Found");
    }

}
