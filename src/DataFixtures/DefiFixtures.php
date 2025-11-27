<?php

namespace App\DataFixtures;

use App\Entity\Defi;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DefiFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $d1 = new Defi();
        $d1->setTitre("Boire 2 litres d'eau");
        $d1->setDescription("Défi santé pour rester hydraté");
        $d1->setDifficulte("Facile");
        $d1->setDuree(1);
        $d1->setDatePublication(new \DateTimeImmutable());
        $manager->persist($d1);

        $d2 = new Defi();
        $d2->setTitre("Lire 10 pages");
        $d2->setDescription("Défi lecture");
        $d2->setDifficulte("Moyen");
        $d2->setDuree(1);
        $d2->setDatePublication(new \DateTimeImmutable());
        $manager->persist($d2);

        $manager->flush();
    }
}
