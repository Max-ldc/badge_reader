<?php

namespace App\Controller;

use App\Repository\BadgeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class BadgeController extends AbstractController
{
    #[Route('/badge', name: 'badge_list', methods: [Request::METHOD_GET])]
    public function index(BadgeRepository $badgeRepository, SerializerInterface $serializer): Response
    {
        $badgeList = $badgeRepository->findAll();
        return $this->json($badgeList, status: Response::HTTP_OK, context: ['groups' => 'badge:reader']);
    }
}
