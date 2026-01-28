<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Photo;
use App\Repository\CategoryRepository;
use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/{id<\d+>}', name: 'index')]
    public function index(CategoryRepository $repo,PhotoRepository $PhotoRepository, $id=null): Response
    {
       if ($id) {
        $category = $repo->find($id);
        $photos = $category ? $category->getPhotos() : [];
        }else{
            $photos = $PhotoRepository->findAll();
        }
        

        return $this->render('home/index.html.twig', [
            'categories' => $repo->findAll(),
            'photos'=> $photos
        ]);
        
    }
    
   
}
