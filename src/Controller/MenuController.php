<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Form\MenuType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'menu')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $menus = $entityManager->getRepository(Menu::class)->findAll();

        return $this->render('menu/index.html.twig', [
            'menus' => $menus,
        ]);
    }

    #[Route('/menu-ges', name: 'menu_ges')]
    public function manage(Request $request, EntityManagerInterface $entityManager): Response
    {
        $menu = new Menu();
        $form = $this->createForm(MenuType::class, $menu);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($menu);
            $entityManager->flush();

            return $this->redirectToRoute('menu_ges');
        }

        $menus = $entityManager->getRepository(Menu::class)->findAll();

        return $this->render('menu/manage.html.twig', [
            'form' => $form->createView(),
            'menus' => $menus,
        ]);
    }

    #[Route('/menu/delete/{id}', name: 'menu_delete')]
    public function delete(Menu $menu, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($menu);
        $entityManager->flush();

        return $this->redirectToRoute('menu_ges');
    }
}