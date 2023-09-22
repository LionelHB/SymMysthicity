<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class EthController extends AbstractController
{
    #[Route('/eth', name: 'app_eth')]
    public function getEthereumData(HttpClientInterface $httpClient): Response
    {
        $response = $httpClient->request('GET', 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=eur&ids=ethereum%2Cbitcoin&order=market_cap_desc&per_page=10&page=1&sparkline=false&locale=fr', [
            'query' => [
                'vs_currency' => 'eur',
                'ids' => 'ethereum',
                'order' => 'market_cap_desc',
                'per_page' => 10,
                'page' => 1,
                'sparkline' => false,
                'locale' => 'fr',
            ],
        ]);

        $data = $response->toArray();

        if (isset($data[0]['current_price'])) {
            $ethData = $data[0];
        } else {
            $ethData = null;
        }

        return $this->render('eth/index.html.twig', [
            'ethData' => $ethData,
        ]);
    }
}
