<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class MultiEntityDTO
{
    #[Assert\Valid]
    public UserDTO $user;

    #[Assert\Valid]
    public ContactDTO $contact;

    #[Assert\Valid]
    public WorkExperienceDTO $workExperience;
}