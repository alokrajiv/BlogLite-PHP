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

class DashController extends Controller {
    /* @var $view \Twig_Environment */
    /* @var $entity_manager Doctrine\ORM\EntityManager */

    /**
     * Display the data
     *
     * @return null
     */
    function display() {
        $data['username'] = $_SESSION['user_data']['username'];
        echo $this->view->render("dash/index.twig", array('data' => $data));
    }

    public function action() {
        //no action
    }

}
