<?php

namespace App\Controller\Admin;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use App\Entity\Biens;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
class BiensCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Biens::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
      
        yield AssociationField::new('categorie');
        yield TextField::new('reference');
        yield TextField::new('intitule');
        yield TextField::new('desciptif');
        yield TextField::new('localisation');
        yield NumberField::new('surface');
        yield NumberField::new('prix');
        yield TextField::new('type');
        yield ImageField::new('image')->setBasePath('uploads/images/')->setUploadDir('public/uploads/images/');;
        

    }
    
}
