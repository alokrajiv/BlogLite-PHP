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

class SignupController extends Controller {

    var $target_req, $target_view;

    function __construct($view, $entity_manager, $id) {
        $this->target_req = $id;
        parent::__construct($view, $entity_manager);
        $fb = new Facebook\Facebook([
            'app_id' => '216359655433374', // Replace {app-id} with your app id
            'app_secret' => 'ded5c8489172664516c7be06d388b640',
            'default_graph_version' => 'v2.2',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email', 'public_profile', 'user_birthday']; // Optional permissions
        $this->loginUrl = $helper->getLoginUrl('http://' . $_SERVER['HTTP_HOST'] . '/signup/fb-callback/' . $this->target_req . '/', $permissions);

        //$this->fb_uri =  '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
    }

    function action() {
        switch ($this->target_req) {
            case 1:
                $this->target_view = "signup/game-changer.twig";
                break;
            case 2:
                $this->target_view = "signup/opp-creator.twig";
                break;
            case 3:
                $this->target_view = "signup/explorer.twig";
                break;

            default:
                break;
        }
    }

    /**
     * Display the data
     *
     * @return null
     */
    function display() {
        echo $this->view->render($this->target_view, array("fb_url" => $this->loginUrl, "lorem" => $_SERVER['HTTP_HOST']));
    }

}
