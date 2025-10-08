<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $rencontre = new Category();
        $rencontre ->setLabel("Rencontre");
        $rencontre->setPicture("rencontre.jpg");
        $rencontre->setHeaderphoto("largerencontre.jpg");
        $manager->persist($rencontre);
        $this->addReference("cat-renc", $rencontre);

        $voyage = new Category();
        $voyage ->setLabel("Voyage");
        $voyage->setPicture("voyage.jpg");
        $voyage->setHeaderphoto("largevoyage.jpg");
        $manager->persist($voyage);
        $this->addReference("cat-voy", $voyage);

        $loisir = new Category();
        $loisir ->setLabel("Loisirs");
        $loisir->setHeaderphoto("largeloisir.jpg");
        $loisir->setPicture("loisir.jpg");
        $manager->persist($loisir);
        $this->addReference("cat-loisir", $loisir);

        $atelier = new Category();
        $atelier ->setLabel("Atelier");
        $atelier->setHeaderphoto("largeatelier.jpg");
        $atelier->setPicture("atelier.jpg");
        $manager->persist($atelier);
        $this->addReference("cat-atelier", $atelier);

        $manager->flush();
    }
}
