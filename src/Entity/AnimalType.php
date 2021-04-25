<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnimalTypeRepository")
 */
class AnimalType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $entity_name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntityName(): ?string
    {
        return $this->entity_name;
    }

    public function setEntityName(string $entity_name): self
    {
        $this->entity_name = $entity_name;

        return $this;
    }
}
