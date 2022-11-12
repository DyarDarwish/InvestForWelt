<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;


use App\Entity\Plz;
use App\Entity\Login;
use App\Entity\Rolle;
use App\Entity\Benutzer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Role\Role;

class BenutzerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $_rolle= new Rolle();
       $_rolle->setRollBez('Investor*in');
       $manager->persist($_rolle);

       $_login= new Login();
       $_login->setBenName('DyarDar');
       $_login->setPassword('123');
       $manager->persist($_login);

       $_plz= new PLZ();
       $_plz->setPlz('21335');
       $_plz->setOrt('lüneburg');
       $manager->persist($_plz);
       
       $plz= new Plz();

       $benutzer= new Benutzer();
       $benutzer->setBenName('Dyar');
       $benutzer->setLog($_login);
       $benutzer->setPlz($_plz );
       $benutzer->setRolle($_rolle);
       $manager->persist($benutzer);

       $manager->flush();

       $this->addReference('benutzer_1',$benutzer);
    }
}