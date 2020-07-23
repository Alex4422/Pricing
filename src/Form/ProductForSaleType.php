<?php

namespace App\Form;

use App\Entity\ProductForSale;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductForSaleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product')
            ->add('user')
            ->add('state')
            ->add('prixPlancher')
            ->add('prixMax')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductForSale::class,
        ]);
    }
}
