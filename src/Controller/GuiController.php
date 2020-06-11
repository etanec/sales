<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class GuiController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        return $this->render('gui/index.html.twig', [
            'controller_name' => 'GuiController',
        ]);
    }

    /**
     * @Route("/welcome", name="welcome")
     */
    public function test(): Response
    {
        return new Response('<html><body>Hello from welcome</body></html>');
    }
}
