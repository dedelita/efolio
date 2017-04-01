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

class FormationsController extends Controller
{
    public function indexAction()
    {
        $formations = $this->forward('AppBundle:Folio:getFormations');
        $formations = unserialize($formations->getContent());

        return $this->render("AdminBundle::formations.html.twig", array("formations" => $formations));
    }

    private function getInfoFormation(Request $request) {
        $id = $request->get("id");
        $formation = $request->get('formation');
        $annees = $request->get('annees');
        $etablissement = $request->get('etablissement');
        $ville = $request->get('ville');

        return array("id" => $id, "formation" => $formation, "annees" => $annees, "etablissement" => $etablissement, "ville" => $ville);
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
        $id_user = unserialize($session->get('user'))->getId();
        $formation = $this->getInfoFormation($request);

        $em = $this->getDoctrine()->getManager();

        $new_formation = new Formation($formation["formation"], $formation["annees"], $formation["etablissement"], $formation["ville"], $id_user);

        $em->persist($new_formation);
        $em->flush();

        return $this->redirect($this->generateUrl("admin_formations"));
    }

}