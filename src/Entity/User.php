<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $first_name = null;

    #[ORM\Column(length: 255)]
    private ?string $last_name = null;

    #[ORM\Column(length: 255)]
    private ?string $e_mail = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserAddress::class)]
    private Collection $userAddresses;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Order::class)]
    private Collection $userOrders;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ContractList::class)]
    private Collection $contractLists;

    public function __construct()
    {
        $this->userAddresses = new ArrayCollection();
        #$this->userOrders = new ArrayCollection();
        #$this->contractLists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection<int, UserAddress>
     */
    public function getUserAddresses(): Collection
    {
        return $this->userAddresses;
    }

    public function addUserAddress(UserAddress $userAddress): static
    {
        if (!$this->userAddresses->contains($userAddress)) {
            $this->userAddresses->add($userAddress);
            $userAddress->setUser($this);
        }

        return $this;
    }

    public function removeUserAddress(UserAddress $userAddress): static
    {
        if ($this->userAddresses->removeElement($userAddress)) {
            // set the owning side to null (unless already changed)
            if ($userAddress->getUser() === $this) {
                $userAddress->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getUserOrders(): Collection
    {
        return $this->userOrders;
    }

    public function addUserOrder(Order $userOrder): static
    {
        if (!$this->userOrders->contains($userOrder)) {
            $this->userOrders->add($userOrder);
            $userOrder->setUser($this);
        }

        return $this;
    }

    public function removeUserOrder(Order $userOrder): static
    {
        if ($this->userOrders->removeElement($userOrder)) {
            // set the owning side to null (unless already changed)
            if ($userOrder->getUser() === $this) {
                $userOrder->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ContractList>
     */
    public function getContractLists(): Collection
    {
        return $this->contractLists;
    }

    public function addContractList(ContractList $contractList): static
    {
        if (!$this->contractLists->contains($contractList)) {
            $this->contractLists->add($contractList);
            $contractList->setUser($this);
        }

        return $this;
    }

    public function removeContractList(ContractList $contractList): static
    {
        if ($this->contractLists->removeElement($contractList)) {
            // set the owning side to null (unless already changed)
            if ($contractList->getUser() === $this) {
                $contractList->setUser(null);
            }
        }

        return $this;
    }
}
