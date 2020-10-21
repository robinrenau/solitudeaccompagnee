<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ActivityControllerTest extends WebTestCase
{
    public function testSendActivityWithInvalidEventDate(){

        $client = static::createClient();
        $crawler = $client ->request('GET', '/activity/new');
        $form = $crawler->selectButton("Créer l'activité")->form([
            'activity[title]'=>'test titre activité',
            'activity[description]'=>'test description activité',
            'activity[eventdate]' => '1981-08-28T04:31:00',
            'activity[address]' => 'test adresse',
            'activity[city]' => 5,
            'activity[category]' => 6,
            'activity[maxParticipants]' => 4

        ]);
        $client->submit($form);
        $this->assertSelectorTextContains('.form-error-message', 'La date de l\'activité ne doit pas être dans le passé');
    }

}
