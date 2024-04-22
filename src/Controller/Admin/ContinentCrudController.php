<?php

namespace App\Controller\Admin;

use App\Entity\Continent;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ContinentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Continent::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('tag'),
            TextField::new('fr_name', 'Nom FR'),
            TextField::new('en_name', 'Nom EN'),
            TextField::new('es_name', 'Nom ES'),
            DateTimeField::new('updateAt', 'Mise à jour')->hideOnForm(),
            DateTimeField::new('createdAt', 'Création')->hideOnForm(),
            BooleanField::new('active'),
        ];
    }

    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Continent) {
            return;
        }

        foreach ($entityInstance->getPays() as $pays) {
            
            $entityManager->remove($pays);
        }
    }
}
