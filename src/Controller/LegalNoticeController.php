<?php


namespace App\Controller;
use App\Repository\CategoryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LegalNoticeController extends AbstractController
{
    /**
     * @Route("/mentions-legales", name="mentionlegale")
     */
    public function mentions_legales()
    {



        return $this->render("default/legalnotice.html.twig", [


        ]);
    }
}
