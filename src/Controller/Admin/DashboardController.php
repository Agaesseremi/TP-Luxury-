<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use App\Controller\Admin\ClientsCrudController;
use App\Controller\Admin\OffersCrudController;
use App\Controller\Admin\UserCrudController;

class DashboardController extends AbstractDashboardController
{

    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
            ->setController(UserCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    }
    #[Route('/clients', name: 'app_admin_clients')]
    public function clients(): Response
    {
        $url = $this->adminUrlGenerator
            ->setController(ClientsCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    }

    #[Route('/joboffers', name: 'app_admin_joboffers')]
    public function jobOffers(): Response
    {
        $url = $this->adminUrlGenerator
            ->setController(OffersCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('LuxuryService Dashboard');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard(UserCrudController::class, 'fa fa-money', 'admin');
        yield MenuItem::linkToRoute(ClientsCrudController::class, 'fa fa-home', 'app_admin_clients');
        yield MenuItem::linkToRoute(OffersCrudController::class, 'fa fa-home', 'app_admin_joboffers');
    }
}
