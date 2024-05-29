<?php

namespace App\Controller\Admin;

use App\Entity\Question;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class QuestionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Question::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('Question'),
            IdField::new('id')->hideOnForm(),
            TextField::new('fr_question', 'Question FR'),
            TextField::new('en_question', 'Question EN')->onlyOnForms()->addCssClass('hidden'),
            TextField::new('es_question', 'Question ES')->onlyOnForms()->addCssClass('hidden'),
            TextField::new('fr_1', 'Réponse 1 FR')->setColumns(4),
            TextField::new('en_1', 'Réponse 1 EN')->onlyOnForms()->addCssClass('hidden')->setColumns(4),
            TextField::new('es_1', 'Réponse 1 ES')->onlyOnForms()->addCssClass('hidden')->setColumns(4),
            TextField::new('fr_2', 'Réponse 2 FR')->setColumns(4),
            TextField::new('en_2', 'Réponse 2 EN')->onlyOnForms()->addCssClass('hidden')->setColumns(4),
            TextField::new('es_2', 'Réponse 2 ES')->onlyOnForms()->addCssClass('hidden')->setColumns(4),
            TextField::new('fr_3', 'Réponse 3 FR')->setColumns(4),
            TextField::new('en_3', 'Réponse 3 EN')->onlyOnForms()->addCssClass('hidden')->setColumns(4),
            TextField::new('es_3', 'Réponse 3 ES')->onlyOnForms()->addCssClass('hidden')->setColumns(4),
            TextField::new('fr_correct', 'Réponse correcte FR')->setColumns(4),
            TextField::new('en_correct', 'Réponse correcte EN')->onlyOnForms()->addCssClass('hidden')->setColumns(4),
            TextField::new('es_correct', 'Réponse correcte ES')->onlyOnForms()->addCssClass('hidden')->setColumns(4),
            FormField::addTab('Pays ou club associé'),
            AssociationField::new('pays')->setQueryBuilder(function (QueryBuilder $queryBuilder) {
                $queryBuilder->where('entity.isActive = 1');
            })->setColumns(6),
            AssociationField::new('club')->setQueryBuilder(function (QueryBuilder $queryBuilder) {
                $queryBuilder->where('entity.isActive = 1');
            })->setColumns(6),
            BooleanField::new('active'),
            BooleanField::new('world'),
            DateTimeField::new('updateAt', 'Mise à jour')->hideOnForm(),
            DateTimeField::new('createdAt', 'Création')->hideOnForm(),
        ];
    }
}
