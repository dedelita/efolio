<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Competence;

class CompetencesController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $competences = $session->get("competences");
        $competences = unserialize($competences->getContent());

        return $this->render("AdminBundle::competences.html.twig", array("competences" => $competences));
    }

    private function getInfoCompetence(Request $request)
    {
        return array("id" => $request->get("id"), "competence" => $request->get('competence'), "logo" => $request->files->get("logo"));
    }

    public function setCompetenceAction(Request $request)
    {
        $action = $request->get("action");

        $info = $this->getInfoCompetence($request);

        $competenceRepo = $this->getDoctrine()->getRepository('AppBundle:Competence');
        $competence = $competenceRepo->find($info["id"]);

        if ($action == "Modifier") {
            $em = $this->getDoctrine()->getManager();

            if ($info["logo"]) {
                $upload_dir = $this->container->getParameter('upload_dir');

                $name = $info["logo"]->getClientOriginalName();
                $info["logo"]->move($upload_dir, $name);

                $logo = $upload_dir . "/" . $name;
                $competence->setLogo($logo);
            }

            $competence->setCompetence($info["competence"]);

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
        $id_user = $session->get('id');
        $competence = $this->getInfoCompetence($request);

        $upload_dir = $this->container->getParameter('upload_dir');

        $name = $competence["logo"]->getClientOriginalName();
        $competence["logo"]->move($upload_dir, $name);

        $logo = $upload_dir . "/" . $name;
        $em = $this->getDoctrine()->getManager();

        $new_competence = new Competence($competence["competence"], $logo, $id_user);

        $em->persist($new_competence);
        $em->flush();

        return $this->redirect($this->generateUrl("admin_competences"));
    }
}