<?php

declare(strict_types=1);

namespace Tomsgu\SyliusGiftPlugin\Form\Type;

use Sylius\Bundle\ChannelBundle\Form\Type\ChannelChoiceType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Valid;

final class GiftOptionType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('channel', ChannelChoiceType::class, [
                'label' => 'sylius.ui.channel',
            ])
            ->add('enabled', CheckboxType::class, [
                'label' => 'sylius.ui.enabled',
            ])
            ->add('orderNote', TextAreaType::class, [
                'label' => 'tomsgu_sylius_gift.ui.order_note',
                'empty_data' => '',
                'validation_groups' => ['tomsgu_gift_option'],
            ])
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => GiftOptionTranslationType::class,
                'label' => 'sylius.ui.translations',
                'validation_groups' => ['tomsgu_gift_option'],
                'constraints' => [new Valid()],
            ])
        ;
    }
}
