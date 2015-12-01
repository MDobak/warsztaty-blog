<?php

namespace Connectmedica\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class PostType
 */
class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                'label' => 'Tytuł'
            ])
            ->add('content', 'ckeditor', [
                'label' => 'Treść',
                'attr'  => [
                    'rows' => 10
                ]
            ])
            ->add('submit', 'submit', [
                'label' => 'Wyślij'
            ])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Connectmedica\BlogBundle\Entity\Post'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'connectmedica_blogbundle_post';
    }
}
