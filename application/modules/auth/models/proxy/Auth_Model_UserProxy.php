<?php

namespace Proxies;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Auth_Model_UserProxy extends \Auth_Model_User implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }
    
    
    public function __set($attr, $val)
    {
        $this->__load();
        return parent::__set($attr, $val);
    }

    public function __get($attr)
    {
        $this->__load();
        return parent::__get($attr);
    }

    public function setPassword($password, $hash)
    {
        $this->__load();
        return parent::setPassword($password, $hash);
    }

    public function toArray()
    {
        $this->__load();
        return parent::toArray();
    }

    public function getId_user()
    {
        $this->__load();
        return parent::getId_user();
    }

    public function getEmailuser()
    {
        $this->__load();
        return parent::getEmailuser();
    }

    public function getFirstname_user()
    {
        $this->__load();
        return parent::getFirstname_user();
    }

    public function getLastname_user()
    {
        $this->__load();
        return parent::getLastname_user();
    }

    public function getLogin_user()
    {
        $this->__load();
        return parent::getLogin_user();
    }

    public function getPassword_user()
    {
        $this->__load();
        return parent::getPassword_user();
    }

    public function getRank_user()
    {
        $this->__load();
        return parent::getRank_user();
    }

    public function getIsActive_user()
    {
        $this->__load();
        return parent::getIsActive_user();
    }

    public function getDateregister_user()
    {
        $this->__load();
        return parent::getDateregister_user();
    }

    public function getLastlogin_user()
    {
        $this->__load();
        return parent::getLastlogin_user();
    }

    public function getToken()
    {
        $this->__load();
        return parent::getToken();
    }

    public function setId_user($id_user)
    {
        $this->__load();
        return parent::setId_user($id_user);
    }

    public function setEmailuser($email_user)
    {
        $this->__load();
        return parent::setEmailuser($email_user);
    }

    public function setFirstname_user($firstname_user)
    {
        $this->__load();
        return parent::setFirstname_user($firstname_user);
    }

    public function setLastname_user($lastname_user)
    {
        $this->__load();
        return parent::setLastname_user($lastname_user);
    }

    public function setLogin_user($login_user)
    {
        $this->__load();
        return parent::setLogin_user($login_user);
    }

    public function setPassword_user($password_user)
    {
        $this->__load();
        return parent::setPassword_user($password_user);
    }

    public function setRank_user($rank_user)
    {
        $this->__load();
        return parent::setRank_user($rank_user);
    }

    public function setIsActive_user($isActive_user)
    {
        $this->__load();
        return parent::setIsActive_user($isActive_user);
    }

    public function setDateregister_user($dateregister_user)
    {
        $this->__load();
        return parent::setDateregister_user($dateregister_user);
    }

    public function setLastlogin_user($lastlogin_user)
    {
        $this->__load();
        return parent::setLastlogin_user($lastlogin_user);
    }

    public function setToken($token)
    {
        $this->__load();
        return parent::setToken($token);
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id_user', 'emailuser', 'firstname_user', 'lastname_user', 'login_user', 'password_user', 'rank_user', 'isActive_user', 'dateregister_user', 'lastlogin_user', 'token');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields AS $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}