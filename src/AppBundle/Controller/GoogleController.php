<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GoogleController {

    /**
     * @Route("/go/login")
     */
    public function login() {
        $client = new \Google_Client();
        $client->setApplicationName("kaara-fankara"); // to set app name
        $client->setClientId("57749400293-juhufvujsv9c4ll9tgs8he5bemlk9806.apps.googleusercontent.com"); // to set app id or client id
        $client->setClientSecret("KYBz8oi9pjdNat5RAu4fv880"); // to set app secret or client secret
        $client->setRedirectUri("http://localhost:8000/"); // to set redirect uri
        $client->setHostedDomain("localhost"); // to set hosted domain (optional)
        $url = $client->createAuthUrl(); // to get login url
        echo '<a href = "' . $url . '">Log in with Google!</a>';
        die;
    }

}
