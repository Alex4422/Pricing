<?php

namespace App\Controller;

use App\Entity\ProductForSale;
use App\Form\ProductForSaleType;
use App\Repository\ProductForSaleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product/for/sale")
 */
class ProductForSaleController extends AbstractController
{
    /**
     * @Route("/", name="product_for_sale_index", methods={"GET"})
     */
    public function index(ProductForSaleRepository $productForSaleRepository): Response
    {
        return $this->render('product_for_sale/index.html.twig', [
            'product_for_sales' => $productForSaleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="product_for_sale_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $productForSale = new ProductForSale();
        $form = $this->createForm(ProductForSaleType::class, $productForSale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($productForSale);
            $entityManager->flush();

            return $this->redirectToRoute('product_for_sale_index');
        }

        return $this->render('product_for_sale/new.html.twig', [
            'product_for_sale' => $productForSale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_for_sale_show", methods={"GET"})
     */
    public function show(ProductForSale $productForSale): Response
    {
        return $this->render('product_for_sale/show.html.twig', [
            'product_for_sale' => $productForSale,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_for_sale_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ProductForSale $productForSale): Response
    {
        $form = $this->createForm(ProductForSaleType::class, $productForSale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_for_sale_index');
        }

        return $this->render('product_for_sale/edit.html.twig', [
            'product_for_sale' => $productForSale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_for_sale_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ProductForSale $productForSale): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productForSale->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($productForSale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_for_sale_index');
    }
}
