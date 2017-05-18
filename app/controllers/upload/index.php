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

class UploadController extends Controller {

    /**
     * Display the data
     *
     * @return null
     */
    function display() {
        header('Content-Type: application/json');
        echo json_encode($this->data);
    }

    public function action() {

    }

}
