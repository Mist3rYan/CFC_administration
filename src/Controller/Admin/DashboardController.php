<?php

namespace App\Controller\Admin;

use App\Entity\Club;
use App\Entity\Continent;
use App\Entity\Pays;
use App\Entity\Question;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator // Vous pouvez injecter des services dans les contrôleurs
    ) {
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator // Génère l'URL de la page de liste pour l'entité Continent
            ->setController(ContinentCrudController::class)
            ->generateUrl();
        return $this->redirect($url); // Redirige vers la page de liste de l'entité Continent
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<i class="fa fa-futbol"></i>  &nbsp;  Administration CFC'); // Utilisation de la classe Font Awesome
    }

    public function configureMenuItems(): iterable // Permet de configurer le menu de gauche
    {
        yield MenuItem::subMenu('Continents', 'fa fa-globe')->setSubItems([
            MenuItem::linkToCrud('Ajouter un continent', 'fa fa-plus', Continent::class)->setAction('new'),
            MenuItem::linkToCrud('Liste des continents', 'fa fa-list', Continent::class)->setAction('index'),
        ]);
        yield MenuItem::subMenu('Pays', 'fa fa-flag')->setSubItems([
            MenuItem::linkToCrud('Ajouter un pays', 'fa fa-plus', Pays::class)->setAction('new'),
            MenuItem::linkToCrud('Liste des pays', 'fa fa-list', Pays::class)->setAction('index'),
        ]);
        yield MenuItem::subMenu('Clubs', 'fa fa-shield')->setSubItems([
            MenuItem::linkToCrud('Ajouter un club', 'fa fa-plus', Club::class)->setAction('new'),
            MenuItem::linkToCrud('Liste des clubs', 'fa fa-list', Club::class)->setAction('index'),
        ]);
        yield MenuItem::subMenu('Questions', 'fa fa-question-circle')->setSubItems([
            MenuItem::linkToCrud('Ajouter une question', 'fa fa-plus', Question::class)->setAction('new'),
            MenuItem::linkToCrud('Liste des questions', 'fa fa-list', Question::class)->setAction('index'),
        ]);
    }
}
