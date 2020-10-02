<?php

namespace App\Controller;

use App\Entity\Activity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {;
        return $this->render("default/index.html.twig", [


        ]);
    }
    /**
     * @Route("/home", name="homepage")
     */
    public function home()
    {
        $em = $this->getDoctrine();
        $activities =$em->getRepository(Activity::class)->findBy([], array('createdAt'=>"DESC"), 3);
        return $this->render("default/home.html.twig", [
            "activities" => $activities
        ]);
    }
}
