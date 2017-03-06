<?php
namespace AppBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="'user'")
 *
 */
class User extends BaseUser {
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(name="last_name", type="text")
     */ 
    private $last_name;
    
    /**
     * @ORM\Column(name="firt_name", type="text")
     */ 
    private $first_name;
    
    /**
     * @ORM\Column(name="email", type="text")
     */ 
    private $email;
    
    /**
     * @ORM\Column(name="email", type="text")
     */ 
    private $email;
    
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}
