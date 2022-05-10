<?php

namespace App\Form;

use App\Entity\Course;
use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,
            [
                'label' => 'Student Name',
                'required' => true
            ])
            ->add('age', IntegerType::class,
            [
                'label' => 'Age',
                'required' => true
            ])
            ->add('birthplace', TextType::class,
            [
                'label' => 'Birthplace',
                'required' => true
            ])
            ->add('code', TextType::class,
            [
                'label' => 'Student ID',
                'required' => true
            ])
            ->add('gmail', TextType::class,
            [
                'label' => 'Gmail',
                'required' => true
            ])
            ->add('course', EntityType::class,
            [
                'label' => 'Student Course',
                'class' => Course::class,
                'choice_label' => "name", //show Course name is dropdown list
                'multiple' => true,
                'expanded' => false
            ])
            ->add('image', TextType::class,
            [
                'label' => 'Student Image',
                'required' => true
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
