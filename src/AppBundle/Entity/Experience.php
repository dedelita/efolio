<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 13/03/2017
 * Time: 21:09
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="experience")
 *
 */
class Experience
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="experience", type="text")
     */
    private $experience;

    /**
     * @ORM\Column(name="periode", type="text")
     */
    private $periode;

    /**
     * @ORM\Column(name="entreprise", type="text")
     */
    private $entreprise;

    /**
     * @ORM\Column(name="idUser", type="integer")
     */
    private $idUser;

    /**
     * Experience constructor.
     * @param $experience
     * @param $periode
     * @param $entreprise
     * @param $idUser
     */
    public function __construct($experience, $periode, $entreprise, $idUser)
    {
        $this->experience = $experience;
        $this->periode = $periode;
        $this->entreprise = $entreprise;
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
     * Set experience
     *
     * @param string $experience
     *
     * @return Experience
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Get experience
     *
     * @return string
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * Set periode
     *
     * @param string $periode
     *
     * @return Experience
     */
    public function setPeriode($periode)
    {
        $this->periode = $periode;

        return $this;
    }

    /**
     * Get periode
     *
     * @return string
     */
    public function getPeriode()
    {
        return $this->periode;
    }

    /**
     * Set entreprise
     *
     * @param string $entreprise
     *
     * @return Experience
     */
    public function setEntreprise($entreprise)
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise
     *
     * @return string
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Experience
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
