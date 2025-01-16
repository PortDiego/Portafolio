<?php

// src/DataFixtures/ProvincesFixtures.php
namespace App\DataFixtures;

use App\Entity\Provinces;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProvincesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $provinces = [
            'Álava', 'Albacete', 'Alicante', 'Almería', 'Asturias', 'Ávila', 'Badajoz', 'Barcelona',
            'Burgos', 'Cáceres', 'Cádiz', 'Cantabria', 'Castellón', 'Ciudad Real', 'Córdoba', 'Cuenca',
            'Girona', 'Granada', 'Guadalajara', 'Guipúzcoa', 'Huelva', 'Huesca',
            'Islas Baleares', 'Jaén', 'A Coruña', 'La Rioja', 'Las Palmas', 'León', 'Lleida',
            'Lugo', 'Madrid', 'Málaga', 'Murcia', 'Navarra', 'Orense', 'Palencia', 'Pontevedra',
            'Salamanca', 'Segovia', 'Sevilla', 'Soria', 'Tarragona', 'Teruel', 'Toledo', 'Valencia', 'Valladolid',
            'Vizcaya', 'Zamora', 'Zaragoza'
        ];

        foreach ($provinces as $provinceName) {
            $province = new Provinces();
            $province->setName($provinceName);
            $manager->persist($province);
        }

        $manager->flush();
    }
}
