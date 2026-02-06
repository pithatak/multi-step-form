<?php

namespace App\Tests\DTO;

use App\DTO\WorkExperienceDTO;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class WorkExperienceDTOTest extends KernelTestCase
{
    private ValidatorInterface $validator;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->validator = self::getContainer()->get(ValidatorInterface::class);
    }

    public function testDateFromCannotBeAfterDateTo(): void
    {
        $dto = new WorkExperienceDTO();
        $dto->company = 'Test Company';
        $dto->position = 'Developer';
        $dto->dateFrom = new \DateTime('2025-01-10');
        $dto->dateTo   = new \DateTime('2024-01-10');

        $errors = $this->validator->validate($dto);
        $this->assertCount(1, $errors);
        $this->assertSame(
            'Start date cannot be before End date',
            $errors[0]->getMessage()
        );
    }
}
