<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 20/03/2017
 * Time: 13:34
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="recommandation")
 *
 */
class Recommandation
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
     * @ORM\Column(name="personne", type="text")
     */
    private $personne;

    /**
     * @ORM\Column(name="entreprise", type="text")
     */
    private $entreprise;

    /**
     * @ORM\Column(name="recommandation", type="text")
     */
    private $recommandation;

    public function __construct($personne, $entreprise, $recommandation, $idUser)
    {
        $this->personne = $personne;
        $this->entreprise = $entreprise;
        $this->recommandation = $recommandation;
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
     * @return Recommandation
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
     * Set personne
     *
     * @param string $personne
     *
     * @return Recommandation
     */
    public function setPersonne($personne)
    {
        $this->personne = $personne;

        return $this;
    }

    /**
     * Get personne
     *
     * @return string
     */
    public function getPersonne()
    {
        return $this->personne;
    }

    /**
     * Set entreprise
     *
     * @param string $entreprise
     *
     * @return Recommandation
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
     * Set recommandation
     *
     * @param string $recommandation
     *
     * @return Recommandation
     */
    public function setRecommandation($recommandation)
    {
        $this->recommandation = $recommandation;

        return $this;
    }

    /**
     * Get recommandation
     *
     * @return string
     */
    public function getRecommandation()
    {
        return $this->recommandation;
    }
}
