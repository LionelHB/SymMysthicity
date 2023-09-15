<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\NftRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: NftRepository::class)]
#[ApiResource(
    collectionOperations: [
        'post' => [
            'denormalization_context' => [
                'groups' => 'nft:post'
            ]
        ],
        'get' => [
            'normalization_context' => [
                'groups' => 'nft:list'
            ]
        ],
    ],
    itemOperations: [
        'put',
        'delete',
        'get' => [
            'normalization_context' => [
                'groups' => 'nft:item'
            ]
        ],
    ]
)]

#[ApiFilter(
    SearchFilter::class, properties: [
        'name' => 'partial',
        'creator' => 'partial',
        'nftPath' => 'partial',
        'price' => 'partial',
        'creationDate' => 'partial',
        'category.name' => 'partial',
        'subCategory.name' => 'partial',
        'anthology.name'=> 'partial',

    ]
)]
#[ApiFilter(
    DateFilter::class, properties: [
        'creationDate'
    ]
)]
class Nft
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['nft:post', 'nft:list', 'nft:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['user:post', 'user:list', 'user:item', 'category:item', 'subCategory:item', 'gallery:item'])]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['nft:item'])]
    private ?string $creator = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['nft:item'])]
    private ?\DateTimeInterface $creationDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['nft:item'])]
    private ?\DateTimeInterface $firstDateSale = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['nft:item'])]
    private ?\DateTimeInterface $lastDateSale = null;

    #[ORM\Column(length: 255)]
    private ?string $identificationKey = null;

    #[ORM\Column(length: 255)]
    #[Groups(['nft:item', 'gallery:item', 'gallery:list', 'user:item', 'subCategory:item', 'category:item', 'favoris:item'])]
    private ?string $nftPath = null;

    #[ORM\Column]
    #[Groups(['nft:item'])]
    private ?float $price = null;

    #[ORM\Column]
    private ?bool $isPublic = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['nft:item'])]
    private ?int $quantity = null;

    #[ORM\Column]
    #[Groups(['nft:item'])]
    private ?int $view = null;

    #[ORM\Column]
    #[Groups(['nft:item'])]
    private ?int $likes = null;

    #[ORM\Column]
    #[Groups(['nft:item'])]
    private ?int $favoris = null;

    #[ORM\ManyToOne(inversedBy: 'nft')]
    #[Groups(['nft:item'])]
    private ?Anthology $anthology = null;

    #[ORM\OneToMany(mappedBy: 'nft', targetEntity: LikesFavoris::class)]
    #[Groups(['nft:item'])]
    private Collection $likesFavoris;

    #[ORM\OneToMany(mappedBy: 'nft', targetEntity: Comment::class)]
    #[Groups(['nft:item'])]
    private Collection $comments;

    #[ORM\ManyToOne(inversedBy: 'nft')]
    #[Groups(['nft:item'])]
    private ?SubCategory $subCategory = null;

  
   
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['nft:item'])]
    private ?string $description = null;
    #[Groups(['nft:item', 'nft:list', 'gallery:item', ])]
    #[ORM\ManyToOne(inversedBy: 'nft')]
    private ?User $owner = null;

    public function __construct()
    {
        $this->likesFavoris = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCreator(): ?string
    {
        return $this->creator;
    }

    public function setCreator(?string $creator): static
    {
        $this->creator = $creator;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(?\DateTimeInterface $creationDate): static
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getFirstDateSale(): ?\DateTimeInterface
    {
        return $this->firstDateSale;
    }

    public function setFirstDateSale(?\DateTimeInterface $firstDateSale): static
    {
        $this->firstDateSale = $firstDateSale;

        return $this;
    }

    public function getLastDateSale(): ?\DateTimeInterface
    {
        return $this->lastDateSale;
    }

    public function setLastDateSale(?\DateTimeInterface $lastDateSale): static
    {
        $this->lastDateSale = $lastDateSale;

        return $this;
    }

    public function getIdentificationKey(): ?string
    {
        return $this->identificationKey;
    }

    public function setIdentificationKey(string $identificationKey): static
    {
        $this->identificationKey = $identificationKey;

        return $this;
    }

    public function getNftPath(): ?string
    {
        return $this->nftPath;
    }

    public function setNftPath(string $nftPath): static
    {
        $this->nftPath = $nftPath;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function isIsPublic(): ?bool
    {
        return $this->isPublic;
    }

    public function setIsPublic(bool $isPublic): static
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getView(): ?int
    {
        return $this->view;
    }

    public function setView(int $view): static
    {
        $this->view = $view;

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(int $likes): static
    {
        $this->likes = $likes;

        return $this;
    }

    public function getFavoris(): ?int
    {
        return $this->favoris;
    }

    public function setFavoris(int $favoris): static
    {
        $this->favoris = $favoris;

        return $this;
    }

    public function getAnthology(): ?Anthology
    {
        return $this->anthology;
    }

    public function setAnthology(?Anthology $anthology): static
    {
        $this->anthology = $anthology;

        return $this;
    }

    /**
     * @return Collection<int, LikesFavoris>
     */
    public function getLikesFavoris(): Collection
    {
        return $this->likesFavoris;
    }

    public function addLikesFavori(LikesFavoris $likesFavori): static
    {
        if (!$this->likesFavoris->contains($likesFavori)) {
            $this->likesFavoris->add($likesFavori);
            $likesFavori->setNft($this);
        }

        return $this;
    }

    public function removeLikesFavori(LikesFavoris $likesFavori): static
    {
        if ($this->likesFavoris->removeElement($likesFavori)) {
            // set the owning side to null (unless already changed)
            if ($likesFavori->getNft() === $this) {
                $likesFavori->setNft(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setNft($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getNft() === $this) {
                $comment->setNft(null);
            }
        }

        return $this;
    }

    public function getSubCategory(): ?SubCategory
    {
        return $this->subCategory;
    }

    public function setSubCategory(?SubCategory $subCategory): static
    {
        $this->subCategory = $subCategory;

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }
}
