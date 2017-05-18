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

class E404Controller extends Controller {

    /**
     * Display the data
     *
     * @return null
     */
    function display() {
        $data = [];
        if (isset($_SESSION['user_data'])) {
            $data['username'] = $_SESSION['user_data']['username'];
        }

        echo $this->view->render("errors/404/index.twig", array('data' => $data));
    }

    public function action() {
        header("HTTP/1.0 404 Not Found");
    }

}
