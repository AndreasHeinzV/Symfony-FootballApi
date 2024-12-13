<?php

declare(strict_types=1);

namespace App\Components\UserRegister\Communication\Form;

use App\Validator\UniqueEmail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegisterForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Firstname',
                'attr' => ['class' => 'form-input'],
                'label_attr' => ['class' => 'form-label'],
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Lastname',
                'attr' => ['class' => 'form-input'],
                'label_attr' => ['class' => 'form-label'],
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['class' => 'form-input'],
                'label_attr' => ['class' => 'form-label'],
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Email(['message' => 'Please enter a valid email address']),
                    new UniqueEmail(),
                ],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'required' => true,
                'first_options' => [
                    'label' => 'Password',
                    'attr' => ['class' => 'password-field'],
                    'label_attr' => ['class' => 'form-label'],
                ],
                'second_options' => [
                    'label' => 'Repeat password',
                    'attr' => ['class' => 'password-field'],
                    'label_attr' => ['class' => 'form-label'],
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 8,
                        'max' => 50,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'maxMessage' => 'Your password cannot be longer than {{ limit }} characters',
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Register',
                'attr' => ['class' => 'form-button'],
            ]);
    }
}
