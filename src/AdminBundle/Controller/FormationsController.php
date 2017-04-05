<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Formation;

class FormationsController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $formations = $session->get("formations");
        $formations = unserialize($formations->getContent());

        return $this->render("AdminBundle::formations.html.twig", array("formations" => $formations));
    }

    private function getInfoFormation(Request $request) {
        return array("id" => $request->get("id"), "formation" => $request->get('formation'),
            "annees" => $request->get('annees'), "etablissement" => $request->get('etablissement'),
            "ville" => $request->get('ville'));
    }

    public function setFormationAction(Request $request)
    {
        $action = $request->get("action");

        $info = $this->getInfoFormation($request);

        $formationRepo = $this->getDoctrine()->getRepository('AppBundle:Formation');
        $formation = $formationRepo->find($info["id"]);

        if ($action == "Modifier") {
            $em = $this->getDoctrine()->getManager();


            $formation->setFormation($info["formation"]);
            $formation->setAnnees($info["annees"]);
            $formation->setEtablissement($info["etablissement"]);
            $formation->setVille($info["ville"]);

            $em->flush();
        } else {
            $em = $this->getDoctrine()->getManager();
            $em->remove($formation);
            $em->flush();
        }

        return $this->redirect($this->generateUrl("admin_formations"));
    }

    public function addFormationAction(Request $request)
    {
        $session = $request->getSession();
        $id_user = $session->get('id');
        $formation = $this->getInfoFormation($request);

        $em = $this->getDoctrine()->getManager();

        $new_formation = new Formation($formation["formation"], $formation["annees"], $formation["etablissement"], $formation["ville"], $id_user);

        $em->persist($new_formation);
        $em->flush();

        return $this->redirect($this->generateUrl("admin_formations"));
    }

}