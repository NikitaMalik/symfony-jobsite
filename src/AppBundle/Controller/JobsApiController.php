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
use Doctrine\ORM\EntityManagerInterface;

class JobsApiController extends FOSRestController {

    /**
     * @Rest\Get("/job")
     */
    public function getAction() {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Job')->findAll();
        if ($restresult === null) {
            return new View($this->apiResponse("there are no jobs exist", false), Response::HTTP_NOT_FOUND);
        }
        return $this->apiResponse($restresult);
    }

    /**
     * @Rest\Get("/job/{id}")
     */
    public function idAction($id) {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:Job')->find($id);
        if ($singleresult === null) {
            return new View($this->apiResponse("job not found", false), Response::HTTP_NOT_FOUND);
        }
        return $this->apiResponse($singleresult);
    }

    /**
     * @Rest\Post("/job")
     */
    public function postAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $name = $request->get("name");
        $desc = $request->get("description");
        $loct = $request->get("location");
        $expr = $request->get("experience");
        $salr = $request->get("salary");
        if (empty($name) || empty($desc) || empty($loct) || empty($expr) || empty($salr)) {
            return new View(
                    $this->apiResponse("null values are not allowed", false), Response::HTTP_NOT_ACCEPTABLE);
        }
        $data = new Job();
        $data->setName($name);
        $data->setDescription($desc);
        $data->setLocation($loct);
        $data->setExperience($expr);
        $data->setSalary($salr);
        $data->setDatetime(new \DateTime("now"));
        $em->persist($data);
        $em->flush();
        $response = array("jobId" => $data->getId(), "msg" => "Job Added Successfully");
        return new View($this->apiResponse($response), Response::HTTP_OK);
    }

    /**
     * @Rest\Put("/job/{id}")
     */
    public function updateAction($id, Request $request) {
        $job = new Job();

        $name = $request->get("name");
        $desc = $request->get("description");
        $loct = $request->get("location");
        $expr = $request->get("experience");
        $salr = $request->get("salary");

        $sn = $this->getDoctrine()->getManager();
        $job = $this->getDoctrine()->getRepository('AppBundle:Job')->find($id);

        if (empty($job)) {
            return new View($this->apiResponse("job not found", false), Response::HTTP_NOT_FOUND);
        }

        if (!empty($name)) {
            $job->setName($name);
        }
        if (!empty($desc)) {
            $job->setDescription($desc);
        }

        if (!empty($loct)) {
            $job->setLocation($loct);
        }

        if (!empty($salr)) {
            $job->setSalary($salr);
        }

        if (!empty($expr)) {
            $job->setExperience($expr);
        }

        $sn->flush();
        $response = array("jobId" => $job->getId(), "msg" => "Job updated successfully");
        return new View($this->apiResponse($response), Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("/job/{id}")
     */

    public function deleteAction($id) {
        
        $job = new Job();
        
        $sn = $this->getDoctrine()->getManager();
        $job = $this->getDoctrine()->getRepository('AppBundle:Job')->find($id);
        if (empty($job)) {
            return new View($this->apiResponse("job not found", false), Response::HTTP_NOT_FOUND);
        } else {
            $sn->remove($job);
            $sn->flush();
        }
        $response = array("jobId" => $job->getId(), "msg" => "Job deleted successfully");
        return new View($this->apiResponse($response), Response::HTTP_OK);
    }

    public function apiResponse($data, $status = true) {
        return array("status" => $status, "data" => $data);
    }

}
