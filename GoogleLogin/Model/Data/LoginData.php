<?php

namespace BA\GoogleLogin\Model\Data;

use BA\GoogleLogin\Api\Data\LoginDataInterface;
use Magento\Framework\DataObject;

class LoginData extends DataObject implements LoginDataInterface
{
    public function getId()
    {
        return $this->getData(LoginDataInterface::ID);
    }

    public function setId($id)
    {
        return $this->setData(LoginDataInterface::ID, $id);
    }

    /**
     * Get Social Id
     * 
     * @return int
     */
    public function getSocialId()
    {
        return $this->getData(LoginDataInterface::SOCIAL_ID);
    }

    /**
     * Set Social Id
     * 
     * @param mixed $socialId
     * @return LoginDataInterface
     */
    public function setSocialId($socialId)
    {
        return $this->setData(LoginDataInterface::SOCIAL_ID, $socialId);
    }

    /**
     * Get Customer Id
     * 
     * @return int
     */
    public function getCustomerId()
    {
        return $this->getData(LoginDataInterface::CUSTOMER_ID);
    }

    /**
     * Set Customer Id
     * 
     * @param int $customerId
     * @return LoginDataInterface
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(LoginDataInterface::CUSTOMER_ID, $customerId);
    }

    /**
     * Get Type
     * 
     * @return string
     */
    public function getType()
    {
        return $this->getData(LoginDataInterface::TYPE);
    }

    /**
     * Set Type
     * 
     * @param string $type
     * @return LoginDataInterface
     */
    public function setType($type)
    {
        return $this->setData(LoginDataInterface::TYPE, $type);
    }

    /**
     * Get Created Date
     * 
     * @return datetime
     */
    public function getSocialCreatedAt()
    {
        return $this->getData(LoginDataInterface::SOCIAL_CREATED_AT);
    }

    /**
     * Set Created Date
     * 
     * @param datetime $createdDate
     * @return LoginDataInterface
     */
    public function setSocialCreatedAt($createdDate)
    {
        return $this->setData(LoginDataInterface::SOCIAL_CREATED_AT, $createdDate);
    }

    /**
     * Get status
     * 
     * @return smallint
     */
    public function getStatus()
    {
        return $this->getData(LoginDataInterface::STATUS);
    }

    /**
     * Set status
     * 
     * @param smallint $status 
     * @return LoginDataInterface
     */
    public function setStatus($status)
    {
        return $this->setData(LoginDataInterface::STATUS, $status);
    }

    /**
     * Get firstname
     * 
     * @return string
     */
    public function getFirstName()
    {
        return $this->getData(LoginDataInterface::FIRST_NAME);
    }

    /**
     * Set firstname
     * 
     * @param string $firstname
     * @return LoginDataInterface
     */
    public function setFirstName($firstName)
    {
        return $this->setData(LoginDataInterface::FIRST_NAME, $firstName);
    }

    /**
     * Get lastname
     * 
     * @return string
     */
    public function getLastName()
    {
        return $this->getData(LoginDataInterface::LAST_NAME);
    }

    /**
     * Set lastname
     * 
     * @param string $lastname
     * @return LoginDataInterface
     */
    public function setLastName($lastName)
    {
        return $this->setData(LoginDataInterface::LAST_NAME, $lastName);
    }

    /**
     * Get email
     * 
     * @return string
     */
    public function getEmail()
    {
        return $this->getData(LoginDataInterface::EMAIL);
    }

    /**
     * Set Email
     * 
     * @param string $email
     * @return LoginDataInterface
     */
    public function setEmail($email)
    {
        return $this->setData(LoginDataInterface::EMAIL, $email);
    }
}
