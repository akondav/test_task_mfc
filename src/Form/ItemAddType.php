<?php

namespace App\Form;

use App\Entity\QueryMfc;
use App\Entity\ImagesMfc;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;



class ItemAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Заголовок'])
            ->add('image', FileType::class, [
                'label' => 'Выберите изображение(-я): ',
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])
            ->add('mainText', TextareaType::class, ['label' => 'Основной текст'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => QueryMfc::class,
        ]);
    }
}
