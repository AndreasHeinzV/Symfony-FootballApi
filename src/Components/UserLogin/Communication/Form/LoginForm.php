<?php

declare(strict_types=1);

namespace App\Components\UserLogin\Communication\Form;

use App\Validator\UniqueEmail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class LoginForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
            ->add('password', PasswordType::class, [
                'label' => 'Password',
                'attr' => ['class' => 'form-input'],
                'label_attr' => ['class' => 'form-label'],
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('rememberMe', CheckboxType::class, [
                'label' => 'Remember me',
                'attr' => ['class' => 'form-check-input'],
                'label_attr' => ['class' => 'form-check-label'],
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Login',
                'attr' => ['class' => 'form-button'],
            ]);
    }
}
