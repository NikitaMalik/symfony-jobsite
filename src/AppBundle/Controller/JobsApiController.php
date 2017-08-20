<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Job;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

class JobsApiController extends FOSRestController {

    /**
     * @Rest\Get("/jobs")
     */
    public function getAction() {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Job')->findAll();
        if ($restresult === null) {
            return new View("there are no jobs exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

}
