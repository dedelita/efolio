<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Recommandation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RecommandationsController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $recommandations = $session->get("recommandations");
        $recommandations = unserialize($recommandations);

        return $this->render("AdminBundle::recommandations.html.twig", array("recommandations" => $recommandations));
    }

    private function getInfoRecommandation(Request $request)
    {
        return array("id" => $request->get("id"), "recommandation" => $request->get('recommandation'),
            "entreprise" => $request->get('entreprise'), "personne" => $request->get('personne'));
    }

    public function setRecommandationAction(Request $request)
    {
        $action = $request->get("action");

        $info = $this->getInfoRecommandation($request);

        $recommandationRepo = $this->getDoctrine()->getRepository('AppBundle:Recommandation');
        $recommandation = $recommandationRepo->find($info["id"]);

        if ($action == "Modifier") {
            $em = $this->getDoctrine()->getManager();


            $recommandation->setRecommandation($info["recommandation"]);
            $recommandation->setEntreprise($info["entreprise"]);
            $recommandation->setPersonne($info["personne"]);

            $em->flush();
        } else {
            $em = $this->getDoctrine()->getManager();
            $em->remove($recommandation);
            $em->flush();
        }

        $this->updateRecommandations($request);

        return $this->redirect($this->generateUrl("admin_recommandations"));
    }

    public function addRecommandationAction(Request $request)
    {
        $session = $request->getSession();
        $id_user = $session->get('id');
        $recommandation = $this->getInfoRecommandation($request);

        $em = $this->getDoctrine()->getManager();

        $new_recommandation = new Recommandation($recommandation["personne"], $recommandation["entreprise"], $recommandation["recommandation"], $id_user);

        $em->persist($new_recommandation);
        $em->flush();

        $this->updateRecommandations($request);

        return $this->redirect($this->generateUrl("admin_recommandations"));
    }

    private function updateRecommandations(Request $request)
    {
        $session = $request->getSession();
        $recommandations = $this->forward('AppBundle:Folio:getRecommandations', array("idUser" => $session->get("id")));

        $session->set("recommandations", $recommandations->getContent());
    }
}