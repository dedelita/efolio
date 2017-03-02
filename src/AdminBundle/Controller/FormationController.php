<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Formation;

class FormationController extends Controller
{
    public function addFormationAction(Request $request) {
        $name = $request->get('name');
        $years = $request->get('years');
        $institute = $request->get('institute');


        $em = $this->getDoctrine()->getManager();

        $formation = new Formation($name, $years, $institute);
        $em->persist($formation);
        $em->flush();

        return new Response(true);
    }

}