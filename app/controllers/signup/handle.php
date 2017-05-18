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

class SignupHandleController extends Controller {

    function __construct($view, $entity_manager, $id) {
        $this->target_req = $id;
        parent::__construct($view, $entity_manager);
    }

    function collectFromPost() {

    }

    function signup($data) {
        $this->data_inp = $data;
        var_dump($this->data_inp);
        //die("THE END");
        try {
            $user = new User();
            $user->setType(intval($this->data_inp['user-type']));
            $user->setFirstName($this->data_inp['firstname']);
            $user->setMiddleName($this->data_inp['middlename']);
            $user->setLastName($this->data_inp['lastname']);
            $user->setDob($this->data_inp['dob']);
            $user->setGender($this->data_inp['gender']);
            $user->setUsername($this->data_inp['username']);
            $user->setEmail($this->data_inp['email']);
            $user->setJoinedDate(new \DateTime("now"));
            $user->setReadyStatus("code1");
            $this->entity_manager->persist($user);
            $this->entity_manager->flush();
            $this->data_out = $user;
            $this->createDummyPhoto();
        } catch (Exception $exc) {
            echo "<h1>CUSTOM-GENERAGTED ERROR!!</h1><pre>" . $exc->getTraceAsString() . "</pre>";
            var_dump($exc->getTrace());
            die();
            //Doctrine\Common\Util\Debug::dump($exc->getTrace());
        }
        return $user;
    }

    function createInternalCreds($user) {
        $user_creds = new User_Creds($user);
        $user_creds->setPasswdHash($this->data_inp['password']);
        $this->entity_manager->persist($user_creds);
        $this->entity_manager->flush();
    }

    function createDummyPhoto() {
        $sizes = array();
        array_push($sizes, array(500, 500));
        array_push($sizes, array(350, 350));
        array_push($sizes, array(150, 150));
        $extension = "jpg";
        foreach ($sizes as $size) {
            $l = $size[0];
            $b = $size[1];
            $def = BASE_DIR . "file_store/default" . $l . "x" . $b . "." . $extension;
            $usr = BASE_DIR . "public/static/dp/" . $this->data_inp['username'] . $l . "x" . $b . "." . $extension;
            copy($def, $usr);
        }
    }

    /**
     * Display the data
     *
     * @return null
     */
    function display() {
        //echo $this->view->render("signup/join.twig", array());
        //var_dump($this->data_inp);
        //echo "Created User with ID " . $this->data_out->getId() . "\n";
        $status = TRUE;
        try {
            echo $this->view->render("signup/done.twig", array('logout_success' => $status));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function action() {

    }

}
