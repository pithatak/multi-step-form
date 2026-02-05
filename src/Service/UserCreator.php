<?php

namespace App\Service;

use App\DTO\MultiEntityDTO;
use App\Entity\Contact;
use App\Entity\User;
use App\Entity\WorkExperiences;
use Doctrine\ORM\EntityManagerInterface;

class UserCreator
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    )
    {
    }

    public function createFullUser(MultiEntityDTO $dto): void
    {
        $user = (new User())
            ->setName($dto->user->name)
            ->setSurname($dto->user->surname)
            ->setBirthday($dto->user->birthday);

        $contact = (new Contact())
            ->setEmail($dto->contact->email)
            ->setPhone($dto->contact->phone)
            ->setProfile($user);

        $workExperiences = (new WorkExperiences())
            ->setCompany($dto->workExperience->company)
            ->setPosition($dto->workExperience->position)
            ->setDateFrom($dto->workExperience->dateFrom)
            ->setDateTo($dto->workExperience->dateTo)
            ->setProfile($user);

        $user->setContact($contact)
            ->addWorkExperience($workExperiences);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}