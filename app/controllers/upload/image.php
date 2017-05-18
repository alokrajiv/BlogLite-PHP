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

class ImageUploadController extends Controller {

    var $data;

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
        if (isset($_FILES['image'])) {
            //Get the image array of details
            $img = $_FILES['image'];
            //The new path of the uploaded image, rand is just used for the sake of it
            $filename = rand() . $img["name"];
            $path = BASE_DIR . "public/static/img/custom/" . $filename;
            //Move the file to our new path
            move_uploaded_file($img['tmp_name'], $path);
            //Get image info, reuiqred to biuld the JSON object
            $data = getimagesize($path);

            //The direct link to the uploaded image, this might varyu depending on your script location
            $link = "/static/img/custom/" . $filename;
            //Here we are constructing the JSON Object
//            $this->data = array("upload" => array(
//                    "links" => array("original" => $link),
//                    "image" => array("width" => $data[0],
//                        "height" => $data[1]
//                    )
//            ));
            $this->data = array("data" => array(
                    "link" => $link,
                    "width" => $data[0]
            ));
        }
    }

}
