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

        foreach ($dto->workExperiences as $expDto) {

            $work = (new WorkExperiences())
                ->setCompany($expDto->company)
                ->setPosition($expDto->position)
                ->setDateFrom($expDto->dateFrom)
                ->setDateTo($expDto->dateTo)
                ->setProfile($user);

            $user->addWorkExperience($work);
        }


        $user->setContact($contact);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}