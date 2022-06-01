<?php

namespace App\Entity;

use App\Repository\SeancesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SeancesRepository::class)
 */
class Seances
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Patients::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $codeP;

    /**
     * @ORM\OneToMany(targetEntity=Soins::class, mappedBy="seances")
     */
    private $codeSoin;

    /**
     * @ORM\OneToOne(targetEntity=Soins::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $SoinsCode;

    public function __construct()
    {
        $this->codeSoin = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeP(): ?Patients
    {
        return $this->codeP;
    }

    public function setCodeP(Patients $codeP): self
    {
        $this->codeP = $codeP;

        return $this;
    }

    /**
     * @return Collection|Soins[]
     */
    public function getCodeSoin(): Collection
    {
        return $this->codeSoin;
    }

   
  

    public function getSoinsCode(): ?Soins
    {
        return $this->SoinsCode;
    }

    public function setSoinsCode(Soins $SoinsCode): self
    {
        $this->SoinsCode = $SoinsCode;

        return $this;
    }

    
}
