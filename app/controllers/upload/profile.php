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

use Intervention\Image\ImageManager;

class ProfileUploadController extends UploadController {
    /* @var $view \Twig_Environment */
    /* @var $entity_manager Doctrine\ORM\EntityManager */

    public function action() {
        if ($_POST['operation'] === "profile_picture_update") {
            if (!empty($_FILES)) {

                $this->data = array('status' => array('received' => TRUE));

                $tempFile = $_FILES['file']['tmp_name'];

                $sizes = array();
                array_push($sizes, array(500, 500));
                array_push($sizes, array(350, 350));
                array_push($sizes, array(150, 150));

                $this->scale_and_save($tempFile, BASE_DIR . "public/static/dp/", "jpg", $sizes, $_SESSION['user_data']['username']);
            }
        }
    }

    function scale_and_save($file_path, $location, $extension, $size_spec, $username) {
        try {
            $manager = new ImageManager(array('driver' => 'imagick'));
            $img = $manager->make($file_path);
            foreach ($size_spec as $size) {
                $l = $size[0];
                $b = $size[1];
                $img
                        ->resize($l, $b)
                        ->save($location . $username . $l . "x" . $b . "." . $extension, 100);
                $this->data['status']['update'] = TRUE;
            }
        } catch (Exception $exc) {
            //echo $exc->getTraceAsString();
            $this->data['status']['update'] = FALSE;
        }
    }

}
