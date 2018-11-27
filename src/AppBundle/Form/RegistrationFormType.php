<?php
/**
 * Created by PhpStorm.
 * User: AlaDin
 * Date: 20/09/2018
 * Time: 19:20
 */

namespace AppBundle\Form;


use AppBundle\AppBundle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

            $builder
            ->add('nom')->add('prenom')->add('num_tel')->add('num_fix')->add('adress')->add('deponse')->add('restPay')->add('credit')
                ->add('clientAdmin');

    }
    public function getName(){
            return AppBundle\Form;
    }
    public function getParent()
    {
        return BaseRegistrationFormType::class;
    }


}