<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Competence;

class CompetencesController extends Controller
{
    public function indexAction()
    {
        $competences = $this->forward('AppBundle:Folio:getCompetences');
        $competences = unserialize($competences->getContent());

        return $this->render("AdminBundle::competences.html.twig", array("competences" => $competences));
    }

    private function getInfoCompetence(Request $request) {
        $id = $request->get("id");
        $competence = $request->get('competence');
        $details = $request->get('details');

        return array("id" => $id, "competence" => $competence, "details" => $details);
    }

    public function setCompetenceAction(Request $request)
    {
        $action = $request->get("action");

        $info = $this->getInfoCompetence($request);

        $competenceRepo = $this->getDoctrine()->getRepository('AppBundle:Competence');
        $competence = $competenceRepo->find($info["id"]);

        if ($action == "Modifier") {
            $em = $this->getDoctrine()->getManager();

            $competence->setCompetence($info["competence"]);
            $competence->setDetails($info["details"]);

            $em->flush();
        } else {
            $em = $this->getDoctrine()->getManager();
            $em->remove($competence);
            $em->flush();
        }

        return $this->redirect($this->generateUrl("admin_competences"));
    }

    public function addCompetenceAction(Request $request)
    {
        $session = $request->getSession();
        $id_user = unserialize($session->get('user'))->getId();
        $competence = $this->getInfoCompetence($request);

        $em = $this->getDoctrine()->getManager();

        $new_competence = new Competence($competence["competence"], $competence["details"], $id_user);

        $em->persist($new_competence);
        $em->flush();

        return $this->redirect($this->generateUrl("admin_competences"));
    }
}