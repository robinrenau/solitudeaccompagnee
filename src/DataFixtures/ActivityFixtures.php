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
        $couture->setMaxParticipants(10);
        $couture->setTitle("Après-midi couture");
        $couture->setCity($this->getReference("city-vitre"));
        $couture->setCreatedAt(new \DateTime('04/10/2020'));
        $couture ->setEventdate(new \DateTime('10/30/2020 13:00:00'));
        $couture->setDescription("Venez passer avec moi une petite après midi couture. Au programme, petit café en debut d'après midi puis atelier couture avec initiation pour les débutants ! ");
        $couture->setCategory($this->getReference("cat-atelier"));
        $couture->setAddress("12 rue des lilas, 35500 VITRE");

        $manager->persist($couture);

        $this->addReference("act-couture", $couture);

        $palet = new Activity();
        $palet->setUser($this->getReference("user-mmartin"));
        $palet->setMaxParticipants(3);
        $palet->setTitle("Tournoi de palets breton");
        $palet->setCity($this->getReference("city-fougeres"));
        $palet->setCreatedAt(new \DateTime('04/10/2020'));
        $palet ->setEventdate(new \DateTime('11/02/2020 13:00:00'));
        $palet->setDescription("J'organise chez moi un petit tournoi de palets ce samedi ! ");
        $palet->setCategory($this->getReference("cat-loisir"));
        $palet->setAddress("14 bis lotissement des roseaux, 35300 FOUGERES");

        $manager->persist($palet);

        $this->addReference("act-palet", $palet);

        $rencontre = new Activity();
        $rencontre->setUser($this->getReference("user-jdupont"));
        $rencontre->setMaxParticipants(14);
        $rencontre->setTitle("Matinée discussion et débat");
        $rencontre->setCity($this->getReference("city-redon"));
        $rencontre->setCreatedAt(new \DateTime('04/10/2020'));
        $rencontre ->setEventdate(new \DateTime('11/10/2020 08:00:00'));
        $rencontre->setDescription("Bonjour. Ce samedi, j'organise à la salle de la commune de Redon, une petite matinée discussion, debat ou encore rencontre pour échanger sur nos déboires de tout les jours, mais aussi pour ceux qui peuvent se sentir seul au quotidien !  ");
        $rencontre->setCategory($this->getReference("cat-renc"));
        $rencontre ->setAddress("Maison des fêtes, 9 rue de Galerne, 35600 REDON");

        $manager->persist($rencontre);

        $this->addReference("act-rencontre", $rencontre);

        $footing = new Activity();
        $footing->setUser($this->getReference("user-jdupont"));
        $footing->setMaxParticipants(7);
        $footing->setTitle("Footing tranquille au parc Bréquigny");
        $footing->setCity($this->getReference("city-rennes"));
        $footing->setCreatedAt(new \DateTime('04/10/2020'));
        $footing ->setEventdate(new \DateTime('11/16/2020 08:00:00'));
        $footing->setDescription("Bonjour. Jeudi prochain, j'organise un petit footing tranquille au parc de Bréquign pour les amateurs de sport :) ");
        $footing->setCategory($this->getReference("cat-loisir"));
        $footing ->setAddress("Rue d'Angleterre, 35200 RENNES");

        $manager->persist($footing);

        $this->addReference("act-footing", $footing);

        $lithotherapie = new Activity();
        $lithotherapie->setUser($this->getReference("user-bloulin"));
        $lithotherapie->setMaxParticipants(10);
        $lithotherapie->setTitle("Découverte de la lithotherapie ");
        $lithotherapie->setCity($this->getReference("city-vitre"));
        $lithotherapie->setCreatedAt(new \DateTime('04/10/2020'));
        $lithotherapie ->setEventdate(new \DateTime('11/03/2020 13:00:00'));
        $lithotherapie->setDescription("Atelier pour la découverte de soi et pour confectionner le bracelet qui vous ressemble et qui vous accompagnera  ");
        $lithotherapie->setCategory($this->getReference("cat-atelier"));
        $lithotherapie ->setAddress("12 rue des lilas, 35500 VITRE");

        $manager->persist($lithotherapie);

        $this->addReference("act-lithotherapie", $lithotherapie);


        $theatre = new Activity();
        $theatre->setUser($this->getReference("user-mmartin"));
        $theatre->setMaxParticipants(6);
        $theatre->setTitle("Pièce de theatre");
        $theatre->setCity($this->getReference("city-rennes"));
        $theatre->setCreatedAt(new \DateTime('04/10/2020'));
        $theatre ->setEventdate(new \DateTime('11/09/2020 20:00:00'));
        $theatre->setDescription("Venez partager avec moi une pièce de theatre, la comédie 'Bonsoir Madame Pinson'. rendz-vous devant le theatre de Rennes dimanche prochain !  ");
        $theatre->setCategory($this->getReference("cat-loisir"));
        $theatre ->setAddress("1 Rue Saint-Hélier, 35000 RENNES");

        $manager->persist($theatre);

        $this->addReference("act-theatre", $theatre);


        $rencontre2 = new Activity();
        $rencontre2->setUser($this->getReference("user-jdupont"));
        $rencontre2->setMaxParticipants(9);
        $rencontre2->setTitle("Petit verre du lundi");
        $rencontre2->setCity($this->getReference("city-redon"));
        $rencontre2->setCreatedAt(new \DateTime('04/10/2020'));
        $rencontre2 ->setEventdate(new \DateTime('11/05/2020 20:00:00'));
        $rencontre2->setDescription("Pourquoi ne pas commencer la semaine par venir boire un verre, histoire de se détendre de la plus dure journée de la semaine, mais aussi de parler du week-end écoulé.Pour rappel, prenez bien votre masque (obligatoire dans Rennes).
La sortie pourra évoluer selon les règles sanitaires demandées.  ");
        $rencontre2->setCategory($this->getReference("cat-renc"));
        $rencontre2 ->setAddress("10 Rue des Douves, 35600 REDON");

        $manager->persist($rencontre2);

        $this->addReference("act-rencontre2", $rencontre2);



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
