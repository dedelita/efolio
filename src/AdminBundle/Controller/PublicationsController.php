<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Publication;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PublicationsController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $publications = $session->get("publications");
        $publications = unserialize($publications);

        return $this->render("AdminBundle::publications.html.twig", array("publications" => $publications));
    }

    private function getInfoPublication(Request $request) {
        return array("id" => $request->get("id"), "titre" => $request->get('titre'),
            "publication" => $request->get('publication'));
    }

    public function setPublicationAction(Request $request)
    {
        $action = $request->get("action");

        $info = $this->getInfoPublication($request);

        $publicationRepo = $this->getDoctrine()->getRepository('AppBundle:Publication');
        $publication = $publicationRepo->find($info["id"]);

        if ($action == "Modifier") {
            $em = $this->getDoctrine()->getManager();
            
            $publication->setTitre($info["titre"]);
            $publication->setPublication($info["publication"]);

            $em->flush();
        } else {
            $em = $this->getDoctrine()->getManager();
            $em->remove($publication);
            $em->flush();
        }

        $this->updatePublications($request);
        
        return $this->redirect($this->generateUrl("admin_publications"));
    }

    public function addPublicationAction(Request $request)
    {
        $session = $request->getSession();
        $id_user = $session->get('id');
        $publication = $this->getInfoPublication($request);

        $em = $this->getDoctrine()->getManager();

        $new_publication = new Publication($publication["titre"], $publication["publication"], $id_user);

        $em->persist($new_publication);
        $em->flush();

        $this->updatePublications($request);

        return $this->redirect($this->generateUrl("admin_publications"));
    }

    private function updatePublications(Request $request)
    {
        $session = $request->getSession();
        $publications = $this->forward('AppBundle:Folio:getPublications', array("idUser" => $session->get("id")));

        $session->set("publications", $publications->getContent());
    }
}