<?php

namespace App\Controller;

use App\Service\HttpClientService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\GalleryRepository;
use App\Repository\NftRepository;
use App\Repository\SubCategoryRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class StatsController extends AbstractController
{
    #[Route('/stats', name: 'app_stats', methods: ['GET'])]
    public function index(
        HttpClientService $httpClientService,
        CategoryRepository $categoryRepository,
        UserRepository $userRepository,
        SubCategoryRepository $subCategoryRepository,
        NftRepository $nftRepository,
        GalleryRepository $galleryRepository,
        Request $request
    ): Response {
        $categoriesCount = count($categoryRepository->findAll());
        $subCategoriesCount = count($subCategoryRepository->findAll());
        $usersCount = count($userRepository->findAll());
        $nftsCount = count($nftRepository->findAll());
        $galleriesCount = count($galleryRepository->findAll());

        return $this->render('stats/index.html.twig', [
            'categoriesCount' => $categoriesCount,
            'subCategoriesCount' => $subCategoriesCount,
            'usersCount' => $usersCount,
            'nftsCount' => $nftsCount,
            'galleriesCount' => $galleriesCount,
        ]);
    }
}


