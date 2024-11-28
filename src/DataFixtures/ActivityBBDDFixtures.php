<?php

namespace App\DataFixtures;

use App\Entity\ActivityBBDD;
use App\Entity\Subcategory;
use App\Entity\Provinces;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\DependencyInjection\Attribute\When;

class ActivityBBDDFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Relacionar Subcategorías y Provincias con las actividades
        $activities = [
            // Álava
            [
                'name' => 'Senderismo en el Parque Natural de Gorbeia',
                'subcategory' => 'Senderismo',
                'province' => 'Álava',
            ],
            // Albacete
            [
                'name' => 'Barranquismo en el río Mundo',
                'subcategory' => 'Barranquismo',
                'province' => 'Albacete',
            ],
            // Alicante
            [
                'name' => 'Escalada en el Peñón de Ifach',
                'subcategory' => 'Escalada Deportiva',
                'province' => 'Alicante',
            ],
            // Almería
            [
                'name' => 'Snorkel en las playas de Cabo de Gata',
                'subcategory' => 'Snorkel',
                'province' => 'Almería',
            ],
            // Asturias
            [
                'name' => 'Raquetas de nieve en los Picos de Europa',
                'subcategory' => 'Raquetas de nieve',
                'province' => 'Asturias',
            ],
            // Ávila
            [
                'name' => 'Escalada clásica en Gredos',
                'subcategory' => 'Escalada Clasica',
                'province' => 'Ávila',
            ],
            // Badajoz
            [
                'name' => 'Puenting en el embalse de Orellana',
                'subcategory' => 'Puenting',
                'province' => 'Badajoz',
            ],
            // Barcelona
            [
                'name' => 'Boulder en la montaña de Montserrat',
                'subcategory' => 'Boulder',
                'province' => 'Barcelona',
            ],
            // Burgos
            [
                'name' => 'Senderismo en el Cañón del río Lobos',
                'subcategory' => 'Senderismo',
                'province' => 'Burgos',
            ],
            // Cáceres
            [
                'name' => 'Via Ferrata en Monfragüe',
                'subcategory' => 'Via Ferrata',
                'province' => 'Cáceres',
            ],
            // Cádiz
            [
                'name' => 'Kitesurf en Tarifa',
                'subcategory' => 'Kitesurf',
                'province' => 'Cádiz',
            ],
            // Cantabria
            [
                'name' => 'Surf en la playa de Somo',
                'subcategory' => 'Surf',
                'province' => 'Cantabria',
            ],
            // Castellón
            [
                'name' => 'Escalada en la Sierra de Espadán',
                'subcategory' => 'Escalada Deportiva',
                'province' => 'Castellón',
            ],
            // Ciudad Real
            [
                'name' => 'Piragüismo en las Tablas de Daimiel',
                'subcategory' => 'Piraguismo',
                'province' => 'Ciudad Real',
            ],
            // Córdoba
            [
                'name' => 'Buceo en el embalse de Iznájar',
                'subcategory' => 'Buceo',
                'province' => 'Córdoba',
            ],
            // Cuenca
            [
                'name' => 'Via Ferrata en la Hoz de Priego',
                'subcategory' => 'Via Ferrata',
                'province' => 'Cuenca',
            ],
            // Girona
            [
                'name' => 'Esquí en la Vall de Núria',
                'subcategory' => 'Esquí alpino',
                'province' => 'Girona',
            ],
            // Granada
            [
                'name' => 'Snowboard en Sierra Nevada',
                'subcategory' => 'Snowboard',
                'province' => 'Granada',
            ],
            // Guadalajara
            [
                'name' => 'Senderismo en el Parque Natural del Alto Tajo',
                'subcategory' => 'Senderismo',
                'province' => 'Guadalajara',
            ],
            // Guipúzcoa
            [
                'name' => 'Surf en Zarautz',
                'subcategory' => 'Surf',
                'province' => 'Guipúzcoa',
            ],
            // Huelva
            [
                'name' => 'Paddle Surf en Doñana',
                'subcategory' => 'PaddelSurf',
                'province' => 'Huelva',
            ],
            // Huesca
            [
                'name' => 'Escalada en hielo en el Pirineo aragonés',
                'subcategory' => 'Escalada en hielo',
                'province' => 'Huesca',
            ],
            // Islas Baleares
            [
                'name' => 'Snorkel en Formentera',
                'subcategory' => 'Snorkel',
                'province' => 'Islas Baleares',
            ],
            // Jaén
            [
                'name' => 'Barranquismo en la Sierra de Cazorla',
                'subcategory' => 'Barranquismo',
                'province' => 'Jaén',
            ],
            // A Coruña
            [
                'name' => 'Paracaidismo en la Costa da Morte',
                'subcategory' => 'Paracaidismo',
                'province' => 'A Coruña',
            ],
            // La Rioja
            [
                'name' => 'Senderismo en la Sierra de la Demanda',
                'subcategory' => 'Senderismo',
                'province' => 'La Rioja',
            ],
            // Las Palmas
            [
                'name' => 'Buceo en el Arrecife de Arinaga',
                'subcategory' => 'Buceo',
                'province' => 'Las Palmas',
            ],
            // León
            [
                'name' => 'Escalada en Peña Ubiña',
                'subcategory' => 'Escalada Clasica',
                'province' => 'León',
            ],
            // Lleida
            [
                'name' => 'Esquí alpino en Baqueira-Beret',
                'subcategory' => 'Esquí alpino',
                'province' => 'Lleida',
            ],
            // Lugo
            [
                'name' => 'Barranquismo en la Sierra de Ancares',
                'subcategory' => 'Barranquismo',
                'province' => 'Lugo',
            ],
            // Madrid
            [
                'name' => 'Senderismo en la Sierra de Guadarrama',
                'subcategory' => 'Senderismo',
                'province' => 'Madrid',
            ],
            // Málaga
            [
                'name' => 'Kitesurf en la playa de El Palo',
                'subcategory' => 'Kitesurf',
                'province' => 'Málaga',
            ],
            // Murcia
            [
                'name' => 'Rafting en el río Segura',
                'subcategory' => 'Rafting',
                'province' => 'Murcia',
            ],
            // Navarra
            [
                'name' => 'Senderismo en la Selva de Irati',
                'subcategory' => 'Senderismo',
                'province' => 'Navarra',
            ],
            // Orense
            [
                'name' => 'Escalada en roca en la Ribeira Sacra',
                'subcategory' => 'Escalada Deportiva',
                'province' => 'Orense',
            ],
            // Palencia
            [
                'name' => 'Esquí de fondo en Fuentes Carrionas',
                'subcategory' => 'Esquí de fondo',
                'province' => 'Palencia',
            ],
            // Pontevedra
            [
                'name' => 'Surf en la playa de Patos',
                'subcategory' => 'Surf',
                'province' => 'Pontevedra',
            ],
            // Salamanca
            [
                'name' => 'Senderismo en Las Batuecas',
                'subcategory' => 'Senderismo',
                'province' => 'Salamanca',
            ],
            // Segovia
            [
                'name' => 'Raquetas de nieve en el Puerto de Navacerrada',
                'subcategory' => 'Raquetas de nieve',
                'province' => 'Segovia',
            ],
            // Sevilla
            [
                'name' => 'Puenting en el Guadalquivir',
                'subcategory' => 'Puenting',
                'province' => 'Sevilla',
            ],
            // Tarragona
            [
                'name' => 'Via Ferrata en Montsant',
                'subcategory' => 'Via Ferrata',
                'province' => 'Tarragona',
            ],
            // Teruel
            [
                'name' => 'Esquí en las pistas de Javalambre',
                'subcategory' => 'Esquí alpino',
                'province' => 'Teruel',
            ],
            // Toledo
            [
                'name' => 'Senderismo en los Montes de Toledo',
                'subcategory' => 'Senderismo',
                'province' => 'Toledo',
            ],
            // Valencia
            [
                'name' => 'Buceo en la Reserva de Tabarca',
                'subcategory' => 'Buceo',
                'province' => 'Valencia',
            ],
            // Valladolid
            [
                'name' => 'Senderismo en el Valle Esgueva',
                'subcategory' => 'Senderismo',
                'province' => 'Valladolid',
            ],
            // Vizcaya
            [
                'name' => 'Surf en Mundaka',
                'subcategory' => 'Surf',
                'province' => 'Vizcaya',
            ],
            // Zamora
            [
                'name' => 'Barranquismo en el río Duero',
                'subcategory' => 'Barranquismo',
                'province' => 'Zamora',
            ],
            // Zaragoza
            [
                'name' => 'Senderismo en el Moncayo',
                'subcategory' => 'Senderismo',
                'province' => 'Zaragoza',
            ],
        ];
        

        foreach ($activities as $activityData) {
            // Buscar la subcategoría por nombre
            $subcategory = $manager->getRepository(Subcategory::class)->findOneBy(['name' => $activityData['subcategory']]);
            
            // Buscar la provincia por nombre
            $province = $manager->getRepository(Provinces::class)->findOneBy(['name' => $activityData['province']]);
            
            // Verificar si la subcategoría y la provincia existen antes de crear la actividad
            if ($subcategory && $province) {
                $activity = new ActivityBBDD();
                $activity->setName($activityData['name']);
                $activity->setSubcategory($subcategory);
                $activity->addProvince($province);
                
                // Persistir la actividad
                $manager->persist($activity);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SubcategoryFixtures::class,
            ProvincesFixtures::class,
        ];
    }
}
