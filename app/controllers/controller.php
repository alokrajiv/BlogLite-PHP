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

abstract class Controller {

    /**
     * @var \Doctrine\ORM\EntityManager $entity_manager This is my Database object
     */
    var $entity_manager;

    /**
     * @var \Twig_Environment $view This is my Database object
     */
    var $view;

    function __construct($view, $entity_manager) {
        $this->view = $view;
        $this->entity_manager = $entity_manager;
        $this->deflect();
        $this->action();
    }

    function deflect() {

    }

    /**
     * Perfom action
     *
     * @return null
     */
    abstract function action();

    /**
     * Display the data
     *
     * @return null
     */
    abstract function display();

    /**
     * Safely redirect by first trying header method but if headers were
     * already sent then use a <script> javascript method to redirect
     *
     * @param string
     * @return null
     */
    public function safeRedirect($new_url) {
        if (!headers_sent()) {
            header("Location: $new_url");
        } else {
            echo "<script>window.location.href = '$new_url';</script>";
        }
        exit();
    }

}
