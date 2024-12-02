<?php
namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reservationDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de réservation',
            ])
            ->add('reservationTime', TimeType::class, [
                'widget' => 'single_text',
                'label' => 'Heure de réservation',
            ])
            ->add('guestCount', IntegerType::class, [
                'label' => 'Nombre de personnes',
            ])
            ->add('specialRequests', TextType::class, [
                'label' => 'Demandes spéciales',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}