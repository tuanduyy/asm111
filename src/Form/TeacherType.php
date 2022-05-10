<?php

namespace App\Form;

use App\Entity\Course;
use App\Entity\Teacher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class TeacherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,
            [
                'label' => 'Teacher Name',
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
            ->add('gmail', TextType::class,
            [
                'label' => 'Gmail',
                'required' => true
            ])
            ->add('course', EntityType::class,
            [
                'label' => 'Teacher Course',
                'class' => Course::class,
                'choice_label' => "name", //show Course name is dropdown list
                'multiple' => true,
                'expanded' => false
                
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Teacher::class,
        ]);
    }
}
