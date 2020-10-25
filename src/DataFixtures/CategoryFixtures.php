<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $rencontre = new Category();
        $rencontre ->setLabel("Rencontre");
        $rencontre->setPicture("rencontre.jpg");
        $manager->persist($rencontre);
        $this->addReference("cat-renc", $rencontre);

        $voyage = new Category();
        $voyage ->setLabel("Voyage");
        $voyage->setPicture("voyage.jpg");
        $manager->persist($voyage);
        $this->addReference("cat-voy", $voyage);

        $activitenature = new Category();
        $activitenature ->setLabel("Activité nature");
        $activitenature->setPicture("activitenature.jpg");
        $manager->persist($activitenature);
        $this->addReference("cat-actnat", $activitenature);

        $loisir = new Category();
        $loisir ->setLabel("Loisirs");
        $loisir->setPicture("loisir.jpg");
        $manager->persist($loisir);
        $this->addReference("cat-loisir", $loisir);

        $atelier = new Category();
        $atelier ->setLabel("Atelier");
        $atelier->setPicture("atelier.jpg");
        $manager->persist($atelier);
        $this->addReference("cat-atelier", $atelier);

        $manager->flush();
    }
}
