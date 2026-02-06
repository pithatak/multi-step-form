<?php

namespace App\Tests\Factory;

use App\DTO\ContactDTO;
use App\DTO\MultiEntityDTO;
use App\DTO\UserDTO;
use App\DTO\WorkExperienceDTO;

final class TestDtoFactory
{
    public static function validMultiEntityDto(): MultiEntityDTO
    {
        $dto = new MultiEntityDTO();

        $dto->user = new UserDTO();
        $dto->user->name = 'John';
        $dto->user->surname = 'Doe';
        $dto->user->birthday = new \DateTime('1990-01-01');

        $dto->contact = new ContactDTO();
        $dto->contact->email = 'john@test.com';
        $dto->contact->phone = '123456789';

        $dto->workExperience = new WorkExperienceDTO();
        $dto->workExperience->company = 'ACME';
        $dto->workExperience->position = 'Dev';
        $dto->workExperience->dateFrom = new \DateTime('2020-01-01');
        $dto->workExperience->dateTo = new \DateTime('2021-01-01');

        return $dto;
    }
}
