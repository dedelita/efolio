<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
        $formations = $formationRepo->findByIdUser(1);

        return new Response(serialize($formations));
    }

    public function getFormations() {
        return unserialize($this->getFormationsAction()->getContent());
    }


    //Experiences
    public function getExperiencesAction() {
        $experienceRepo = $this->getDoctrine()->getRepository('AppBundle:Experience');
        $experiences = $experienceRepo->findByIdUser(1);

        return new Response(serialize($experiences));
    }

    public function getExperiences() {
        return unserialize($this->getExperiencesAction()->getContent());
    }


    //Competences
    public function getCompetencesAction() {
        $competenceRepo = $this->getDoctrine()->getRepository('AppBundle:Competence');
        $competences = $competenceRepo->findByIdUser(1);

        return new Response(serialize($competences));
    }

    public function getCompetences() {
        return unserialize($this->getCompetencesAction()->getContent());
    }


    //Projets
    public function getProjetsAction() {
        $projetRepo = $this->getDoctrine()->getRepository('AppBundle:Projet');
        $projets = $projetRepo->findByIdUser(1);

        return new Response(serialize($projets));
    }

    public function getProjets() {
        return unserialize($this->getProjetsAction()->getContent());
    }


    //Recommandation
    public function getRecommandationsAction() {
        $recommandationRepo = $this->getDoctrine()->getRepository('AppBundle:Recommandation');
        $recommandations = $recommandationRepo->findByIdUser(1);

        return new Response(serialize($recommandations));
    }

    public function getRecommandations() {
        return unserialize($this->getRecommandationsAction()->getContent());
    }


    //Publications
    public function getPublicationsAction() {
        $publicationRepo = $this->getDoctrine()->getRepository('AppBundle:Publication');
        $publications = $publicationRepo->findByIdUser(1);

        return new Response(serialize($publications));
    }

    public function getPublications() {
        return unserialize($this->getPublicationsAction()->getContent());
    }

    //Contact
    public function getFormContact()
    {
        $form = $this->createFormBuilder()
            ->add('email', EmailType::class, array('label' => "Votre adresse mail"))
            ->add('objet', TextType::class, array('label' => "Votre objet"))
            ->add('msg', TextareaType::class, array('attr' => array('rows' => 15, 'cols' => 75)))
            ->add('Envoyer', SubmitType::class)
            ->getForm();

        return $form->createView();
    }

    public function sendMailAction(Request $request)
    {
        $session = $request->getSession();
        $to = $session->get("email");

        $form = $request->get("form");

        $message = \Swift_Message::newInstance()
            ->setSubject("[EPortfolio] " . $form["objet"])
            ->setFrom(array('mp.dedelita@gmail.com' => $form["email"]))
            ->setTo($to)
            ->setBody($form["msg"]);

        $this->get("mailer")->send($message);

        return $this->getEfolioAction();
    }

    public function getUserInfo() {
        $userRepo = $this->getDoctrine()->getRepository('AppBundle:User');
        return $userRepo->find(1);

    }

    //EFolio
    public function getEfolioAction() {
        $formations = $this->getFormations();
        $experiences = $this->getExperiences();
        $competences = $this->getCompetences();
        $projets = $this->getProjets();
        $recommandations = $this->getRecommandations();
        $publications = $this->getPublications();
        $contact = $this->getFormContact();
        $user = $this->getUserInfo();
        
        return $this->render('AppBundle::efolio.html.twig',
            array('formations' => $formations,
                'experiences' => $experiences,
                'competences' => $competences,
                'publications' => $publications,
                'projets' => $projets,
                'recommandations' => $recommandations,
                'contact' => $contact,
                'user' => $user));
    }
}