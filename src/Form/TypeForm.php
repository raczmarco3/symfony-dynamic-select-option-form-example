<?php

namespace App\Form;

use App\Entity\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormInterface;

class TypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeofnumber', ChoiceType::class, ['choices' => ["Even" => "even", "Odd" => "odd"], 'label' => 'Type:', 'attr' => array('onchange' => 'showData()')])
        ;

        $formModifier = function (FormInterface $form, $typeOfNumber) {
            $choices = $this->getNumbers($typeOfNumber);

            $form->add('number', ChoiceType::class,
                ['choices' => $choices, 'label' => 'Number:']);  
                $form->add('save', SubmitType::class);
        };
        
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                $data = $event->getData();
                $formModifier($event->getForm(), $data->getTypeOfNumber());
            }
        );

        $builder->get('typeofnumber')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $typeOfNumber = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $typeOfNumber);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Type::class,
        ]);
    }

    public function getNumbers($type)
    {
        if($type == 'even') {
            return [
                '0' => '0', 
                '2' => '2',
                '4' => '4',
                '6' => '6',
                '8' => '8',
            ];
        } else if ($type == 'odd') {
            return [
                '1' => '1', 
                '3' => '3',
                '5' => '5',
                '7' => '7',
                '9' => '9',
            ];
        }
        return [
            '0' => '0', 
            '2' => '2',
            '4' => '4',
            '6' => '6',
            '8' => '8',
        ];        
    }
}
