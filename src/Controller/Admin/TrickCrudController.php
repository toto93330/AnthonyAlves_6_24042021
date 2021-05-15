<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\Trick;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class TrickCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Trick::class;
    }


    public function configureFields(string $pageName): iterable
    {

        return [
            TextField::new('title'),
            SlugField::new('slug')->setTargetFieldName('title'),
            AssociationField::new('author'),
            AssociationField::new('category'),
            DateField::new('created_at'),
            ImageField::new('image_card')
                ->setBasePath('uploads/tricks/')
                ->setUploadDir('public/uploads/tricks')
                ->setFormType(FileUploadType::class)
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            TextEditorField::new('content'),
            BooleanField::new('edited'),
        ];
    }
}
