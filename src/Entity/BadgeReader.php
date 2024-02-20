<?php

namespace App\Entity;

use App\Repository\BadgeReaderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BadgeReaderRepository::class)]
class BadgeReader
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $serialNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $systemVersion = null;

    #[ORM\Column(length: 255)]
    private ?string $modelName = null;

    #[ORM\Column(length: 255)]
    private ?string $systemName = null;

    #[ORM\OneToMany(mappedBy: 'badgeReader', targetEntity: Registration::class, orphanRemoval: true)]
    private Collection $registrations;

    #[ORM\ManyToMany(targetEntity: Key::class, mappedBy: 'badgeReader')]
    private Collection $keys;

    public function __construct()
    {
        $this->registrations = new ArrayCollection();
        $this->keys = new ArrayCollection();
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

    public function getSystemVersion(): ?string
    {
        return $this->systemVersion;
    }

    public function setSystemVersion(string $systemVersion): static
    {
        $this->systemVersion = $systemVersion;

        return $this;
    }

    public function getModelName(): ?string
    {
        return $this->modelName;
    }

    public function setModelName(string $modelName): static
    {
        $this->modelName = $modelName;

        return $this;
    }

    public function getSystemName(): ?string
    {
        return $this->systemName;
    }

    public function setSystemName(string $systemName): static
    {
        $this->systemName = $systemName;

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
            $registration->setBadgeReader($this);
        }

        return $this;
    }

    public function removeRegistration(Registration $registration): static
    {
        if ($this->registrations->removeElement($registration)) {
            // set the owning side to null (unless already changed)
            if ($registration->getBadgeReader() === $this) {
                $registration->setBadgeReader(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Key>
     */
    public function getKeys(): Collection
    {
        return $this->keys;
    }

    public function addKey(Key $key): static
    {
        if (!$this->keys->contains($key)) {
            $this->keys->add($key);
            $key->addBadgeReader($this);
        }

        return $this;
    }

    public function removeKey(Key $key): static
    {
        if ($this->keys->removeElement($key)) {
            $key->removeBadgeReader($this);
        }

        return $this;
    }
}
