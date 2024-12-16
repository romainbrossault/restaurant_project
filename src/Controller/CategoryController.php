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

    #[Route('/category/{categoryId}/item/delete/{itemId}', name: 'category_item_delete')]
    public function deleteCategoryItem(int $categoryId, int $itemId, EntityManagerInterface $entityManager): Response
    {
        $item = $entityManager->getRepository(Item::class)->findOneBy(['category' => $categoryId, 'id' => $itemId]);

        if ($item) {
            $entityManager->remove($item);
            $entityManager->flush();
        }

        return $this->redirectToRoute('category_manage', ['id' => $categoryId]);
    }

    #[Route('/category/delete/{id}', name: 'category_delete')]
    public function deleteCategory(Category $category, EntityManagerInterface $entityManager): Response
    {
        
        $items = $entityManager->getRepository(Item::class)->findBy(['category' => $category]);

        
        foreach ($items as $item) {
            $menuItems = $entityManager->getRepository(MenuItems::class)->findBy(['item' => $item]);
            foreach ($menuItems as $menuItem) {
                $entityManager->remove($menuItem);
            }
            $entityManager->remove($item);
        }

        $entityManager->flush();

        
        $entityManager->remove($category);
        $entityManager->flush();

        return $this->redirectToRoute('menu_ges');
    }

}