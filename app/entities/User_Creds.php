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
 * @Entity @Table(name="user_creds")
 * @HasLifecycleCallbacks
 * */
class User_Creds {

    /** @Id @OneToOne(targetEntity="User") */
    private $user;

    /** @Column(name="passwd_hash", type="string", length=100) */
    private $passwd_hash;

    /** @Column(name="last_updated", type="datetime") */
    private $last_updated;

    public function __construct(User $user) {
        $this->user = $user;
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
     * Set passwdHash by passing a plain text password
     * uses PASSWORD_BCRYPT with cost 11 to generate hash
     *
     * @param string $passwdHash
     *
     * @return User_Creds
     */
    public function setPasswdHash($passwd_plain_text) {
        $options = [
            'cost' => 11,
        ];
        $this->passwd_hash = password_hash($passwd_plain_text, PASSWORD_BCRYPT, $options);

        return $this;
    }

    /**
     * Get passwdHash
     *
     * @return string
     */
    public function getPasswdHash() {
        return $this->passwd_hash;
    }

    /**
     * Verify existing password with
     * @param string
     * @return boolean
     */
    public function verifyPasswd($passwd_inp) {
        //if ($passwd_inp === $this->passwd_hash) {
        return password_verify($passwd_inp, $this->passwd_hash);
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
     * Set userId
     *
     * @param \User $userId
     *
     * @return User_Creds
     */
    public function setUserId(\User $userId) {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return \User
     */
    public function getUserId() {
        return $this->user_id;
    }

    /**
     * Set user
     *
     * @param \User $user
     *
     * @return User_Creds
     */
    public function setUser(\User $user) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \User
     */
    public function getUser() {
        return $this->user;
    }

}
