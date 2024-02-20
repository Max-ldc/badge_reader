<?php

namespace App\Entity;

use App\Repository\BadgeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BadgeRepository::class)]
class Badge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['badge:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['badge:read'])]
    private ?string $serialNumber = null;

    #[ORM\OneToMany(mappedBy: 'badge', targetEntity: Registration::class)]
    private Collection $registrations;

    #[ORM\ManyToOne(inversedBy: 'badge')]
    private ?Key $key = null;

    public function __construct()
    {
        $this->registrations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(string $serialNumber): static
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    /**
     * @return Collection<int, Registration>
     */
    public function getRegistrations(): Collection
    {
        return $this->registrations;
    }

    public function addRegistration(Registration $registration): static
    {
        if (!$this->registrations->contains($registration)) {
            $this->registrations->add($registration);
            $registration->setBadge($this);
        }

        return $this;
    }

    public function removeRegistration(Registration $registration): static
    {
        if ($this->registrations->removeElement($registration)) {
            // set the owning side to null (unless already changed)
            if ($registration->getBadge() === $this) {
                $registration->setBadge(null);
            }
        }

        return $this;
    }

    public function getKey(): ?Key
    {
        return $this->key;
    }

    public function setKey(?Key $key): static
    {
        $this->key = $key;

        return $this;
    }
}
