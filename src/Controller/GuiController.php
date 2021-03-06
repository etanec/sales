<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;
use App\Manager\ProductManager;
use App\Manager\SalesManager;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GuiController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): RedirectResponse
    {
        return $this->redirectToRoute('welcome');
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
    public function newProduct(Request $request, ProductManager $productManager): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $added = $productManager->addProduct($form->getData());
                if (true === $added) {
                    $this->addFlash(
                        'success',
                        \sprintf('Product "%s" added successfully', $product->getName())
                        );
                    return $this->redirectToRoute('new_product');
                } else {
                    throw new \Exception('An error occured');
                }
            } catch (\Exception $e) {
                throw new \Exception('An error occured');
            }
        }
        return $this->render('gui/new_product.html.twig', [
            'page_name' => 'New product',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/sales", name="sales")
     */
    public function sales(SalesManager $salesManager): Response
    {
        $data = $salesManager->getSales();

        return $this->render('gui/sales.html.twig', [
            'page_name' => 'Sales',
            'data' => \json_decode($data, true),
        ]);
    }
}
