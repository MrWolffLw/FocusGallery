<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PhotoController extends AbstractController
{

    #[Route('/photo/{id}', name: 'show')]
    public function show(Photo $photo){
        return $this->render('photo/show.html.twig', [
            'photo' => $photo,
      
        ]);

    }
}
