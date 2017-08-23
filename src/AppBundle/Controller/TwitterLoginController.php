<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Job;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class TwitterLoginController extends Controller {

    /**
     * @Route("/twitter/login")
     */
    public function singInViaTwitter() {
        return new Response('welcome to twitter login .... ');
    }
}
