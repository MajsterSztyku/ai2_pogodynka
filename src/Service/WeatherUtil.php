<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Location;
use App\Entity\Measurement;
use App\Repository\LocationRepository;
use App\Repository\MeasurementRepository;

class WeatherUtil
{
    public function __construct(
        private MeasurementRepository $measurementRepository,
        private LocationRepository    $locationRepository,
    ){

    }
    /**
     * @return Measurement[]
     */
    public function getWeatherForLocation(Location $location): array
    {
        $forecasts = $this->measurementRepository->findByLocation($location);
        return $forecasts;
    }

    /**
     * @return Measurement[]
     */
    public function getWeatherForCountryAndCity(string $countryCode, string $city): array
    {
        $location = $this->locationRepository->findOneBy(['city' =>$city,'country'=>$countryCode]);
        return $this->getWeatherForLocation($location);
    }
}
