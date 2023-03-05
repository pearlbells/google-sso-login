<?php

namespace BA\GoogleLogin\Api\Data;

interface LoginDataInterface
{
    const SCHEMA_NAME = 'ba_social_login';
    const ID = 'id';
    const SOCIAL_ID = 'social_id';
    const CUSTOMER_ID = 'customer_id';
    const TYPE = 'type';
    const SOCIAL_CREATED_AT = 'social_created';
    const STATUS = 'status';
    const FIRST_NAME = 'firstname';
    const LAST_NAME = 'lastname';
    const EMAIL = 'email';

    /**
     * Get id
     * 
     * @return int|null
     */
    public function getId();

    /**
     * 
     * @param int $id 
     * @return LoginDataInterface
     */
    public function setId($id);

    /**
     * Get Social Id
     * 
     * @return int
     */
    public function getSocialId();

    /**
     * Set Social Id
     * 
     * @param mixed $socialId
     * @return LoginDataInterface
     */
    public function setSocialId($projectId);

    /**
     * Get Customer Id
     * 
     * @return int
     */
    public function getCustomerId();

    /**
     * Set Customer Id
     * 
     * @param int $customerId
     * @return LoginDataInterface
     */
    public function setCustomerId($customerId);

    /**
     * Get Type
     * 
     * @return string
     */
    public function getType();

    /**
     * Set Type
     * 
     * @param string $type
     * @return LoginDataInterface
     */
    public function setType($requestType);

    /**
     * Get Created Date
     * 
     * @return datetime
     */
    public function getSocialCreatedAt();

    /**
     * Set Created Date
     * 
     * @param datetime $createdDate
     * @return LoginDataInterface
     */
    public function setSocialCreatedAt($createdDate);

    /**
     * Get code status
     * 
     * @return smallint
     */
    public function getStatus();

    /**
     * Set status
     * 
     * @param smallint $status 
     * @return LoginDataInterface
     */
    public function setStatus($status);
    
    /**
     * Get firstname
     * 
     * @return string
     */
    public function getFirstName();

    /**
     * Set firstname
     * 
     * @param string $firstname
     * @return LoginDataInterface
     */
    public function setFirstName($firstName);

     /**
     * Get lastname
     * 
     * @return string
     */
    public function getLastName();

    /**
     * Set lastname
     * 
     * @param string $lastname
     * @return LoginDataInterface
     */
    public function setLastName($lastName);

     /**
     * Get email
     * 
     * @return string
     */
    public function getEmail();

    /**
     * Set Email
     * 
     * @param string $email
     * @return LoginDataInterface
     */
    public function setEmail($email);
}
