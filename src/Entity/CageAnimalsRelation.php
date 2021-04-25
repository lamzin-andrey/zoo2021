<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CageAnimalsRelationRepository")
 */
class CageAnimalsRelation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $animal_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $animal_type_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $cage_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnimalId(): ?int
    {
        return $this->animal_id;
    }

    public function setAnimalId(int $animal_id): self
    {
        $this->animal_id = $animal_id;

        return $this;
    }

    public function getAnimalTypeId(): ?int
    {
        return $this->animal_type_id;
    }

    public function setAnimalTypeId(int $animal_type_id): self
    {
        $this->animal_type_id = $animal_type_id;

        return $this;
    }

    /**
     * @return int
     */
    public function getCageId(): int
    {
        return $this->cage_id;
    }

    /**
     * @param int $cageId
     * @return CageAnimalsRelation
     */
    public function setCageId(int $cageId): self
    {
        $this->cage_id = $cageId;

        return $this;
    }
}
