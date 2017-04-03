<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Experience;

class ExperiencesController extends Controller
{
    public function indexAction()
    {
        $experiences = $this->forward('AppBundle:Folio:getExperiences');
        $experiences = unserialize($experiences->getContent());

        return $this->render("AdminBundle::experiences.html.twig", array("experiences" => $experiences));
    }

    private function getInfoExperience(Request $request) {
        return array("id" => $request->get("id"), "experience" => $request->get('experience'),
            "periode" => $request->get('periode'), "entreprise" => $request->get('entreprise'));
    }

    public function setExperienceAction(Request $request)
    {
        $action = $request->get("action");

        $info = $this->getInfoExperience($request);

        $experienceRepo = $this->getDoctrine()->getRepository('AppBundle:Experience');
        $experience = $experienceRepo->find($info["id"]);

        if ($action == "Modifier") {
            $em = $this->getDoctrine()->getManager();
            
            $experience->setExperience($info["experience"]);
            $experience->setPeriode($info["periode"]);
            $experience->setEntreprise($info["entreprise"]);

            $em->flush();
        } else {
            $em = $this->getDoctrine()->getManager();
            $em->remove($experience);
            $em->flush();
        }

        return $this->redirect($this->generateUrl("admin_experiences"));
    }

    public function addExperienceAction(Request $request)
    {
        $session = $request->getSession();
        $id_user = $session->get('id');
        $experience = $this->getInfoExperience($request);

        $em = $this->getDoctrine()->getManager();

        $new_experience = new Experience($experience["experience"], $experience["periode"], $experience["entreprise"], $id_user);

        $em->persist($new_experience);
        $em->flush();

        return $this->redirect($this->generateUrl("admin_experiences"));
    }

}