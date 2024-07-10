<?php

namespace App\Controller\Admin;

use App\Entity\VeterinaryClinic;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\Translation\TranslatableMessage;

class VeterinaryClinicCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VeterinaryClinic::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Cliniques vétérinaires')
            ->setEntityLabelInSingular('Clinique vétérinaire')
            ->setPageTitle('index', "VetoCompar - Administration des cliniques vétérinaires")
            ->setPageTitle('edit', "Editer la clinique vétérinaire")
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', new TranslatableMessage('Nom')),
            EmailField::new('email'),
            AssociationField::new('address', new TranslatableMessage('Adresse'))->renderAsEmbeddedForm(),
            CollectionField::new('owner', new TranslatableMessage('Propriétaire(s)'))->useEntryCrudForm(UserCrudController::class),
        ];
    }

}
