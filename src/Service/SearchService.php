<?php


namespace App\Service;


use App\Repository\CarRepository;

class SearchService
{
    /**
     * @var CarRepository
     */
    private $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function search(Array $criteria)
    {
        return $this->carRepository->mySearch($criteria);
    }
}