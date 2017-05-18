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

class InternalLoginCallbackController extends AuthenticationController {

    function action() {
        /* @var $user \User */
        $user = $this->entity_manager->getRepository('User')->findOneBy(array('username' => $_POST['username']));
        if (is_null($user)) {
            header("Location: /login/?err=2");
            exit();
        } else {
            /* @var $user_creds \UserCreds */
            $user_creds = $this->entity_manager->getRepository('User_Creds')->find($user->getId());
            if ($user_creds->verifyPasswd($_POST['passwd'])) {
                $this->session_reset_sub_action();
                $_SESSION['user_data']['username'] = $user->getUsername();
                $_SESSION['user_data']['id'] = $user->getId();
                $this->safeRedirect("/dash/");
            } else {
                header('Location: /login/?err=1');
                exit();
            }
        }
    }

}
