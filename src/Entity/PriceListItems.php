<?php

namespace App\Entity;

use App\Repository\PriceListItemsRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: PriceListItemsRepository::class)]
class PriceListItems
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'priceListItems')]
    private ?PriceList $price_list = null;

    #[ORM\ManyToOne(inversedBy: 'priceListItems')]
    private ?Product $product = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPriceList(): ?PriceList
    {
        return $this->price_list;
    }

    public function setPriceList(?PriceList $price_list): static
    {
        $this->price_list = $price_list;

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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }
}
