<?php

namespace App\ViewFactory;

use App\DTO\MultiEntityDTO;

final class ProfileViewFactory
{
    public function createProfileView(MultiEntityDTO $dto)
    {
        $exp = [];
        foreach ($dto->workExperiences as $workExperience) {
            $exp[] = [
                'company' => $workExperience->company,
                'position' => $workExperience->position,
                'From date' => $workExperience->dateFrom,
                'To date' => $workExperience->dateTo
            ];
        }

        return [
            'First name' => $dto->user->name,
            'Second name' => $dto->user->surname,
            'Birth date' => $dto->user->birthday,
            'email' => $dto->contact->email,
            'phone' => $dto->contact->phone,
            'Work Experiences' => $exp
        ];
    }
}