<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ApiResource(
    itemOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => 'category:item'
            ]
        ]
    ],
    collectionOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => 'category:list'
            ]
        ],
    ]
)]
#[ApiFilter(
    SearchFilter::class, properties: [
        'name' => 'partial'
    ]
)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['subCategory:list', 'subCategory:item', 'nft:post', 'nft:list', 'nft:item', 'category:item', 'category:list'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['subCategory:list', 'subCategory:item', 'nft:post', 'nft:list', 'nft:item', 'category:item', 'category:list'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['subCategory:list', 'subCategory:item', 'nft:post', 'nft:list', 'nft:item', 'category:item', 'category:list'])]
    private ?string $description = null;


    #[ORM\OneToMany(targetEntity:"SubCategory", mappedBy:"category")]
    #[Groups(['subCategory:list', 'subCategory:item', 'nft:post', 'nft:list', 'nft:item', 'category:item', 'category:list'])]
    private Collection $subCategory;

    public function __construct()
    {
        $this->subCategory = new ArrayCollection();
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
     * @return Collection<int, SubCategory>
     */
    public function getSubCategory(): Collection
    {
        return $this->subCategory;
    }

    public function addSubCategory(SubCategory $subCategory): static
    {
        if (!$this->subCategory->contains($subCategory)) {
            $this->subCategory->add($subCategory);
            $subCategory->setCategory($this);
        }

        return $this;
    }

    public function removeSubCategory(SubCategory $subCategory): static
    {
        if ($this->subCategory->removeElement($subCategory)) {
            if ($subCategory->getCategory() === $this) {
                $subCategory->setCategory(null);
            }
        }

        return $this;
    }
}
