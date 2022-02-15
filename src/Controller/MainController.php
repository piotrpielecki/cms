<?php

namespace App\Controller;

use App\Repository\CarRepository;
use App\Service\SearchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     * @var CarRepository
     */
    private $carRepository;
    /**
     * @var SearchService
     */
    private $searchService;

    public function __construct(CarRepository $carRepository, SearchService $searchService)
    {
        $this->carRepository = $carRepository;
        $this->searchService = $searchService;
    }

    /**
     * @Route("/main", name="main")
     */
    public function index(Request $request): Response
    {
//        if (!$this->getUser()) {
//            return $this->redirectToRoute("app_login");
//        }
        if ($request->getMethod() == "POST") {
            $results = $this->searchService->search($request->request->all());
        } else {
            $results = $this->carRepository->getAvailableCars();
        }



        return $this->render('main/index.html.twig', [
            'carList' => $results,
        ]);
    }
}
