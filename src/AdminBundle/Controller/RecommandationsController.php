<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Recommandation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RecommandationsController extends Controller
{
    public function indexAction()
    {
        $recommandations = $this->forward('AppBundle:Folio:getRecommandations');
        $recommandations = unserialize($recommandations->getContent());

        return $this->render("AdminBundle::recommandations.html.twig", array("recommandations" => $recommandations));
    }

    private function getInfoRecommandation(Request $request) {
        $id = $request->get("id");
        $recommandation = $request->get('recommandation');
        $entreprise = $request->get('entreprise');
        $personne = $request->get('personne');

        return array("id" => $id, "recommandation" => $recommandation, "entreprise" => $entreprise, "personne" => $personne);
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

        return $this->redirect($this->generateUrl("admin_recommandations"));
    }

    public function addRecommandationAction(Request $request)
    {
        $session = $request->getSession();
        $id_user = unserialize($session->get('user'))->getId();
        $recommandation = $this->getInfoRecommandation($request);

        $em = $this->getDoctrine()->getManager();

        $new_recommandation = new Recommandation( $recommandation["personne"], $recommandation["entreprise"], $recommandation["recommandation"], $id_user);

        $em->persist($new_recommandation);
        $em->flush();

        return $this->redirect($this->generateUrl("admin_recommandations"));
    }

}