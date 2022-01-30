<?php

declare(strict_types=1);

namespace Tomsgu\SyliusGiftPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class GiftOptionTranslationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label', TextAreaType::class, [
                'label' => 'tomsgu_sylius_gift.ui.gift_option_label',
                'empty_data' => '',
            ]);
    }
}
