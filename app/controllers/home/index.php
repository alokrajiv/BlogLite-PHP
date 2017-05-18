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

class HomeController extends Controller {

    /**
     * Display the data
     *
     * @return null
     */
    function display() {
        //if not declared will cause silent error coz, when not logged in
        //render will try to pass non-existant variable.
        $data = array();
        if (isset($_SESSION['user_data'])) {
            $data = $_SESSION['user_data'];
        } else {
            $this->loginUrl = (new LoginController($this->view, $this->entity_manager))->fbLoginUrlCreator();
        }
        try {
            echo $this->view->render("home/index.twig", array('data' => $data, 'loginUrl' => $this->loginUrl));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function action() {
        //no action
    }

}
