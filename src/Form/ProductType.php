<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Product;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ProductType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', IntegerType::class, [
                'label' => 'Product ID',
                'attr' => ['maxlength' => 13],
            ])
            ->add('name', TextType::class, [
                'label' => 'Product name',
                'attr' => ['maxlength' => 50],
            ])
            ->add('manager', TextType::class, [
                'label' => 'Product manager',
                'required' => false,
                'attr' => ['maxlength' => 30],
            ])
            ->add('salesStartDate', DateType::class, [
                'label' => 'Sales start date',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'html5' => false
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
            'csrf_protection' => true,
        ]);
    }
}