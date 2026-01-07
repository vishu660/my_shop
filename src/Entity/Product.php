<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'products')]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $slug = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $short_description = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private ?string $price = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private ?string $sale_price = null;

    #[ORM\Column(type: 'integer')]
    private ?int $stock = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $sku = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $category_id = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $brand_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: 'json', nullable: true)]
    private ?array $gallery = [];

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $meta_title = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $meta_description = null;

    #[ORM\Column(type: 'boolean')]
    private bool $is_featured = false;

    #[ORM\Column(type: 'boolean')]
    private bool $is_new = false;

    #[ORM\Column(type: 'boolean')]
    private bool $is_best_seller = false;

    #[ORM\Column(type: 'boolean')]
    private bool $status = true;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $created_at;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updated_at = null;

    public function __construct()
    {
        $this->created_at = new \DateTime();
    }

    // ================= GETTERS & SETTERS =================

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function setShortDescription(?string $short_description): self
    {
        $this->short_description = $short_description;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getSalePrice(): ?string
    {
        return $this->sale_price;
    }

    public function setSalePrice(?string $sale_price): self
    {
        $this->sale_price = $sale_price;
        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;
        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(?string $sku): self
    {
        $this->sku = $sku;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function getGallery(): ?array
    {
        return $this->gallery;
    }

    public function setGallery(?array $gallery): self
    {
        $this->gallery = $gallery;
        return $this;
    }

    public function isFeatured(): bool
    {
        return $this->is_featured;
    }

    public function setIsFeatured(bool $is_featured): self
    {
        $this->is_featured = $is_featured;
        return $this;
    }

    public function isNew(): bool
    {
        return $this->is_new;
    }

    public function setIsNew(bool $is_new): self
    {
        $this->is_new = $is_new;
        return $this;
    }

    public function isBestSeller(): bool
    {
        return $this->is_best_seller;
    }

    public function setIsBestSeller(bool $is_best_seller): self
    {
        $this->is_best_seller = $is_best_seller;
        return $this;
    }

    public function isStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->created_at;
    }

    public function setUpdatedAt(): self
    {
        $this->updated_at = new \DateTime();
        return $this;
    }
}
