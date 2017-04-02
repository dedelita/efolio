<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Publication;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PublicationsController extends Controller
{
    public function indexAction()
    {
        $publications = $this->forward('AppBundle:Folio:getPublications');
        $publications = unserialize($publications->getContent());

        return $this->render("AdminBundle::publications.html.twig", array("publications" => $publications));
    }

    private function getInfoPublication(Request $request) {
        $id = $request->get("id");
        $titre = $request->get('titre');
        $publication = $request->get('publication');

        return array("id" => $id, "titre" => $titre, "publication" => $publication);
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

        return $this->redirect($this->generateUrl("admin_publications"));
    }

}