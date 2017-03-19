<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Formation;
use AppBundle\Entity\Competence;
use AppBundle\Entity\Experience;

class FolioController extends Controller
{
    public function indexAction() {
        return $this->render('AdminBundle::efolio.html.twig');
    }
    public function addFormationAction(Request $request) {
        $name = $request->get('name');
        $years = $request->get('years');
        $institute = $request->get('institute');
        $id_user = 1;


        $em = $this->getDoctrine()->getManager();

        $formation = new Formation($name, $years, $institute, $id_user);
        $em->persist($formation);
        $em->flush();

        return new Response(true);
    }

    public function addExperienceAction(Request $request) {
        $exp = $request->get('experience');
        $years = $request->get('years');
        $id_user = 1;


        $em = $this->getDoctrine()->getManager();

        $experience = new Experience($exp, $years, $id_user);
        $em->persist($experience);
        $em->flush();

        return new Response(true);
    }

    public function addCompetenceAction(Request $request) {
        $name = $request->get('name');
        $years = $request->get('years');
        $institute = $request->get('institute');


        $em = $this->getDoctrine()->getManager();

        $formation = new Competence($name, $years, $institute);
        $em->persist($formation);
        $em->flush();

        return new Response(true);
    }

}