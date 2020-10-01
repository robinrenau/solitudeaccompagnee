<?php

namespace App\DataFixtures;

use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $vitre = new City();
        $vitre->setName("Vitré");
        $vitre->setPicture("vitre.jpg");
        $manager->persist($vitre);
        $this->addReference("city-vitre", $vitre);

        $rennes = new City();
        $rennes->setName("Rennes");
        $rennes->setPicture("rennes.jpg");
        $manager->persist($rennes);
        $this->addReference("city-rennes", $rennes);

        $fougeres = new City();
        $fougeres->setName("Fougères");
        $fougeres->setPicture("fougeres.jpg");
        $manager->persist($fougeres);
        $this->addReference("city-fougeres", $fougeres);

        $redon = new City();
        $redon->setName("Redon");
        $redon->setPicture("redon.jpg");
        $manager->persist($redon);
        $this->addReference("city-redon", $redon);

        $manager->flush();
    }
}
