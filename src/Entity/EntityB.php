<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity()
 * @ORM\Table(name="entity_bs")
 */
class EntityB
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     *
     * @var int|null
     */
    private $id;

    /**
     * @var EntityC
     * @ORM\ManyToOne(targetEntity="App\Entity\EntityC", inversedBy="entityBs")
     */
    private $entityC;

    /**
     * @var EntityA[]|Collection
     * @ORM\OneToMany(targetEntity="App\Entity\EntityA", mappedBy="entityB")
     */
    private $entityAs;

    /**
     * @var string|null
     * @ORM\Column(name="label", type="string", length=1000)
     * @Assert\Length(max="1000")
     * @Assert\NotBlank()
     */
    private $label;


    /**
     * @param EntityC $entityC
     */
    public function __construct (EntityC $entityC)
    {
        $this->entityC = $entityC;
        $this->entityAs = new ArrayCollection();
    }


    /**
     * @return int|null
     */
    public function getId () : ?int
    {
        return $this->id;
    }


    /**
     * @return EntityC
     */
    public function getEntityC () : EntityC
    {
        return $this->entityC;
    }


    /**
     * @return EntityA[]|Collection
     */
    public function getEntityAs () : Collection
    {
        return $this->entityAs;
    }


    /**
     * @return string|null
     */
    public function getLabel () : ?string
    {
        return $this->label;
    }


    /**
     * @param string|null $label
     */
    public function setLabel (?string $label) : void
    {
        $this->label = $label;
    }
}
