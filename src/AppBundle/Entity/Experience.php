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
    protected $id;

    /**
     * @ORM\Column(name="experience", type="text")
     */
    private $experience;
    /**
     * @ORM\Column(name="years", type="text")
     */
    private $years;

    /**
     * @ORM\Column(name="id_user", type="text")
     */
    private $id_user;

    
    public function __construct($experience, $years, $id_user)
    {
        $this->experience = $experience;
        $this->years = $years;
        $this->id_user  = $id_user;
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
     * Set years
     *
     * @param string $years
     *
     * @return Experience
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
     * Set idUser
     *
     * @param string $idUser
     *
     * @return Experience
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
