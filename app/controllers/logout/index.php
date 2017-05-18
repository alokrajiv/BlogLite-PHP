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

class LogoutController extends Controller {

    function action() {
        //reset
        $_SESSION = array();
        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
            );
        }
        // Finally, destroy the session.
        session_destroy();
    }

    /**
     * Display the data
     *
     * @return null
     */
    function display() {
        $status = !(session_status() == PHP_SESSION_ACTIVE);
        $data = array();
        if (isset($_SESSION['user_data'])) {
            $data = $_SESSION['user_data'];
        }
        try {
            echo $this->view->render("logout/index.twig", array('logout_success' => $status, 'data' => $data));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
