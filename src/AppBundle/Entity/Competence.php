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
     * @ORM\Column(name="idUser", type="integer")
     */
    private $idUser;

    /**
     * Competence constructor.
     * @param $competence
     * @param $logo
     * @param $idUser
     */
    public function __construct($competence, $logo, $idUser)
    {
        $this->competence = $competence;
        $this->logo = $logo;
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
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Competence
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
}
