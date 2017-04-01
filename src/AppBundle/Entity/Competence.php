<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 13/03/2017
 * Time: 21:13
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="competence")
 *
 */
class Competence
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="competence", type="text")
     */
    private $competence;

    /**
     * @ORM\Column(name="logo", type="text")
     */
    private $logo;

    /**
     * @ORM\Column(name="niveau", type="text")
     */
    private $niveau;

    /**
     * @ORM\Column(name="id_user", type="integer")
     */
    private $id_user;

    /**
     * Competence constructor.
     * @param $competence
     * @param $logo
     * @param $niveau
     * @param $id_user
     */
    public function __construct($competence, $logo, $niveau, $id_user)
    {
        $this->competence = $competence;
        $this->logo = $logo;
        $this->niveau = $niveau;
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
     * Set competence
     *
     * @param string $competence
     *
     * @return Competence
     */
    public function setCompetence($competence)
    {
        $this->competence = $competence;

        return $this;
    }

    /**
     * Get competence
     *
     * @return string
     */
    public function getCompetence()
    {
        return $this->competence;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Competence
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set niveau
     *
     * @param string $niveau
     *
     * @return Competence
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return string
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Competence
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
}
