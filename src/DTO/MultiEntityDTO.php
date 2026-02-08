<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class MultiEntityDTO
{
    public function __construct(
        #[Assert\Valid]
        public UserDTO $user,

        #[Assert\Valid]
        public ContactDTO $contact,

        /** @var WorkExperienceDTO[] */
        #[Assert\Valid]
        #[Assert\Count(min: 1)]
        public array $workExperiences = [],
    ) {}
}
