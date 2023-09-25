<?php

namespace App\Entity;

use App\Repository\OrderItemsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderItemsRepository::class)]
class OrderItems
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orderItems')]
    private ?Order $order_details = null;

    #[ORM\ManyToOne(inversedBy: 'orderItems')]
    private ?Product $product = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $price = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $price_taxed = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $quantity = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $price_total = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getPriceTaxed(): ?string
    {
        return $this->price_taxed;
    }

    public function setPriceTaxed(string $price_taxed): static
    {
        $this->price_taxed = $price_taxed;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPriceTotal(): ?string
    {
        return $this->price_total;
    }

    public function setPriceTotal(string $price_total): static
    {
        $this->price_total = $price_total;

        return $this;
    }

    public function getOrderDetails(): ?Order
    {
        return $this->order_details;
    }

    public function setOrderDetails(?Order $order_details): static
    {
        $this->order_details = $order_details;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }
}
