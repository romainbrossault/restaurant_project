<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Entity\MenuItem;
use App\Form\MenuItemType;
use App\Entity\Category;
use App\Form\MenuType;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'menu')]
    public function index(EntityManagerInterface $entityManager, Security $security): Response
    {
        $menus = $entityManager->getRepository(Menu::class)->findAll();
        $menuItems = $entityManager->getRepository(MenuItem::class)->findAll();
        $user = $security->getUser();

        return $this->render('menu/index.html.twig', [
            'menus' => $menus,
            'menuItems' => $menuItems,
            'user' => $user,
        ]);
    }

    #[Route('/menu-ges', name: 'menu_ges')]
    public function manage(Request $request, EntityManagerInterface $entityManager): Response
    {
        $menu = new Menu();
        $menuForm = $this->createForm(MenuType::class, $menu);

        $menuForm->handleRequest($request);
        if ($menuForm->isSubmitted() && $menuForm->isValid()) {
            $entityManager->persist($menu);
            $entityManager->flush();

            return $this->redirectToRoute('menu_ges');
        }

        $category = new Category();
        $categoryForm = $this->createForm(CategoryType::class, $category);

        $categoryForm->handleRequest($request);
        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('menu_ges');
        }

        $menus = $entityManager->getRepository(Menu::class)->findAll();
        $categories = $entityManager->getRepository(Category::class)->findAll();

        return $this->render('menu/manage.html.twig', [
            'menuForm' => $menuForm->createView(),
            'categoryForm' => $categoryForm->createView(),
            'menus' => $menus,
            'categories' => $categories,
        ]);
    }

    #[Route('/menu/delete/{id}', name: 'menu_delete')]
    public function delete(Menu $menu, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($menu);
        $entityManager->flush();

        return $this->redirectToRoute('menu_ges');
    }

    #[Route('/category/delete/{id}', name: 'category_delete')]
    public function deleteCategory(Category $category, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($category);
        $entityManager->flush();

        return $this->redirectToRoute('menu_ges');
    }

    #[Route('/menu/{id}', name: 'menu_show')]
    public function show(Menu $menu, Request $request, EntityManagerInterface $entityManager): Response
    {
        $menuItem = new MenuItem();
        $menuItem->setMenu($menu);
        $form = $this->createForm(MenuItemType::class, $menuItem);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($menuItem);
            $entityManager->flush();

            return $this->redirectToRoute('menu_show', ['id' => $menu->getId()]);
        }

        $menuItems = $entityManager->getRepository(MenuItem::class)->findBy(['menu' => $menu]);

        return $this->render('menu/show.html.twig', [
            'menu' => $menu,
            'menuItems' => $menuItems,
            'form' => $form->createView(),
        ]);
    }
}

