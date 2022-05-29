<?php

namespace App\Entity;

use App\Repository\ActorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ActorRepository::class)]
class Actor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Ce champ est obligatoire.')]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Ce champ est obligatoire.')]
    private $lastname;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank(message: 'Ce champ est obligatoire.')]
    #[Assert\Date(message: 'Merci de respecter ce format : YYYY-MM-JJ')]
    private $birthDate;

    #[ORM\ManyToMany(targetEntity: Program::class, inversedBy: 'actors')]
    private $Program;

    public function __construct()
    {
        $this->Program = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * @return Collection<int, Program>
     */
    public function getProgram(): Collection
    {
        return $this->Program;
    }

    public function addProgram(Program $program): self
    {
        if (!$this->Program->contains($program)) {
            $this->Program[] = $program;
        }

        return $this;
    }

    public function removeProgram(Program $program): self
    {
        $this->Program->removeElement($program);

        return $this;
    }
}
