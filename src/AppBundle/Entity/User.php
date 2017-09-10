<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
  * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
  * @ORM\Table(name="user")
  */
class User implements AdvancedUserInterface
{
    /**
      * @ORM\Column(type="integer")
      * @ORM\Id
      * @ORM\GeneratedValue(strategy="AUTO")
      */
    private $userId;
    /**
      * @ORM\Column(type="simple_array")
      */
    private $roles;
    /**
      * @ORM\Column(type="string", length=15, unique=true)
      */
    private $username;
    /**
      * @ORM\Column(type="string")
      */
    private $password;
    /**
      * @ORM\Column(type="string", length=255, unique=true)
      */
    private $email;
    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $registerToken; 
    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $apiKey;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $passwordResetExpirationDate;
    
    const PASSWORD_RESET_DATE_INTERVAL = "P1D";
    
    public function __construct($username, $encodedPassword, $email, array $roles = array())
    {
        $this->username = $username;
        $this->password = $encodedPassword;
        $this->email = $email;
        $this->roles = $roles;
        
        $this->registerToken = $this->randomizeToken();
    }
    
    public function getRoles()
    {
        $roles = $this->roles;
        array_push($roles, "ROLE_USER");
        
        return $roles;
    }
    
    public function getUserId()
    {
        return $this->userId;
    }
    
    public function getSalt()
    {
        return null;
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function setUsername($username)
    {
        $this->username = $username;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    public function getRegisterToken()
    {
        return $this->registerToken;
    }
    
    public function getApiKey()
    {
        return $this->apiKey;
    }
    
    public function randomizeApiKey()
    {
        $this->apiKey = $this->randomizeToken();
    }
    
    public function getPasswordResetExpirationDate()
    {
        return $this->passwordResetExpirationDate;
    }
    
    public function setPasswordResetting()
    {
        $date = new \DateTime();
        $date->add(new \DateInterval(self::PASSWORD_RESET_DATE_INTERVAL));
        
        $this->passwordResetExpirationDate = $date;
    }
    
    public function eraseCredentials() { }
    
    public function isAccountNonExpired()
    {
        return true;
    }
    
    public function isAccountNonLocked()
    {
        return empty($this->passwordResetExpirationDate);
    }
    
    public function isCredentialsNonExpired()
    {
        return true;
    }
    
    public function isEnabled()
    {
        return empty($registerToken);
    }
    
    private function randomizeToken()
    {
        return \md5(\random_int(\PHP_INT_MIN, \PHP_INT_MAX));
    }
}
