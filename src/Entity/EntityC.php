<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="entity_cs")
 */
class EntityC
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
     * @var EntityA[]|Collection
     * @ORM\OneToMany(targetEntity="App\Entity\EntityA", mappedBy="entityC")
     */
    private $entityAs;

    /**
     * @var EntityB[]|Collection
     * @ORM\OneToMany(targetEntity="App\Entity\EntityB", mappedBy="entityC")
     */
    private $entityBs;


    /**
     */
    public function __construct ()
    {
        $this->entityAs = new ArrayCollection();
        $this->entityBs = new ArrayCollection();
    }


    /**
     * @return int|null
     */
    public function getId () : ?int
    {
        return $this->id;
    }


    /**
     * @return EntityA[]|Collection
     */
    public function getEntityAs () : Collection
    {
        return $this->entityAs;
    }


    /**
     * @return EntityB[]|Collection
     */
    public function getEntityBs () : Collection
    {
        return $this->entityBs;
    }
}
