<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ActivityFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $couture = new Activity();
        $couture->setUser($this->getReference("user-bloulin"));
        $couture->setTitle("Après-midi couture");
        $couture->setCity($this->getReference("city-vitre"));
        $couture->setCreatedAt(new \DateTime('04/10/2020'));
        $couture ->setEventdate(new \DateTime('08/10/2020 13:00:00'));
        $couture->setDescription("Venez passer avec moi une petite après midi couture. Au programme, petit café en debut d'après midi puis atelier couture avec initiation pour les débutants ! ");
        $couture->setCategory($this->getReference("cat-atelier"));
        $couture->setAddress("12 rue des lilas, 35500 VITRE");

        $manager->persist($couture);

        $this->addReference("act-couture", $couture);

        $palet = new Activity();
        $palet->setUser($this->getReference("user-mmartin"));
        $palet->setTitle("Tournoi de palets breton");
        $palet->setCity($this->getReference("city-fougeres"));
        $palet->setCreatedAt(new \DateTime('04/10/2020'));
        $palet ->setEventdate(new \DateTime('08/10/2020 13:00:00'));
        $palet->setDescription("J'organise chez moi un petit tournoi de palets ce samedi ! ");
        $palet->setCategory($this->getReference("cat-loisir"));
        $palet->setAddress("14 bis lotissement des roseaux, 35300 FOUGERES");

        $manager->persist($palet);

        $this->addReference("act-palet", $palet);

        $rencontre = new Activity();
        $rencontre->setUser($this->getReference("user-jdupont"));
        $rencontre->setTitle("Matinée discussion et débat");
        $rencontre->setCity($this->getReference("city-redon"));
        $rencontre->setCreatedAt(new \DateTime('04/10/2020'));
        $rencontre ->setEventdate(new \DateTime('08/10/2020 08:00:00'));
        $rencontre->setDescription("Bonjour. Ce samedi, j'organise à la salle de la commune de Redon, une petite matinée discussion, debat ou encore rencontre pour échanger sur nos déboires de tout les jours, mais aussi pour ceux qui peuvent se sentir seul au quotidien !  ");
        $rencontre->setCategory($this->getReference("cat-renc"));
        $rencontre ->setAddress("Maison des fêtes, 9 rue de Galerne, 35600 REDON");

        $manager->persist($rencontre);

        $this->addReference("act-rencontre", $rencontre);


        $manager->flush();

    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return[
            UserFixtures::class,
            CategoryFixtures::class,
            CityFixtures::class,
        ];
    }
}
