<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Product
{
    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 13,
     *      max = 13,
     *      allowEmptyString = false
     * )
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "The product name should have minmum {{ limit }} characters",
     *      maxMessage = "The product name should have maximum {{ limit }} characters",
     *      allowEmptyString = false
     * )
     */
    private $name;

    /**
     * @Assert\Length(
     *      max = 30,
     *      maxMessage = "The product manager should have maximum {{ limit }} characters",
     *      allowEmptyString = true
     * )
     */
    private $manager;

    /**
     * @Assert\NotBlank
     */
    private $salesStartDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
       $this->id = $id;

       return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getManager(): ?string
    {
        return $this->manager;
    }

    public function setManager(?string $manager): self
    {
        $this->manager = $manager;

        return $this;
    }

    public function getSalesStartDate(): ?\DateTimeInterface
    {
        return $this->salesStartDate;
    }

    public function setSalesStartDate(?\DateTimeInterface $salesStartDate): self
    {
        $this->salesStartDate = $salesStartDate;

        return $this;
    }
}
