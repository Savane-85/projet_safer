<?php

namespace App\Controller\Admin;
use App\Entity\Biens;
use App\Entity\Categorie;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
// use App\Controller\Admin\BienCrudController;
class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //  return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
                $url = $routeBuilder->setController(BiensCrudController::class)->generateUrl();
        
                return $this->redirect($url);

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Projetsafer');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Safer', 'fas fa-list', Biens::class);
        yield MenuItem::linkToCrud('categorie', 'fas fa-list', Categorie::class);

        // yield MenuItem::linkToCrud('logout', 'fas fa-list' ,logout::class);

    }
}
