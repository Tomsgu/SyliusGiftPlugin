<?php

declare(strict_types=1);

namespace Tomsgu\SyliusGiftPlugin\Form\Type;

use Sylius\Bundle\CoreBundle\Form\Type\Checkout\CompleteType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Tomsgu\SyliusGiftPlugin\Service\GiftOptionContextInterface;

class CheckoutCompleteType extends AbstractTypeExtension
{
    public function __construct(private GiftOptionContextInterface $giftOptionContext)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $giftOption = $this->giftOptionContext->getGiftOption();

        $builder
            ->add('notes', TextareaType::class, [
                'label' => 'sylius.form.notes',
                'required' => false,
            ]);
        if ($giftOption !== null && $giftOption->isEnabled() === true) {
            $builder
                ->add('gift_option', CheckboxType::class, [
                    'label' => $giftOption->getLabel(),
                    'required' => false,
                    'translation_domain' => false,
                    'mapped' => false,
                ]);
        }
    }

    public static function getExtendedTypes(): iterable
    {
        return [CompleteType::class];
    }
}
