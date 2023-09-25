<?php

namespace App\Entity;

use App\Repository\PriceListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PriceListRepository::class)]
class PriceList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'price_list', targetEntity: PriceListItems::class)]
    private Collection $priceListItems;

    public function __construct()
    {
        $this->priceListItems = new ArrayCollection();
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
     * @return Collection<int, PriceListItems>
     */
    public function getPriceListItems(): Collection
    {
        return $this->priceListItems;
    }

    public function addPriceListItem(PriceListItems $priceListItem): static
    {
        if (!$this->priceListItems->contains($priceListItem)) {
            $this->priceListItems->add($priceListItem);
            $priceListItem->setPriceList($this);
        }

        return $this;
    }

    public function removePriceListItem(PriceListItems $priceListItem): static
    {
        if ($this->priceListItems->removeElement($priceListItem)) {
            // set the owning side to null (unless already changed)
            if ($priceListItem->getPriceList() === $this) {
                $priceListItem->setPriceList(null);
            }
        }

        return $this;
    }
}
