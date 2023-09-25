<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\UserAddress;

class H_UserAddressFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getUserAddressData() as [$address_holder, $address_line1, $address_line2, $city, $postal_code, $country, $phone, $user_id]) {
            $user = $manager->getRepository(User::class)->find($user_id);
            $userAddress = new UserAddress();
            $userAddress->setAddressHolder($address_holder);
            $userAddress->setAddressLine1($address_line1);
            $userAddress->setAddressLine2($address_line2);
            $userAddress->setCity($city);
            $userAddress->setPostalCode($postal_code);
            $userAddress->setCountry($country);
            $userAddress->setPhone($phone);
            $userAddress->setUser($user);
            $manager->persist($userAddress);
        }

        $manager->flush();
    }

    private function getUserAddressData()
    {
        return [
            ['Ivo Ivić', 'Kolodvorska 10', '', 'Novska', '44330', 'Hrvatska', '+385 99 370 6584', 1],
            ['Ivo Ivić', 'Kolodvorska 11', '', 'Novska', '44330', 'Hrvatska', '+385 99 370 6584', 1],
            ['Pero Perić', 'Ilica 10', '2. kat', 'Zagreb', '10000', 'Hrvatska', '+385 92 421 6996', 2],
            ['Pero Perić', 'Ilica 11', '2. kat', 'Zagreb', '10000', 'Hrvatska', '+385 92 421 6996', 2]
        ];
    }
}
