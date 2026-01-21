<?php

namespace App\Controller\Admin;

use App\Entity\Photo;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class PhotoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Photo::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titleFr'),
            TextField::new('titleEn'),
            TextareaField::new('descriptionFr'),
            TextAreaField::new('descriptionEn'),
            ImageField::new('imageName')
                  // Dossier serveur (chemin réel, relatif à /public)
            ->setUploadDir('public/uploads/images')

            // Chemin utilisé dans le HTML (<img src="">)
            ->setBasePath('/uploads/images')

            // Optionnel : nom du fichier généré
            ->setUploadedFileNamePattern('[slug]-[uuid].[extension]')
            ->setRequired($pageName !== Crud::PAGE_EDIT)
            ->setFormTypeOptions($pageName == Crud::PAGE_EDIT ? ['allow_delete' => false] : []),
            DateTimeField::new('updatedAt')->hideOnForm(),
            AssociationField::new('category')->autocomplete(),
        ];
    }

    public function 
    persistEntity(EntityManagerInterface $entityManager, $entity): void
    {
        $entity->setUpdatedAt(new DateTimeImmutable());
        parent::persistEntity($entityManager, $entity);
    }
    
    public function
    updateEntity(EntityManagerInterface $entityManager, $entity): void
    {
        $entity->setUpdatedAt(new DateTimeImmutable());
        parent::updateEntity($entityManager, $entity);
    }

    
}
