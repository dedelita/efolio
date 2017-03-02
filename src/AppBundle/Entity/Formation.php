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
}
