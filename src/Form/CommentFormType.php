<?php

namespace App\Form;

use App\Entity\Tag;
use App\Models\Comment;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class CommentFormType extends AbstractType
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->security->getUser();
        $builder
            ->setRequired(false)
            ->add('name', TextType::class,[
                'label'=>'Name',
                'data'=>$user->getFirstName(),
                'attr'=> [ 'readonly' => true ]
            ])
            ->add('email', TextType::class,[
                'label'=>'Email',
                'data'=>$user->getEmail(),
                'attr'=> [ 'readonly' => true ]
            ])
            ->add('text', TextareaType::class,[
                'label'=>'Comment',
            ])
            ->add('tags', EntityType::class, [
                'class'=>Tag::class,
                'expanded'  => true,
                'multiple'  => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>\App\Entity\Comment::class
        ]);
    }
}
