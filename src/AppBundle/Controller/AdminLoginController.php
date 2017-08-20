<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Job;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class AdminLoginController extends \Symfony\Bundle\FrameworkBundle\Controller\Controller {

    /**
     * @Route("/fb/login")
     */
    public function facebookLogin() {

        $fb = new \Facebook\Facebook([
            'app_id' => '267662150414301',
            'app_secret' => '0118b0232a317a4fd5b7c341a53d30be']);

        $helper = $fb->getRedirectLoginHelper(); // to set redirection url

        $permissions = ['email']; // set required permissions to user details

        $loginUrl = $helper->getLoginUrl('http://localhost:8000/fbcheck', $permissions);

        echo '<a href = "' . $loginUrl . '">Log in with Facebook!</a>';
        die;
    }

    /**
     * @Route("/fbcheck")
     */
    public function login() {

        $fb = new \Facebook\Facebook([
            'app_id' => '267662150414301',
            'app_secret' => '0118b0232a317a4fd5b7c341a53d30be']);

        $helper = $fb->getRedirectLoginHelper(); // to perform operation after redirection
        try {
            $accessToken = $helper->getAccessToken(); // to fetch access token
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        if (!isset($accessToken)) {// checks whether access token is in there or not
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }
        try {
            $response = $fb->get('/me?fields=id,name', $accessToken->getValue());
        } catch (Facebook\Exceptions\FacebookResponseException $e) {// throws an error if invalid fields are specified
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        $user = $response->getGraphUser(); // to get user details
        echo 'Name: ' . $user['name'];
        die;
    }

}
