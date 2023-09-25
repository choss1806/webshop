<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class G_UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getUserData() as [$first_name, $last_name, $e_mail, $phone]) {
            $user = new User();
            $user->setFirstName($first_name);
            $user->setLastName($last_name);
            $user->setEmail($e_mail);
            $user->setPhone($phone);
            $manager->persist($user);
        }

        $manager->flush();
    }

    private function getUserData()
    {
        return [
            ['Ivo', 'Ivić', 'ivo.ivic@gmail.com', '+385 99 370 6584'],
            ['Pero', 'Perić', 'pero.peric@gmail.com', '+385 92 421 6996']
        ];
    }
}
