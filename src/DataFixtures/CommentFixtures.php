<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $comment1 = new Comment();
        $comment1->setTitle("Je serai bien présent !");
        $comment1->setUser($this->getReference("user-bloulin"));
        $comment1->setContent("Je suis très content de participer avec vous à ce tournoi même si mon niveau laisse à désirer .");
        $comment1->setActivity($this->getReference("act-palet"));
        $comment1->setCreatedAt(new \DateTime("2020-10-07 21:41:00"));
        $manager->persist($comment1);

        $comment2 = new Comment();
        $comment2->setTitle("Très bonne idée !");
        $comment2->setUser($this->getReference("user-jdupont"));
        $comment2->setContent("Je serai ravi de participer à cet atelier mais malheureusement je ne pourrai pas être présent :( ");
        $comment2->setActivity($this->getReference("act-couture"));
        $comment2->setCreatedAt(new \DateTime("2020-10-06 19:45:00"));
        $manager->persist($comment2);






        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return[
            UserFixtures::class,
            ActivityFixtures::class,
        ];
    }
}
