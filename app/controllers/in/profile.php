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

class ProfileController extends Controller {

    var $data, $username;

    function __construct($view, $entity_manager, $username) {
        $this->username = $username;
        parent::__construct($view, $entity_manager);
    }

    public function deflect() {
        //no action
        $data1 = $this->entity_manager->getRepository('User')
                ->findOneBy(array('username' => $this->username));
        if (is_null($data1)) {
            (new E404Controller($this->view, $this->entity_manager))->display();
            exit();
        }
    }

    public function action() {

    }

    /**
     * Display the data
     *
     * @return null
     */
    function display() {
        $data['username'] = $this->username;
        echo $this->view->render("in/profile.twig", array('data' => $data));
    }

}
