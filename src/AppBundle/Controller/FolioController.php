<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Formation;

class FolioController extends Controller
{
    public function getFormations() {
        $formationRepo = $this->getDoctrine()->getRepository('AppBundle:Formation');
        $formations = $formationRepo->findAll();

        return $formations;
    }

    public function getExperiences() {
        $experienceRepo = $this->getDoctrine()->getRepository('AppBundle:Experience');
        $experiences = $experienceRepo->findAll();

        return $experiences;
    }

    public function getCompetences() {
        $competenceRepo = $this->getDoctrine()->getRepository('AppBundle:Competence');
        $competences = $competenceRepo->findAll();

        return $competences;
    }

    public function getProjets() {
        $projetRepo = $this->getDoctrine()->getRepository('AppBundle:Projet');
        $projets = $projetRepo->findAll();

        return $projets;
    }

    public function getRecommandations() {
        $recommandationRepo = $this->getDoctrine()->getRepository('AppBundle:Recommandation');
        $recommandations = $recommandationRepo->findAll();

        return $recommandations;
    }

    public function getPublications() {
        $publicationRepo = $this->getDoctrine()->getRepository('AppBundle:Publication');
        $publications = $publicationRepo->findAll();

        return $publications;
    }

    public function getEfolioAction() {
        $formations = $this->getFormations();
        $experiences = $this->getExperiences();
        $competences = $this->getCompetences();
        $projets = $this->getProjets();
        $recommandations = $this->getRecommandations();
        $publications = $this->getPublications();

        return $this->render('AppBundle::efolio.html.twig',
            array('formations' => $formations,
                'experiences' => $experiences,
                'competences' => $competences,
                'publications' => $publications,
                'projets' => $projets,
                'recommandations' => $recommandations));
    }
}