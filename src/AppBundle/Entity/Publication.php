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
    protected $id;

    /**
     * @ORM\Column(name="id_user", type="integer")
     */
    private $id_user;

    /**
     * @ORM\Column(name="titre", type="text")
     */
    private $titre;


    /**
     * @ORM\Column(name="publication", type="text")
     */
    private $publication;

    public function __construct($titre, $publication, $id_user)
    {
        $this->titre = $titre;
        $this->publication = $publication;
        $this->id_user = $id_user;
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
        $this->id_user = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return integer
     */
    public function getIdUser()
    {
        return $this->id_user;
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
