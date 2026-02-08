<?php

namespace App\Controller\Api;

use App\Mapper\MultiEntityDTOMapper;
use App\Service\UserCreator;
use App\ViewFactory\ProfileViewFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class UserController extends AbstractController
{
    #[Route('/api/user', methods: ['POST'])]
    public function create(
        Request $request,
        MultiEntityDTOMapper $mapper,
        ValidatorInterface $validator,
        UserCreator $userCreator,
        ProfileViewFactory $viewFactory,
    ): JsonResponse {
        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $dto = $mapper->fromArray($data);

        $errors = $validator->validate($dto);
        if (count($errors) > 0) {
            $out = [];
            foreach ($errors as $error) {
                $out[$error->getPropertyPath()][] = $error->getMessage();
            }

            return $this->json($out, 422);
        }

        $userCreator->createFullUser($dto);

        return $this->json($viewFactory->createProfileView($dto));
    }
}