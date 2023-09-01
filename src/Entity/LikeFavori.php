<?php

namespace App\Entity;

use App\Repository\LikeFavoriRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LikeFavoriRepository::class)]
class LikeFavori
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $type = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateAction = null;

    #[ORM\ManyToOne(inversedBy: 'likes')]
    private ?Nft $nft = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getDateAction(): ?\DateTimeInterface
    {
        return $this->dateAction;
    }

    public function setDateAction(\DateTimeInterface $dateAction): static
    {
        $this->dateAction = $dateAction;

        return $this;
    }

    public function getNft(): ?Nft
    {
        return $this->nft;
    }

    public function setNft(?Nft $nft): static
    {
        $this->nft = $nft;

        return $this;
    }
}
