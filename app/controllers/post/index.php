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

class PostController extends Controller {

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
        //no action
    }

    function create() {
        $user = $this->entity_manager->getRepository('User')->findOneBy(array('id' => $_SESSION['user_data']['id']));
        $post = new Post($user);
        $post->setContent($_POST['content']);
        $post->setHeading($_POST['heading']);
        $this->entity_manager->persist($post);
        $this->entity_manager->flush();
        $this->data = array("data" => $post->getRepr());
    }

    function aggregate() {
        /* @var $data Post[] */
        $data = $this->entity_manager->getRepository('Post')->findBy(array("id" => $_GET['data']));
        $this->data = array();
        foreach ($data as $value) {
            array_push($this->data, $value->getRepr());
        }
        //$this->data = $_GET['data'];
    }

    function prepare_read_list() {
        /* @var $data Post[] */
        $data = $this->entity_manager->getRepository('Post')->findBy([], ['last_updated' => 'ASC']);
        $this->data = array();
        foreach ($data as $value) {
            array_push($this->data, $value->getId());
        }
    }

    function readById($post_id) {
        /* @var $data Post */
        $data = $this->entity_manager->getRepository('Post')->find($post_id);
        $this->data = $data->getRepr();
        foreach ($data as $value) {
            array_push($this->data, $value->getRepr());
        }
    }

}
