<?php

namespace App\Form;

use App\Entity\Produits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitsType extends AbstractType
{

    /**
     * @param $label
     * @param $placeholder
     * @return array
     */
    private function getConfiguration($label, $placeholder){
        return [
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ];
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,$this->getConfiguration("Nom du produit", "Entrez un nom de produit"))
            ->add('description', TextareaType::class, $this->getConfiguration("Description du produit", "Entrez une description détaillé du produit"))
            ->add('prix', MoneyType::class, $this->getConfiguration("Prix du produit", "Entrez le prix du produit"))
            ->add('photos', FileType::class,[
                'attr' => array(
                    'placeholder' => 'choisir une photo pour votre produit'
                ),
                'label' => 'Photo du produit',
                'required' => false
            ])
            ->add('Valider', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
