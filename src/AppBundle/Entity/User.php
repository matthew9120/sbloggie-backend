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
    
    public function __construct($username, $password, $email, array $roles)
    {
        $this->username = $username;
        //hash password
        $this->password = $password;
        $this->email = $email;
        $this->roles = $roles;
        
        //to do
        $this->registerToken = $this->randomizeToken();
        $this->loginToken = $this->randomizeToken();
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
    
    public function eraseCredentials() { }
    
    public function isAccountNonExpired()
    {
        return true;
    }
    
    public function isAccountNonLocked()
    {
        return true;
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
        //check unique
        return null;
    }
}
