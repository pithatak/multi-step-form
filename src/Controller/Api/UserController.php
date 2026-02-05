<?php

namespace App\Controller\Api;

use App\DTO\MultiEntityDTO;
use App\Service\UserCreator;
use App\Type\MultiEntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    #[Route('/api/user', methods: ['POST'])]
    public function create(Request $request, UserCreator $userCreator): JsonResponse
    {
        $dto = new MultiEntityDTO();
        $form = $this->createForm(MultiEntityType::class, $dto);

        $form->handleRequest($request);
        ;
        if (!$form->isSubmitted()) {
            return $this->json(['error' => 'Invalid request'], 400);
        }

        if (!$form->isValid()) {
            return $this->json(
                $this->getFormErrors($form),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $userCreator->createFullUser($dto);

        return $this->json(['status' => 'created'], Response::HTTP_CREATED);
    }

    private function getFormErrors(FormInterface $form): array
    {
        $errors = [];

        foreach ($form->getErrors(true) as $error) {
            $property = $error->getOrigin()->getName();
            $errors[$property][] = $error->getMessage();
        }

        return [
            'errors' => $errors,
        ];
    }
}