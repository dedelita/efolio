<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FolioController extends Controller
{
    //Formations
    public function getFormationsAction() {
        $formationRepo = $this->getDoctrine()->getRepository('AppBundle:Formation');
        $formations = $formationRepo->findAll();

        return new Response(serialize($formations));
    }

    private function getFormations() {
        return unserialize($this->getFormationsAction()->getContent());
    }


    //Experiences
    public function getExperiencesAction() {
        $experienceRepo = $this->getDoctrine()->getRepository('AppBundle:Experience');
        $experiences = $experienceRepo->findAll();

        return new Response(serialize($experiences));
    }

    private function getExperiences() {
        return unserialize($this->getExperiencesAction()->getContent());
    }


    //Competences
    public function getCompetencesAction() {
        $competenceRepo = $this->getDoctrine()->getRepository('AppBundle:Competence');
        $competences = $competenceRepo->findAll();

        return new Response(serialize($competences));
    }

    private function getCompetences() {
        return unserialize($this->getCompetencesAction()->getContent());
    }


    //Projets
    public function getProjetsAction() {
        $projetRepo = $this->getDoctrine()->getRepository('AppBundle:Projet');
        $projets = $projetRepo->findAll();

        return new Response(serialize($projets));
    }

    private function getProjets() {
        return unserialize($this->getProjetsAction()->getContent());
    }


    //Recommandation
    public function getRecommandationsAction() {
        $recommandationRepo = $this->getDoctrine()->getRepository('AppBundle:Recommandation');
        $recommandations = $recommandationRepo->findAll();

        return new Response(serialize($recommandations));
    }

    private function getRecommandations() {
        return unserialize($this->getRecommandationsAction()->getContent());
    }


    //Publications
    public function getPublicationsAction() {
        $publicationRepo = $this->getDoctrine()->getRepository('AppBundle:Publication');
        $publications = $publicationRepo->findAll();

        return new Response(serialize($publications));
    }

    private function getPublications() {
        return unserialize($this->getPublicationsAction()->getContent());
    }


    public function getContact()
    {
        $form = $this->createFormBuilder()
            ->add('email', EmailType::class, array('label' => "Votre adresse mail"))
            ->add('titre', TextType::class, array('label' => "Votre objet"))
            ->add('msg', TextareaType::class, array('label' => false, 'attr' => array('rows' => 15, 'cols' => 75)))
            ->add('Envoyer', SubmitType::class)
            ->getForm();

        return $form->createView();
    }

    //EFolio
    public function getEfolioAction() {
        $formations = $this->getFormations();
        $experiences = $this->getExperiences();
        $competences = $this->getCompetences();
        $projets = $this->getProjets();
        $recommandations = $this->getRecommandations();
        $publications = $this->getPublications();
        $contact = $this->getContact();

        return $this->render('AppBundle::efolio.html.twig',
            array('formations' => $formations,
                'experiences' => $experiences,
                'competences' => $competences,
                'publications' => $publications,
                'projets' => $projets,
                'recommandations' => $recommandations,
                'contact' => $contact));
    }
}