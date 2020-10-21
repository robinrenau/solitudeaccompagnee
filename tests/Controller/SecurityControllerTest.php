<?php

namespace App\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLoginWithBadCredentials(){
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Se connecter')->form([
            'email' => 'johndoe@gmail.com',
            'password' => '12345678']);
        $client->submit($form);
        $this->assertResponseRedirects('/login');
        $client->followRedirect();
        $this->assertSelectorExists('.alert.alert-danger');

    }
    public function testSuccessfullLogin(){
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Se connecter')->form([
            'email' => 'robinrenau@gmail.com',
            'password' => 'cè§eéfqb']);
        $client->submit($form);
        $this->assertResponseRedirects('/home');
    }
}
