<?php declare(strict_types=1);

namespace App\Form;

use App\Entity\EntityA;
use App\Entity\EntityB;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkingEntityAForm extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm (FormBuilderInterface $builder, array $options) : void
    {
        // Add some other unrelated entries to the form
        $builder
            ->add("something", null, [
                "label" => "Some random, unrelated property",
            ]);

        $builder
            ->addEventListener(FormEvents::POST_SET_DATA, static function (FormEvent $event) : void
            {
                /** @var EntityA $entityA */
                $entityA = $event->getData();
                $entityC = $entityA->getEntityC();
                $form = $event->getForm();

                $form
                    ->add("entityB", EntityType::class, [
                        "label" => "Entity B not being pre-selected",
                        "class" => EntityB::class,
                        "placeholder" => "(None selected)",
                        "query_builder" => static function (EntityRepository $repository) use ($entityC)
                        {
                            return $repository->createQueryBuilder("entity_b")
                                ->andWhere("entity_b.entityC = :entityC")
                                ->setParameter("entityC", $entityC)
                                ->addOrderBy("entity_b.label", "ASC");
                        },
                        "choice_label" => "label",
                        "required" => false,
                    ]);
            });
    }


    /**
     * @inheritdoc
     */
    public function configureOptions (OptionsResolver $resolver) : void
    {
        $resolver
            ->setDefaults([
                "translation_domain" => "form",
                "data_class" => EntityA::class,
            ]);
    }
}
