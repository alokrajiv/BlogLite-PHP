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

/**
 * @Entity @Table(name="post")
 * @HasLifecycleCallbacks
 * */
class Post {

    /** @Id @Column(type="integer") @GeneratedValue * */
    private $id;

    /** @ManyToOne(targetEntity="User") */
    private $owner;

    /** @Column(name="heading", type="string", length=500) */
    private $heading;

    /** @Column(name="content", type="string", length=5000) */
    private $content;

    /** @Column(name="last_updated", type="datetime") */
    private $last_updated;

    public function __construct(User $user) {
        $this->owner = $user;
    }

    /**
     * Get representation
     *
     * @return Array
     */
    public function getRepr() {
        return array(
            "id" => $this->getId(),
            "heading" => $this->getHeading(),
            "content" => $this->getContent(),
            "lastUpdated" => $this->getLastUpdated()->format('c'),
            "owner" => array(
                "id" => $this->getOwner()->getId(),
                "username" => $this->getOwner()->getUsername(),
            )
        );
    }

    /**
     * Set data
     *
     * @param string $data
     *
     * @return Post
     */
    public function setContent($data) {
        $this->content = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     *
     * @PrePersist @PreUpdate
     *
     * Set lastUpdated
     *
     * @param \DateTime $lastUpdated
     *
     * @return User_Creds
     */
    public function setLastUpdated() {
        $this->last_updated = new \DateTime("now");

        return $this;
    }

    /**
     * Get lastUpdated
     *
     * @return \DateTime
     */
    public function getLastUpdated() {
        return $this->last_updated;
    }

    /**
     * @PrePersist @PreUpdate
     */
    public function autoSetLastUpdated() {
        $this->setLastUpdated();
    }

    /**
     * Get owner
     *
     * @return \User
     */
    public function getOwner() {
        return $this->owner;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set owner
     *
     * @param \User $owner
     *
     * @return Post
     */
    public function setOwner(\User $owner = null) {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Set heading
     *
     * @param string $heading
     *
     * @return Post
     */
    public function setHeading($heading) {
        $this->heading = $heading;

        return $this;
    }

    /**
     * Get heading
     *
     * @return string
     */
    public function getHeading() {
        return $this->heading;
    }

}
