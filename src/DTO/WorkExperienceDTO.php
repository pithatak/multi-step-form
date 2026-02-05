<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class WorkExperienceDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 20, maxMessage: 'Company cannot be longer than {{ limit }} characters')]
    public string $company;

    #[Assert\NotBlank]
    #[Assert\Length(max: 20, maxMessage: 'Position cannot be longer than {{ limit }} characters')]
    public string $position;

    #[Assert\NotBlank]
    #[Assert\Date]
    public \DateTime $dateFrom;
    #[Assert\NotBlank]
    #[Assert\Date]
    public \DateTime $dateTo;

    #[Assert\Callback]
    public function validateDates(ExecutionContextInterface $context)
    {
        if ($this->dateFrom > $this->dateTo) {
            $context->buildViolation('Start date cannot be before End date')
                ->atPath('dateFrom')
                ->addViolation();
        }
    }
}