<?php

namespace App\Form;

use App\Entity\Course;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,
            [
                'label' => 'Course Name',
                'required' => true
            ])
            ->add('code', TextType::class,
            [
                'label' => 'Course Code',
                'required' => true
            ])
            // ->add('students', TextType::class,
            // [
            //     'label' => 'Student',
            //     'required' => true
            // ])
            // ->add('teachers', TextType::class,
            // [
            //     'required' => true
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
        ]);
    }
}
