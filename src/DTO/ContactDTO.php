<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class ContactDTO
{
    #[Assert\NotBlank]
    #[Assert\Regex(pattern: '/^\+?[0-9]{9,15}$/')]
    public string $phone;

    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;
}