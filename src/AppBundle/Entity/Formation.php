<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="formation")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\FormationRepository")
 *
 */
class Formation
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="text")
     */
    private $name;

    /**
     * @ORM\Column(name="years", type="text")
     */
    private $years;

    /**
     * @ORM\Column(name="institute", type="text")
     */
    private $institute;

    /**
     * @ORM\Column(name="id_user", type="integer")
     */
    private $id_user;

    public function __construct($name, $years, $institute, $id_user)
    {
        $this->name = $name;
        $this->years = $years;
        $this->institute  = $institute;
        $this->id_user = $id_user;
    }


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Formation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set years
     *
     * @param string $years
     *
     * @return Formation
     */
    public function setYears($years)
    {
        $this->years = $years;

        return $this;
    }

    /**
     * Get years
     *
     * @return string
     */
    public function getYears()
    {
        return $this->years;
    }

    /**
     * Set institute
     *
     * @param string $institute
     *
     * @return Formation
     */
    public function setInstitute($institute)
    {
        $this->institute = $institute;

        return $this;
    }

    /**
     * Get institute
     *
     * @return string
     */
    public function getInstitute()
    {
        return $this->institute;
    }

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
     * Set idUser
     *
     * @param string $idUser
     *
     * @return Formation
     */
    public function setIdUser($idUser)
    {
        $this->id_user = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return string
     */
    public function getIdUser()
    {
        return $this->id_user;
    }
}
