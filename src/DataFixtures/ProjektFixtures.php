<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Projekt;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Role\Role;

class ProjektFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
       $projekt= new Projekt();
       $projekt->setProBez('Nature');
       $projekt->addBenutzer($this->getReference('benutzer_1'));
       $manager->persist($projekt);
    

       $manager->flush();
    }
}