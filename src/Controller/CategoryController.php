<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Item;
use App\Form\ItemType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category/{id}', name: 'category_manage')]
    public function manage(Category $category, Request $request, EntityManagerInterface $entityManager): Response
    {
        $item = new Item();
        $item->setCategory($category);
        $form = $this->createForm(ItemType::class, $item);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($item);
            $entityManager->flush();

            return $this->redirectToRoute('category_manage', ['id' => $category->getId()]);
        }

        $items = $entityManager->getRepository(Item::class)->findBy(['category' => $category]);

        return $this->render('category/manage.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
            'items' => $items,
        ]);
    }
}