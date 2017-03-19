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

    public function getEfolioAction() {
        $formations = $this->getFormations();
        $experiences = $this->getExperiences();
        $competences = $this->getCompetences();

        return $this->render('AppBundle::efolio.html.twig',
            array('formations' => $formations,
                'experiences' => $experiences,
                'competences' => $competences));
    }
}