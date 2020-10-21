<?php


namespace App\Tests\Repository;
use App\Repository\ActivityRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class ActivityRepositoryTest extends KernelTestCase
{

    public function testCount()
    {

       self::bootKernel();
       $activity = self::$container->get(ActivityRepository::class)->count([]);
       $this->assertEquals(7, $activity);
    }


}
