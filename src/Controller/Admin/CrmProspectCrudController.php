<?php

namespace App\Controller\Admin;

use App\Entity\CrmProspect;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CrmProspectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CrmProspect::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Interessent')
            ->setEntityLabelInPlural('Interessenten');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            FormField::addPanel('Basisdaten'),
            TextField::new('name', 'Name')
                ->setColumns(6),
            TextField::new('email', 'E-Mail-Adresse')
                ->setColumns(6),
            DateTimeField::new('createdAt', 'Erstellungszeitpunkt')
                ->setFormat('dd.MM.yyyy, HH:mm')
                ->hideOnForm(),
        ];
    }

}
