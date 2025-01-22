<?php

namespace App\Controller\Admin;

use App\Entity\CrmProspect;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class AdminDashboardController extends AbstractDashboardController
{

    public function configureActions(): Actions
    {
        return parent::configureActions()
            ->update(Crud::PAGE_INDEX, Action::NEW, fn (Action $action) => $action->setIcon('fa fa-plus')->setLabel(false))
            ->update(Crud::PAGE_INDEX, Action::EDIT, fn (Action $action) => $action->setIcon('fas fa-edit')->setLabel(false))
            ->update(Crud::PAGE_INDEX, Action::DELETE, fn (Action $action) => $action->setIcon('fas fa-trash-alt')->setLabel(false))
            ->update(Crud::PAGE_DETAIL, Action::DELETE, fn (Action $action) => $action->setIcon('fas fa-trash-alt')->setLabel(false))
            ->update(Crud::PAGE_DETAIL, Action::INDEX, fn (Action $action) => $action->setIcon('fas fa-list')->setLabel(false))
            ->update(Crud::PAGE_DETAIL, Action::EDIT, fn (Action $action) => $action->setIcon('fas fa-edit')->setLabel(false))
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, fn (Action $action) => $action->setIcon('fas fa-save')->setLabel(false))
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, fn (Action $action) => $action->setIcon('far fa-edit')->setLabel(false))
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, fn (Action $action) => $action->setIcon('fas fa-save')->setLabel(false))
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER, fn (Action $action) => $action->setIcon('far fa-edit')->setLabel(false));
    }

    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addCssFile('styles/admin.css');
    }

    public function configureCrud(): Crud
    {
        return parent::configureCrud()
            ->showEntityActionsInlined();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('wwwQuarIT <sup>admin</sup>');
    }

    #[Route('/admin', name: 'admin_index')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::section('CRM'),
            MenuItem::linkToCrud('Interessenten', null, CrmProspect::class),
        ];
    }

    public function configureUserMenu(UserInterface $user): UserMenu {
        return parent::configureUserMenu($user)
            ->setMenuItems([
                MenuItem::linkToUrl('www.quarit.ch', 'fa fa-paper-plane', '/'),
                MenuItem::linkToLogout('Abmelden', 'fa fa-sign-out'),
            ]);
    }
}
