<?php

namespace App\Controller\Api;

use App\DTO\MultiEntityDTO;
use App\Service\UserCreator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class UserController extends AbstractController
{
    #[Route('/api/user', methods: ['POST'])]
    public function create(
        Request $request,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        UserCreator $userCreator
    ): JsonResponse {

        try {
            /** @var MultiEntityDTO $dto */
            $dto = $serializer->deserialize(
                $request->getContent(),
                MultiEntityDTO::class,
                'json'
            );
        } catch (\Throwable) {
            return $this->json(['error' => 'Invalid JSON'], 400);
        }

        $errors = $validator->validate($dto);
        if (count($errors) > 0) {
            return $this->json($this->mapErrors($errors), 422);
        }

        $userCreator->createFullUser($dto);

        return $this->json(['status' => 'created'], 201);
    }

    private function mapErrors(ConstraintViolationListInterface $errors): array
    {
        $result = [];

        foreach ($errors as $error) {
            $result[$error->getPropertyPath()][] = $error->getMessage();
        }

        return $result;
    }
}