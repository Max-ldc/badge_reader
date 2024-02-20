<?php

namespace App\Entity;

use App\Repository\KeyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KeyRepository::class)]
class Key
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $passphrase = null;

    #[ORM\OneToMany(mappedBy: 'key', targetEntity: Badge::class)]
    private Collection $badge;

    #[ORM\ManyToMany(targetEntity: BadgeReader::class, inversedBy: 'keys')]
    private Collection $badgeReader;

    public function __construct()
    {
        $this->badge = new ArrayCollection();
        $this->badgeReader = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassphrase(): ?string
    {
        return $this->passphrase;
    }

    public function setPassphrase(string $passphrase): static
    {
        $this->passphrase = $passphrase;

        return $this;
    }

    /**
     * @return Collection<int, Badge>
     */
    public function getBadge(): Collection
    {
        return $this->badge;
    }

    public function addBadge(Badge $badge): static
    {
        if (!$this->badge->contains($badge)) {
            $this->badge->add($badge);
            $badge->setKey($this);
        }

        return $this;
    }

    public function removeBadge(Badge $badge): static
    {
        if ($this->badge->removeElement($badge)) {
            // set the owning side to null (unless already changed)
            if ($badge->getKey() === $this) {
                $badge->setKey(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BadgeReader>
     */
    public function getBadgeReader(): Collection
    {
        return $this->badgeReader;
    }

    public function addBadgeReader(BadgeReader $badgeReader): static
    {
        if (!$this->badgeReader->contains($badgeReader)) {
            $this->badgeReader->add($badgeReader);
        }

        return $this;
    }

    public function removeBadgeReader(BadgeReader $badgeReader): static
    {
        $this->badgeReader->removeElement($badgeReader);

        return $this;
    }
}
