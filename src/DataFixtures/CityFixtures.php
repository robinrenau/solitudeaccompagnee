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
        $vitre->setName("vitre");
        $vitre->setLabel("Vitré");
        $vitre->setPicture("vitre.jpg");
        $vitre->setLat(48.1244503);
        $vitre->setLng(-1.214331);
        $manager->persist($vitre);
        $this->addReference("city-vitre", $vitre);

        $rennes = new City();
        $rennes->setName("rennes");
        $rennes->setLabel("Rennes");
        $rennes->setPicture("rennes.jpg");
        $rennes->setLat(48.1113387);
        $rennes->setLng(-1.6800198);
        $manager->persist($rennes);
        $this->addReference("city-rennes", $rennes);

        $fougeres = new City();
        $fougeres->setName("fougeres");
        $fougeres->setLabel("Fougères");
        $fougeres->setPicture("fougeres.jpg");
        $fougeres->setLat(48.3503362);
        $fougeres->setLng(-1.1958526);
        $manager->persist($fougeres);
        $this->addReference("city-fougeres", $fougeres);

        $redon = new City();
        $redon->setName("redon");
        $redon->setLabel("Redon");
        $redon->setPicture("redon.jpg");
        $redon->setLat(47.6510682);
        $redon->setLng(-2.0842143);
        $manager->persist($redon);
        $this->addReference("city-redon", $redon);

        $manager->flush();
    }
}
