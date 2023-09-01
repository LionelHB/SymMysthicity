<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LikesFavorisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LikesFavorisRepository::class)]
#[ApiResource(
    collectionOperations: [
        'post' => [
            'denormalization_context' => [
                'groups' => 'likesFavoris:post'
            ]
        ],
        'get' => [
            'normalization_context' => [
                'groups' => 'likesFavoris:list'
            ]
        ],
    ],
    itemOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => 'likesFavoris:item'
            ]
        ],
    ]
)]
class LikesFavoris
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['nft:item'])]
       private ?string $type = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['nft:item'])]
    private ?\DateTimeInterface $actionDate = null;

    #[ORM\ManyToOne(inversedBy: 'likesFavoris')]
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

    public function getActionDate(): ?\DateTimeInterface
    {
        return $this->actionDate;
    }

    public function setActionDate(\DateTimeInterface $actionDate): static
    {
        $this->actionDate = $actionDate;

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
