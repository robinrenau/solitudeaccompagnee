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
        $rencontre ->setLabel("rencontre");
        $rencontre->setPicture("rencontre.jpg");
        $manager->persist($rencontre);
        $this->addReference("cat-renc", $rencontre);

        $loisir = new Category();
        $loisir ->setLabel("Loisir");
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
