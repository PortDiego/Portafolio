<?php

// src/DataFixtures/ActivityBBDDFixtures.php

namespace App\DataFixtures;

use App\Entity\ActivityBBDD;
use App\Entity\Subcategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ActivityBBDDFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $activities = [
            ['name' => 'Via Ferrata Ventana del diablo, Cuenca', 'subcategory' => 'Via Ferrata'],
            ['name' => 'Via Ferrata Priego, Cuenca', 'subcategory' => 'Via Ferrata'],
            ['name' => 'Via Ferrata Hipocratica, Zaragoza', 'subcategory' => 'Via Ferrata'],
            ['name' => 'Via Ferrata La cala del Moli, Girona', 'subcategory' => 'Via Ferrata'],
            ['name' => 'Senderismo Pico Almenara, Madrid', 'subcategory' => 'Senderismo'],
            ['name' => 'Senderismo Peñalara, Madrid', 'subcategory' => 'Senderismo'],
            ['name' => 'Senderismo Cola de Caballo, Huesca', 'subcategory' => 'Senderismo'],
            ['name' => 'Senderismo Mampodre, LEon', 'subcategory' => 'Senderismo'],
            ['name' => 'Escalada Deportiva Patones, Madrid', 'subcategory' => 'Escalada Deportiva'],
            ['name' => 'Escalada Deportiva Calcena, Zaragoza', 'subcategory' => 'Escalada Deportiva'],
            ['name' => 'Escalada Deportiva Rodenal del Cabriel, Cuenca', 'subcategory' => 'Escalada Deportiva'],
            ['name' => 'Escalada Deportiva Pantano de San Juan, Madrid', 'subcategory' => 'Escalada Deportiva'],
            ['name' => 'Boulder Zarzalejo, Madrid', 'subcategory' => 'Boulder'],
            ['name' => 'Boulder La pedriza, Madrid', 'subcategory' => 'Boulder'],
            ['name' => 'Boulder Navalosa, Avila', 'subcategory' => 'Boulder'],
            ['name' => 'Boulder Candelario, Salamanca', 'subcategory' => 'Boulder'],
            ['name' => 'Boulder Hoya Moros, Salamanca', 'subcategory' => 'Boulder'],
            ['name' => 'Boulder Albarracin, Teruel', 'subcategory' => 'Boulder'],
            ['name' => 'Escalada Clasica Calcena, Zaragoza', 'subcategory' => 'Escalada Calsica'],
            ['name' => 'Escalada Clasica Pico Uriellu, Asturias', 'subcategory' => 'Escalada Clasica'],
            ['name' => 'Escalada Clasica Fuente de, Asturias', 'subcategory' => 'Escalada Clasica'],
            ['name' => 'Escalada Clasica Ubiñas, Asturias', 'subcategory' => 'Escalada Clasica'],
            ['name' => 'Alpinismo Bola del Mundo, Madrid', 'subcategory' => 'Alpinismo'],
            ['name' => 'Alpinismo Mampodre, Leon', 'subcategory' => 'Alpinismo'],
            ['name' => 'Alpinismo Pico Ubiña, Asturias', 'subcategory' => 'Alpinismo'],
            ['name' => 'Alpinismo Maliciosa, Madrid', 'subcategory' => 'Alpinismo'],
            ['name' => 'Paracaidismo Madrid, Madrid', 'subcategory' => 'Paracaidismo'],
            ['name' => 'Paracaidismo Albacete, Albacete', 'subcategory' => 'Paracaidismo'],
            ['name' => 'Puenting Gascones, Madrid', 'subcategory' => 'Puenting'],
            ['name' => 'Puenting Murillo de Gallego, Zaragoza', 'subcategory' => 'Puenting'],
            ['name' => 'Natacion Pantano de San Juan, Madrid', 'subcategory' => 'Natacion'],
            ['name' => 'Natacion Burguillos, Avila', 'subcategory' => 'Natacion'],
            ['name' => 'Surf San Martin, Asturias', 'subcategory' => 'Surf'],
            ['name' => 'Surf San Antolin, Asturias', 'subcategory' => 'Surf'],
            ['name' => 'PaddelSurf Pantano de San Juan, Madrid', 'subcategory' => 'PaddelSurf'],
            ['name' => 'PaddelSurf Burguillos, Avila', 'subcategory' => 'PaddelSurf'],
            ['name' => 'KiteSurf Sant Pere Pescador, Girona', 'subcategory' => 'KiteSurf'],
            ['name' => 'Snorkel Playa Les Rotes, Alicante', 'subcategory' => 'Snorkel'],
            ['name' => 'Puenting Gascones, Madrid', 'subcategory' => 'Puenting'], 
            ['name' => 'Piraguismo Río Sella, Asturias', 'subcategory' => 'Piraguismo'],
            ['name' => 'Piraguismo Río Jucar, Cuenca', 'subcategory' => 'Piraguismo'],
            ['name' => 'Buceo Isleta del Moro', 'subcategory' => 'Buceo'],
            ['name' => 'Barranquismo cañon del rio Vero, Huesca', 'subcategory' => 'Barranquismo'],
            ['name' => 'Barranquismo cañon del Formiga, Huesca', 'subcategory' => 'Barranquismo'],
            ['name' => 'Rafting Sort, Lleida', 'subcategory' => 'Rafting'],
            ['name' => 'Rafting Llavorsi, Lleida', 'subcategory' => 'Rafting'],
            ['name' => 'Esqui Grandvalira, Andorra', 'subcategory' => 'Esqui'],
            ['name' => 'Esqui Sierra Nevada, Granada', 'subcategory' => 'Esqui'],
            ['name' => 'Snowboard Formigal, Huesca', 'subcategory' => 'Snowboard'],
            ['name' => 'Snowboard Sierra Nevada, Granada', 'subcategory' => 'Snowboard'],
            ['name' => 'Esqui de fondo Canencia, Madrid', 'subcategory' => 'Esqui de fondo'],
            ['name' => 'Esqui alpino Sierra nevada , Granada', 'subcategory' => 'Esqui alpino'],
            ['name' => 'Esqui de travesia Canencia, Madrid', 'subcategory' => 'Esqui de travesia'],
            ['name' => 'Freestyle, Granada', 'subcategory' => 'Freestyle'],
            ['name' => 'Raquetas de nieve Guadarrama, Madrid', 'subcategory' => 'Raquetas de nieve'],
            ['name' => 'Raquetas de nieve Canencia, Madrid', 'subcategory' => 'Raquetas de nieve'],
        ];

        foreach ($activities as $activityData) {
            $subcategory = $manager->getRepository(Subcategory::class)->findOneBy(['name' => $activityData['subcategory']]);
            if ($subcategory) {
                $activity = new ActivityBBDD();
                $activity->setName($activityData['name']);
                $activity->setSubcategory($subcategory);
                $manager->persist($activity);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SubcategoryFixtures::class,
        ];
    }
}