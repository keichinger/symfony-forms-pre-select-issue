<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity()
 * @ORM\Table(name="entity_as")
 */
class EntityA
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
     * @ORM\ManyToOne(targetEntity="App\Entity\EntityC", inversedBy="entityAs")
     * @ORM\JoinColumn(name="entity_c_id")
     */
    private $entityC;

    /**
     * @var string|null
     * @ORM\Column(name="something", type="string", length=1000)
     * @Assert\Length(max="1000")
     * @Assert\NotBlank()
     */
    private $something;

    /**
     * @var EntityB|null
     * @ORM\ManyToOne(targetEntity="App\Entity\EntityB", inversedBy="entityAs")
     * @ORM\JoinColumn(name="entity_b_id")
     */
    private $entityB;


    /**
     * @param EntityC $entityC
     */
    public function __construct (EntityC $entityC)
    {
        $this->entityC = $entityC;
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
     * @return string|null
     */
    public function getSomething () : ?string
    {
        return $this->something;
    }


    /**
     * @param string|null $something
     */
    public function setSomething (?string $something) : void
    {
        $this->something = $something;
    }


    /**
     * @return EntityB|null
     */
    public function getEntityB () : ?EntityB
    {
        return $this->entityB;
    }


    /**
     * @param EntityB|null $entityB
     */
    public function setEntityB (?EntityB $entityB) : void
    {
        $this->entityB = $entityB;
    }
}
