<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: 'order_details')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $price = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $price_discount = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $price_total = null;


    #[ORM\Column(length: 255)]
    private ?string $address_holder = null;

    #[ORM\Column(length: 255)]
    private ?string $address_line1 = null;

    #[ORM\Column(length: 255)]
    private ?string $address_line2 = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $postal_code = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $e_mail = null;


    #[ORM\OneToMany(mappedBy: 'order_details', targetEntity: OrderItems::class)]
    private Collection $orderItems;

    #[ORM\ManyToOne(inversedBy: 'userOrders')]
    private ?User $user = null;

    public function __construct()
    {
        $this->orderItems = new ArrayCollection();
    }

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

    public function getPriceDiscount(): ?string
    {
        return $this->price_discount;
    }

    public function setPriceDiscount(string $price_discount): static
    {
        $this->price_discount = $price_discount;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, OrderItems>
     */
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function addOrderItem(OrderItems $orderItem): static
    {
        if (!$this->orderItems->contains($orderItem)) {
            $this->orderItems->add($orderItem);
            $orderItem->setOrderDetails($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItems $orderItem): static
    {
        if ($this->orderItems->removeElement($orderItem)) {
            // set the owning side to null (unless already changed)
            if ($orderItem->getOrderDetails() === $this) {
                $orderItem->setOrderDetails(null);
            }
        }

        return $this;
    }

    public function getAdressHolder(): ?string
    {
        return $this->address_holder;
    }

    public function setAddressHolder(?string $address_holder): static
    {
        $this->address_holder = $address_holder;

        return $this;
    }

    public function getAddressLine1(): ?string
    {
        return $this->address_line1;
    }

    public function setAddressLine1(string $address_line1): static
    {
        $this->address_line1 = $address_line1;

        return $this;
    }

    public function getAddressLine2(): ?string
    {
        return $this->address_line2;
    }

    public function setAddressLine2(string $address_line2): static
    {
        $this->address_line2 = $address_line2;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postal_code;
    }

    public function setPostalCode(int $postal_code): static
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->e_mail;
    }

    public function setEmail(string $e_mail): static
    {
        $this->e_mail = $e_mail;

        return $this;
    }
}
