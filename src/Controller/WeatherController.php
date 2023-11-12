<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\MeasurementRepository;
use App\Service\WeatherUtil;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    #[Route('/weather/{name}/{city}', name: 'app_weather')]
    public function city(
        #[MapEntity (mapping: ['name'=>'city','city'=>'country'])]
        Location $location,
        WeatherUtil $util,
    ): Response
    {
        $measurements =$util->getWeatherForLocation($location);

        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $measurements,
        ]);
    }

}