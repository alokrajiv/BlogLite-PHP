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

class ConvoiceSignupHandler extends SignupHandleController {

    public function action() {
        $data = $_POST;
        $data['dob'] = new \DateTime($data['dob']);
        $user = $this->signup($data);
        $this->createInternalCreds($user);
    }

}
