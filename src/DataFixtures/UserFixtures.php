<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setPassword($this->passwordHasher->hashPassword($admin, "cè§eéfqb"));
        $admin->setFirstname("Robin");
        $admin->setLastname("Renaudier");
        $admin->setEmail("Robinrenau@gmail.com");
        $admin->setDateofbirth(new \DateTime("1995-03-04"));
        $admin->setRoles(["ROLE_ADMIN"]);
        $manager->persist($admin);
        $this->addReference("user-rrenau", $admin);

        $user = new User();
        $user->setFirstname("Jean");
        $user->setLastname("Dupont");
        $user->setEmail("jdupont@gmail.com");
        $user->setProfilPicture('user.jpg');
        $user->setDateofbirth(new \DateTime("1956-04-03"));
        $user->setPassword($this->passwordHasher->hashPassword($user, "jdupont35"));
        $manager->persist($user);
        $this->addReference("user-jdupont", $user);

        $user2 = new User();
        $user2->setFirstname("Martial");
        $user2->setLastname("Martin");
        $user2->setEmail("mmartin@gmail.com");
        $user2->setProfilPicture('user2.jpg');
        $user2->setDateofbirth(new \DateTime("1956-04-03"));
        $user2->setPassword($this->passwordHasher->hashPassword($user2, "mmartin35")); // ATTENTION ici, c'était $user avant
        $manager->persist($user2);
        $this->addReference("user-mmartin", $user2);

        $user3 = new User();
        $user3->setFirstname("Beatrice");
        $user3->setLastname("Loulin");
        $user3->setEmail("Bloulin@gmail.com");
        $user3->setProfilPicture('user3.jpg');
        $user3->setDateofbirth(new \DateTime("1956-04-03"));
        $user3->setPassword($this->passwordHasher->hashPassword($user3, "bloulin35"));
        $manager->persist($user3);
        $this->addReference("user-bloulin", $user3);

        $manager->flush();
    }
}

