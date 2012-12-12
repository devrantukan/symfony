<?php
// src/Acme/LibraryBundle/Form/Type/BookType.php

namespace Festival\FestivalBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FestivalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
        $builder->add('desc');
        $builder->add('lang');
        $builder->add('start');
        $builder->add('end');
        $builder->add('lat');
        $builder->add('lon');
        $builder->add('officialSiteUrl');
        $builder->add('facebookUrl');
        $builder->add('twitterUrl');
        $builder->add('youtubeUrl');
        $builder->add('wikipediaUrl');
        $builder->add('rssUrl');
        $builder->add('country');
        $builder->add('location');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Festival\FestivalBundle\Model\Festival',
        ));
    }

    public function getName()
    {
        return 'festival';
    }
}


