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

class SettingsController extends Controller {

    /**
     * Display the data
     *
     * @return null
     */
    function display() {
        $data['username'] = $_SESSION['user_data']['username'];
        echo $this->view->render("dash/settings.twig", array("data" => $data));
    }

    public function action() {
        //no action
    }

}
