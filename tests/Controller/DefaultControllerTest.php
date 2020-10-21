<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DefaultControllerTest extends WebTestCase
{
    public function testHomePageIsRestricted(){
        $client = static::createClient();
        $client->request('GET', '/home');
        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    public function testRedirectToLogin(){
        $client = static::createClient();
        $client->request('GET', '/home');
        $this->assertResponseRedirects('/login');

    }
}
