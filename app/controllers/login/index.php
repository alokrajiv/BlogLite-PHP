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

class LoginController extends Controller {

    /**
     * Display the data
     *
     * @return null
     */
    function display() {
        $warn_messg = -1;
        if (isset($_GET['err'])) {
            $warn_messg = $_GET['err'];
        }
        $this->loginUrl = $this->fbLoginUrlCreator();
        echo $this->view->render("login/index.twig", array('warn_messg' => $warn_messg, 'loginUrl' => $this->loginUrl));
    }

    function fbLoginUrlCreator() {
        $fb = new Facebook\Facebook([
            'app_id' => '216359655433374', // Replace {app-id} with your app id
            'app_secret' => 'ded5c8489172664516c7be06d388b640',
            'default_graph_version' => 'v2.2',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email', 'public_profile', 'user_birthday']; // Optional permissions
        return $helper->getLoginUrl('http://' . $_SERVER['HTTP_HOST'] . '/login/fb-callback/', $permissions);
    }

    public function action() {
        //no action
    }

}
