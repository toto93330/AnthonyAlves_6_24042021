<?php

namespace App\Controller\Admin;

use App\Entity\ForgotPassword;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ForgotPasswordCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ForgotPassword::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
