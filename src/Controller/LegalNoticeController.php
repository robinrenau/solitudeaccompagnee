<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LegalNoticeController extends AbstractController
{
    #[Route('/mentions-legales', name: 'mentionlegale')]
    public function mentionsLegales()
    {
        return $this->render('default/legalnotice.html.twig');
    }
}

