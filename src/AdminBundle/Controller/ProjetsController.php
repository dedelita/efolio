<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Projet;

class ProjetsController extends Controller
{
    public function indexAction()
    {
        $projets = $this->forward('AppBundle:Folio:getProjets');
        $projets = unserialize($projets->getContent());

        return $this->render("AdminBundle::projets.html.twig", array("projets" => $projets));
    }

    private function getInfoProjet(Request $request)
    {
        return array("id" => $request->get("id"), "projet" => $request->get('projet'),
            "annee" => $request->get('annee'), "description" => $request->get('description'));
    }

    public function setProjetAction(Request $request)
    {
        $action = $request->get("action");

        $info = $this->getInfoProjet($request);

        $projetRepo = $this->getDoctrine()->getRepository('AppBundle:Projet');
        $projet = $projetRepo->find($info["id"]);

        if ($action == "Modifier") {
            $em = $this->getDoctrine()->getManager();


            $projet->setProjet($info["projet"]);
            $projet->setAnnees($info["annee"]);
            $projet->setDescription($info["description"]);

            $em->flush();
        } else {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projet);
            $em->flush();
        }

        return $this->redirect($this->generateUrl("admin_projets"));
    }

    public function addProjetAction(Request $request)
    {
        $session = $request->getSession();
        $id_user = $session->get('id');
        $projet = $this->getInfoProjet($request);

        $em = $this->getDoctrine()->getManager();

        $new_projet = new Projet($projet["projet"], $projet["annee"], $projet["description"], $id_user);

        $em->persist($new_projet);
        $em->flush();

        return $this->redirect($this->generateUrl("admin_projets"));
    }

}