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

class JoinController extends Controller {

    function action() {
        //no action
    }

    /**
     * Display the data
     *
     * @return null
     */
    function display() {
        $this->loginUrl = (new LoginController($this->view, $this->entity_manager))->fbLoginUrlCreator();
        echo $this->view->render("signup/join.twig", array('loginUrl' => $this->loginUrl));
    }

}
