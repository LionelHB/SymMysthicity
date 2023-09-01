<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AnthologyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnthologyRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => 'anthology:list'
            ]
        ],
    ],
    itemOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => 'anthology:item'
            ]
        ],
    ]
)]
class Anthology
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'anthology', targetEntity: Nft::class)]
    private Collection $nft;

    public function __construct()
    {
        $this->nft = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Nft>
     */
    public function getNft(): Collection
    {
        return $this->nft;
    }

    public function addNft(Nft $nft): static
    {
        if (!$this->nft->contains($nft)) {
            $this->nft->add($nft);
            $nft->setAnthology($this);
        }

        return $this;
    }

    public function removeNft(Nft $nft): static
    {
        if ($this->nft->removeElement($nft)) {
            // set the owning side to null (unless already changed)
            if ($nft->getAnthology() === $this) {
                $nft->setAnthology(null);
            }
        }

        return $this;
    }
}
