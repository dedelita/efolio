<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 18/03/2017
 * Time: 22:10
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 *
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="nom", type="text")
     */
    private $nom;

    /**
     * @ORM\Column(name="prenom", type="text")
     */
    private $prenom;

    /**
     * @ORM\Column(name="email", type="text")
     */
    private $email;

    /**
     * @ORM\Column(name="password", type="text")
     */
    private $password;

    /**
     * @ORM\Column(name="date_naissance", type="text")
     */
    private $date_naissance;

    /**
     * @ORM\Column(name="permis", type="boolean")
     */
    private $permis;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set date_naissance
     *
     * @param int $date_naissance
     *
     * @return User
     */
    public function setDateNaissance($date_naissance)
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    /**
     * Get date_naissance
     *
     * @return int
     */
    public function getDateNaissance()
    {
        return $this->date_naissance;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }


    /**
     * Set permis
     *
     * @param boolean $permis
     *
     * @return User
     */
    public function setPermis($permis)
    {
        $this->permis = $permis;

        return $this;
    }

    /**
     * Get permis
     *
     * @return boolean
     */
    public function getPermis()
    {
        return $this->permis;
    }
}
