<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    #[Route('/', name: 'user_form')]
    public function index(): Response
    {
        return $this->render('user/form.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
