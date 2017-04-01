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
        $niveau = $request->get('niveau');
        $logo = $request->files->get("logo");

        return array("id" => $id, "competence" => $competence, "niveau" => $niveau, "logo" => $logo);
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
            $competence->setNiveau($info["niveau"]);

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

        $upload_dir = $this->container->getParameter('upload_dir');

            $logo = $competence["logo"]->getClientOriginalName();
            $competence["logo"]->move($upload_dir, $logo);

        
        $em = $this->getDoctrine()->getManager();

        $new_competence = new Competence($competence["competence"], $logo, $competence["niveau"], $id_user);

        $em->persist($new_competence);
        $em->flush();

        return $this->redirect($this->generateUrl("admin_competences"));
           }
}