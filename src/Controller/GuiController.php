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
            'page_name' => 'Home'
        ]);
    }

    /**
     * @Route("/welcome", name="welcome")
     */
    public function welcome(): Response
    {
        return $this->render('gui/welcome.html.twig', [
            'page_name' => 'Welcome'
        ]);
    }

    /**
     * @Route("/new-product", name="new_product")
     */
    public function newProduct(): Response
    {
        return $this->render('gui/new_product.html.twig', [
            'page_name' => 'New product'
        ]);
    }

    /**
     * @Route("/sales", name="sales")
     */
    public function sales(): Response
    {
        return $this->render('gui/sales.html.twig', [
            'page_name' => 'Sales'
        ]);
    }
}
