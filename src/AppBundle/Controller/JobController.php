<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Job;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class JobController extends Controller {

    /**
     * @Route("/job/number")
     */
    public function numberAction() {
        $number = mt_rand(0, 100);

        return $this->render('job/job.html.twig', array(
                    'number' => $number,
        ));
    }

    /**
     * @Route("/create/job")
     */
    public function createAction() {
        $em = $this->getDoctrine()->getManager();

        $job = new Job();
        $job->setName("Awesome opportunity with India's Leading E-Commerce company - Flipkart");
        $job->setDescription('Random description....');
        $job->setExperience("7-10 years");
        $job->setLocation("Bengaluru");
        $job->setSalary("Best in Industry");
        $job->setDatetime(new \DateTime("now"));

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($job);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return new Response('Saved new job with id ' . $job->getId());
    }

    public function editAction() {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
    }

}
