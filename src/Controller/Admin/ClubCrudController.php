<?php

namespace App\Controller\Admin;

use App\Entity\Club;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ClubCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Club::class;
    }

    public function configureFields(string $pageName): iterable
    {
        // Liste de couleurs HTML de base
        $basicColors = [
            'Red' => '#ff0000',
            'Green' => '#00ff00',
            'Blue' => '#0000ff',
            'Yellow' => '#ffff00',
            'Orange' => '#ffa500',
            'Purple' => '#800080',
            'Black' => '#000000',
            'White' => '#ffffff',
            'Gray' => '#808080',
            'Brown' => '#a52a2a',
            'Pink' => '#ffc0cb',
            'Cyan' => '#00ffff',
            'Magenta' => '#ff00ff',
            'Lime' => '#00ff00',
            'Teal' => '#008080',
            'Indigo' => '#4b0082',
            'Maroon' => '#800000',
            'Navy' => '#000080',
            'Olive' => '#808000',
            'Silver' => '#c0c0c0',
            'Sky Blue' => '#87ceeb',
            'Violet' => '#ee82ee',
            'Turquoise' => '#40e0d0',
            'Gold' => '#ffd700',
            'Beige' => '#f5f5dc',
            'Salmon' => '#fa8072',
            'Coral' => '#ff7f50',
            'Khaki' => '#f0e68c',
            'Aquamarine' => '#7fffd4',
            'Crimson' => '#dc143c',
            'Lavender' => '#e6e6fa',
            'Plum' => '#dda0dd',
            'Tomato' => '#ff6347',
            // Ajoute d'autres couleurs si nécessaire
        ];

        // Champ de choix de couleur avec personnalisation de l'affichage
        $colorField = ChoiceField::new('colorPrimary')
            ->setLabel('Couleur principale')
            ->setChoices($basicColors)
            ->setFormTypeOptions([
                'attr' => ['style' => 'width: 300px'], // Ajustez la largeur selon vos préférences
            ])
            ->renderAsNativeWidget(); // Utilise un widget natif pour la sélection de couleur


        // Champ de choix de couleur
        $colorField2 = ChoiceField::new('colorSecondary')
            ->setLabel('Couleur secondaire')
            ->setChoices($basicColors)
            ->setFormTypeOptions([
                'attr' => ['style' => 'width: 300px'], // Ajustez la largeur selon vos préférences
            ])
            ->renderAsNativeWidget(); // Utilise un widget natif pour la sélection de couleur

        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('fr_name', 'Nom FR'),
            TextField::new('en_name', 'Nom EN'),
            TextField::new('es_name', 'Nom ES'),
            $colorField,
            $colorField2,
            AssociationField::new('pays')->setQueryBuilder(function (QueryBuilder $qb) {
                $qb->where('entity.isActive = true');
            }),
            BooleanField::new('active'),
            DateTimeField::new('updateAt', 'Mise à jour')->hideOnForm(),
            DateTimeField::new('createdAt', 'Création')->hideOnForm(),
        ];
    }
    /*
    MANIERE DE FAIRE SANS: EventSubscriber
    
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Club) {
            return;
        }
        $entityInstance->setCreatedAt(new \DateTimeImmutable());
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Club) {
            return;
        }
        $entityInstance->setUpdateAt(new \DateTimeImmutable());
        parent::updateEntity($entityManager, $entityInstance);
    }*/

    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Club) {
            return;
        }

        foreach ($entityInstance->getQuestions() as $question) {
            $entityManager->remove($question);
        }
        parent::deleteEntity($entityManager, $entityInstance);
    }
}
