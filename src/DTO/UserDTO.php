<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class UserDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 20, maxMessage: 'Name cannot be longer than {{ limit }} characters')]
    public string $name;

    #[Assert\NotBlank]
    #[Assert\Length(max: 20, maxMessage: 'Surname cannot be longer than {{ limit }} characters')]
    public string $surname;

    #[Assert\NotBlank]
    #[Assert\DateTime]
    #[Assert\LessThan('today')]
    public ?\DateTime $birthday;
}