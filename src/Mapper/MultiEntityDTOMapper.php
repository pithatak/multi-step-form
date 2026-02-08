<?php

namespace App\Mapper;

use App\DTO\ContactDTO;
use App\DTO\MultiEntityDTO;
use App\DTO\UserDTO;
use App\DTO\WorkExperienceDTO;

final class MultiEntityDTOMapper
{
    public function fromArray(array $data): MultiEntityDTO
    {
        return new MultiEntityDTO(
            user: new UserDTO(
                name: $data['user']['name'],
                surname: $data['user']['surname'],
                birthday: new \DateTime($data['user']['birthday']),
            ),
            contact: new ContactDTO(
                phone: $data['contact']['phone'],
                email: $data['contact']['email'],
            ),
            workExperiences: $this->mapWorkExperiences($data['workExperiences'] ?? [])
        );
    }

    /**
     * @return WorkExperienceDTO[]
     */
    private function mapWorkExperiences(array $items): array
    {
        $result = [];

        foreach ($items as $item) {
            $result[] = new WorkExperienceDTO(
                company: $item['company'],
                position: $item['position'],
                dateFrom: empty($item['dateFrom']) ? null : new \DateTime($item['dateFrom']),
                dateTo: empty($item['dateTo']) ? null : new \DateTime($item['dateTo']),
            );
        }

        return $result;
    }
}
