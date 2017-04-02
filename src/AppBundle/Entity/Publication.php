<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 20/03/2017
 * Time: 13:30
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="publication")
 *
 */
class Publication
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="idUser", type="integer")
     */
    private $idUser;

    /**
     * @ORM\Column(name="titre", type="text")
     */
    private $titre;


    /**
     * @ORM\Column(name="publication", type="text")
     */
    private $publication;

    public function __construct($titre, $publication, $idUser)
    {
        $this->titre = $titre;
        $this->publication = $publication;
        $this->idUser = $idUser;
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
     * @param integer $idUser
     *
     * @return Publication
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return integer
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Publication
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set publication
     *
     * @param string $publication
     *
     * @return Publication
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return string
     */
    public function getPublication()
    {
        return $this->publication;
    }
}
