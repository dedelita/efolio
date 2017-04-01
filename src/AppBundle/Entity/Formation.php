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
    private $id;

    /**
     * @ORM\Column(name="formation", type="text")
     */
    private $formation;

    /**
     * @ORM\Column(name="annees", type="text")
     */
    private $annees;

    /**
     * @ORM\Column(name="etablissement", type="text")
     */
    private $etablissement;

    /**
     * @ORM\Column(name="ville", type="text")
     */
    private $ville;

    /**
     * @ORM\Column(name="id_user", type="integer")
     */
    private $id_user;

    /**
     * Formation constructor.
     * @param $formation
     * @param $annees
     * @param $etablissement
     * @param $ville
     * @param $id_user
     */
    public function __construct($formation, $annees, $etablissement, $ville, $id_user)
    {
        $this->formation = $formation;
        $this->annees = $annees;
        $this->etablissement = $etablissement;
        $this->ville = $ville;
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
     * Set formation
     *
     * @param string $formation
     *
     * @return Formation
     */
    public function setFormation($formation)
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * Get formation
     *
     * @return string
     */
    public function getFormation()
    {
        return $this->formation;
    }

    /**
     * Set annees
     *
     * @param string $annees
     *
     * @return Formation
     */
    public function setAnnees($annees)
    {
        $this->annees = $annees;

        return $this;
    }

    /**
     * Get annees
     *
     * @return string
     */
    public function getAnnees()
    {
        return $this->annees;
    }

    /**
     * Set etablissement
     *
     * @param string $etablissement
     *
     * @return Formation
     */
    public function setEtablissement($etablissement)
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * Get etablissement
     *
     * @return string
     */
    public function getEtablissement()
    {
        return $this->etablissement;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Formation
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
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
     * @return integer
     */
    public function getIdUser()
    {
        return $this->id_user;
    }
}
