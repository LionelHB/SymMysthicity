<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\SubCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SubCategoryRepository::class)]
#[ApiResource(
    itemOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => 'subCategory:item'
            ]
        ]
    ],
    collectionOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => 'subCategory:list'
            ]
        ],
    ]
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'name' => 'partial',
        'category.name' => 'partial',
    ]
)]
class SubCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['subCategory:list', 'subCategory:item', 'nft:post', 'nft:list', 'nft:item', 'category:list', 'category:item'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['subCategory:list', 'subCategory:item', 'nft:post', 'nft:list', 'nft:item', 'category:list', 'category:item'])]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'subCategory', targetEntity: Nft::class)]
    private Collection $nft;

    #[ORM\ManyToOne(inversedBy: 'subCategory')]
    #[Groups(['subCategory:list', 'subCategory:item', 'nft:post', 'nft:list', 'nft:item', 'category:list', 'category:item'])]
    private ?Category $category = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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
            $nft->setSubCategory($this);
        }

        return $this;
    }

    public function removeNft(Nft $nft): static
    {
        if ($this->nft->removeElement($nft)) {
            // set the owning side to null (unless already changed)
            if ($nft->getSubCategory() === $this) {
                $nft->setSubCategory(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
}
