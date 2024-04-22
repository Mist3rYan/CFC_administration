<?php

namespace App\Controller\Admin;

use App\Entity\Pays;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PaysCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pays::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            ImageField::new('flag', 'Drapeau')->setUploadDir('public/uploads/images/flags')->setBasePath('uploads/images/flags')->setSortable(false),
            TextField::new('fr_name', 'Nom FR'),
            TextField::new('en_name', 'Nom EN')->onlyOnForms()->addCssClass('hidden'),
            TextField::new('es_name', 'Nom ES')->onlyOnForms()->addCssClass('hidden'),
            AssociationField::new('continent')->setQueryBuilder(function (QueryBuilder $queryBuilder) {
                $queryBuilder->where('entity.isActive = 1');
            }),
            BooleanField::new('active'),
            DateTimeField::new('updateAt', 'Mise à jour')->hideOnForm(),
            DateTimeField::new('createdAt', 'Création')->hideOnForm(),
        ];
    }

    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Pays) {
            return;
        }

        foreach ($entityInstance->getClubs() as $club) { // Suppression des clubs
            foreach ($club->getQuestions() as $question) { // Suppression des questions en rapport avec le club
                $entityManager->remove($question);
            }
            $entityManager->remove($club);
        }

        foreach ($entityInstance->getQuestions() as $question) { // Suppression des questions en rapport avec le pays
            $entityManager->remove($question);
        }
        parent::deleteEntity($entityManager, $entityInstance);
    }
}
