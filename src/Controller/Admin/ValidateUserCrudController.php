<?php

namespace App\Controller\Admin;

use App\Entity\ValidateUser;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ValidateUserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ValidateUser::class;
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
