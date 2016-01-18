<?php

// src/AppBundle/DataFixtures/ORM/LoadUserData.php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Content;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadContentData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $c1 = new Content();
        $c1->setName('Biuro 1');
        $c1->setKind('office');
        $c1->setDescription('Nowoczesne małe biuro 10m2');

        $c2 = new Content();
        $c2->setName('Biuro 2');
        $c2->setKind('office');
        $c2->setDescription('Idealne dla zespołu 30m2');

        $c3 = new Content();
        $c3->setName('Plac maszynowy');
        $c3->setKind('square');
        $c3->setDescription('Wielki plac na maszyny budowlane 1000m2');

        $c4 = new Content();
        $c4->setName('Magazyn na beczki');
        $c4->setKind('warehouse');
        $c4->setDescription('Magazyn o pojemności 1000m3');

        $c5 = new Content();
        $c5->setName('Hotel');
        $c5->setKind('other');
        $c5->setDescription('Hotel 4 gwiazdkowy koło lotniska');

        $c6 = new Content();
        $c6->setName('Imie pracownika');
        $c6->setKind('tel');
        $c6->setDescription('+XX XXX-XXX-XXX');


        $c7 = new Content();
        $c7->setName('nazwa_firmy');
        $c7->setKind('desc');
        $c7->setDescription('Fal-Bruk');

        $c8 = new Content();
        $c8->setName('opis_firmy');
        $c8->setKind('desc');
        $c8->setDescription('Miejsce na dłuższy tekst np 1 akapit - około 3-5 zdań.');

        $c9 = new Content();
        $c9->setName('place');
        $c9->setKind('desc');
        $c9->setDescription('Opis placy - 1 zdanie');

        $c10 = new Content();
        $c10->setName('biura');
        $c10->setKind('desc');
        $c10->setDescription('Opis biur - 1 zdanie');

        $c11 = new Content();
        $c11->setName('inne');
        $c11->setKind('desc');
        $c11->setDescription('Opis innych lokalizacji - 1 zdanie');

        $c12 = new Content();
        $c12->setName('garaze_warsztaty');
        $c12->setKind('desc');
        $c12->setDescription('Opis warsztatów - 1 zdanie');

        $c13 = new Content();
        $c13->setName('dane_firmy');
        $c13->setKind('desc');
        $c13->setDescription('2016 Spółka ... dane spółkie');

        $c14 = new Content();
        $c14->setName('adres');
        $c14->setKind('desc');
        $c14->setDescription('Miejsce na adres firmy');

        $c15 = new Content();
        $c15->setName('naglowek');
        $c15->setKind('desc');
        $c15->setDescription('Nagłówek na początku strony');

        $c16 = new Content();
        $c16->setName('tekst1');
        $c16->setKind('desc');
        $c16->setDescription('Wynajme bezpośredni! Nie jesteśmy agencją.');

        $c17 = new Content();
        $c17->setName('tekst1_podpis');
        $c17->setKind('desc');
        $c17->setDescription('#nie płacisz prowizji');

        $c18 = new Content();
        $c18->setName('tekst2');
        $c18->setKind('desc');
        $c18->setDescription('X lat doświadczenia!');

        $c19 = new Content();
        $c19->setName('tekst2_podpis');
        $c19->setKind('desc');
        $c19->setDescription('#czujesz się bezpiecznie');

        $c20 = new Content();
        $c20->setName('tekst3');
        $c20->setKind('desc');
        $c20->setDescription('Około Y klientów!');

        $c21 = new Content();
        $c21->setName('tekst3_podpis');
        $c21->setKind('desc');
        $c21->setDescription('#jesteś traktowany profesjolanie');

        $manager->persist($c1);
        $manager->persist($c2);
        $manager->persist($c3);
        $manager->persist($c4);
        $manager->persist($c5);
        $manager->persist($c6);
        $manager->persist($c7);
        $manager->persist($c8);
        $manager->persist($c9);
        $manager->persist($c10);
        $manager->persist($c11);
        $manager->persist($c12);
        $manager->persist($c13);
        $manager->persist($c14);
        $manager->persist($c15);
        $manager->persist($c16);
        $manager->persist($c17);
        $manager->persist($c18);
        $manager->persist($c19);
        $manager->persist($c20);
        $manager->persist($c21);
        $manager->flush();

    }

    public function getOrder()
    {
        return 20;
    }
}