<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Publication;
use AppBundle\Entity\Recommandation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Formation;
use AppBundle\Entity\Competence;
use AppBundle\Entity\Experience;

class FolioController extends Controller
{
    public function indexAction() {
        return $this->render('AdminBundle::efolio.html.twig');
    }
    
    public function addExperienceAction(Request $request) {
        $exp = $request->get('experience');
        $annees = $request->get('annees');
        $id_user = 1;


        $em = $this->getDoctrine()->getManager();

        $experience = new Experience($exp, $annees, $id_user);
        $em->persist($experience);
        $em->flush();

        return new Response(true);
    }

    public function addCompetenceAction(Request $request) {
        $comp = $request->get('competence');
        $id_user = 1;


        $em = $this->getDoctrine()->getManager();

        $competence = new Competence($comp, $id_user);
        $em->persist($competence);
        $em->flush();

        return new Response(true);
    }

    public function addProjetAction(Request $request) {
        $nom = $request->get('nom');
        $description = $request->get('description');
        $annee = $request->get('annee');
        $id_user = 1;


        $em = $this->getDoctrine()->getManager();

        $projet = new Projet($nom, $description, $annee, $id_user);
        $em->persist($projet);
        $em->flush();

        return new Response(true);
    }

    public function addPublicationAction(Request $request) {
        $titre = $request->get('titre');
        $contenu = $request->get('contenu');
        $id_user = 1;


        $em = $this->getDoctrine()->getManager();

        $publication = new Publication($titre, $contenu, $id_user);
        $em->persist($publication);
        $em->flush();

        return new Response(true);
    }

    public function addRecommandationAction(Request $request) {
        $session = $request->getSession();
        $id_user = $session->get('id');
        
        $personne = $request->get('personne');
        $entreprise = $request->get('entreprise');
        $contenu = $request->get('contenu');


        $em = $this->getDoctrine()->getManager();

        $recommandation = new Recommandation($personne, $entreprise, $contenu, $id_user);
        $em->persist($recommandation);
        $em->flush();

        return new Response(true);
    }

}