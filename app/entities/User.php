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

//**REMARKS
//consider using datetimez instead of datetime for timezone
//known-for not saved yet

/**
 * @Entity @Table(name="user")
 * */
class User {

    /** @Id @Column(type="integer") @GeneratedValue * */
    private $id;

    /** @Column(name="first_name", type="string", length=100) */
    private $first_name;

    /** @Column(name="middle_name", type="string", length=100, nullable=true) */
    private $middle_name;

    /** @Column(name="last_name", type="string", length=100) */
    private $last_name;

    /** @Column(name="joined_date", type="datetime") */
    private $joined_date;

    /** @Column(name="dob", type="date") */
    private $dob;

    /** @Column(name="ready_status", type="string")  */
    private $readyStatus;

    /** @Column(name="email", type="string", length=100, unique=true) */
    private $email;

    /** @Column(name="type", type="integer") */
    private $type;

    /** @Column(name="username", type="string", length=100) */
    private $username;

    /** @Column(name="gender", type="integer") */
    private $gender;

    /** @Column(name="nationality", type="string", length=50, nullable=true) */
    private $nationality;

    /** @Column(name="address", type="text", length=500, nullable=true) */
    private $address;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName) {
        $this->first_name = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName() {
        return $this->first_name;
    }

    /**
     * Set middleName
     *
     * @param string $middleName
     *
     * @return User
     */
    public function setMiddleName($middleName) {
        $this->middle_name = $middleName;

        return $this;
    }

    /**
     * Get middleName
     *
     * @return string
     */
    public function getMiddleName() {
        return $this->middle_name;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName) {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName() {
        return $this->last_name;
    }

    /**
     * Set joinedDate
     *
     * @param \DateTime $joinedDate
     *
     * @return User
     */
    public function setJoinedDate($joinedDate) {
        $this->joined_date = $joinedDate;

        return $this;
    }

    /**
     * Get joinedDate
     *
     * @return \DateTime
     */
    public function getJoinedDate() {
        return $this->joined_date;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return User
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User_Data
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Get concatted fullname
     *
     * @return string
     */
    public function getFullName() {
        $tmp = $this->first_name . " " . $this->middle_name . " " . $this->last_name;
        return preg_replace('!\s+!', ' ', $tmp);
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username) {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Set gender
     *
     * @param integer $gender
     *
     * @return User
     */
    public function setGender($gender) {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return integer
     */
    public function getGender() {
        return $this->gender;
    }

    /**
     * Set nationality
     *
     * @param string $nationality
     *
     * @return User
     */
    public function setNationality($nationality) {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return string
     */
    public function getNationality() {
        return $this->nationality;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return User
     */
    public function setAddress($address) {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Set dob
     *
     * @param \DateTime $dob
     *
     * @return User
     */
    public function setDob($dob) {
        $this->dob = $dob;

        return $this;
    }

    /**
     * Get dob
     *
     * @return \DateTime
     */
    public function getDob() {
        return $this->dob;
    }

    /**
     * Set readyStatus
     *
     * @param string $readyStatus
     *
     * @return User
     */
    public function setReadyStatus($readyStatus) {
        $this->readyStatus = $readyStatus;

        return $this;
    }

    /**
     * Get readyStatus
     *
     * @return string
     */
    public function getReadyStatus() {
        return $this->readyStatus;
    }

}
