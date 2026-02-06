<?php

namespace App\Tests\DTO;

use App\DTO\UserDTO;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints\LessThan as LessThanConstraint;
class UserDTOTest extends KernelTestCase
{
    private ValidatorInterface $validator;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->validator = self::getContainer()->get(ValidatorInterface::class);
    }

    public function testBirthdayCannotBeTomorrow(): void
    {
        $dto = new UserDTO();
        $dto->name = 'Jan';
        $dto->birthday  = new \DateTime('+1 day');
        $dto->surname = 'Kowalski';
        $errors = $this->validator->validate($dto);
        $this->assertCount(1, $errors);
        $this->assertSame('birthday', $errors[0]->getPropertyPath());
        $this->assertInstanceOf(LessThanConstraint::class, $errors[0]->getConstraint());

    }

}