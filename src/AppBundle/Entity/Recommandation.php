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
    protected $id;

    /**
     * @ORM\Column(name="id_user", type="integer")
     */
    private $id_user;

    /**
     * @ORM\Column(name="personne", type="text")
     */
    private $personne;

    /**
     * @ORM\Column(name="entreprise", type="text")
     */
    private $entreprise;

    /**
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    public function __construct($personne, $entreprise, $contenu, $id_user)
    {
        $this->personne = $personne;
        $this->entreprise = $entreprise;
        $this->contenu = $contenu;
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
     * @param \number $idUser
     *
     * @return Recommandation
     */
    public function setIdUser(\number $idUser)
    {
        $this->id_user = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \number
     */
    public function getIdUser()
    {
        return $this->id_user;
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
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Recommandation
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }
}
