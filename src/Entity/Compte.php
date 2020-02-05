<?php

namespace App\Entity;

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\CompteController;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ComptesRepository")
 * @ApiResource(
 * denormalizationContext={"groups"={"post"}},
 * collectionOperations={
 *         "get"={
 *          "normalization_context"={"groups"={"get"}},},
 *         "post"={
 * "security"="is_granted(['ROLE_ADMIN_SYST','ROLE_ADMIN'])", "security_message"="Seul ADMIN_SYST peut creer un user",
 * "controller"=CompteController::class ,}
 *     },
 * itemOperations={
 *     "get"={ 
 * "security"="is_granted('ROLE_ADMIN_SYST')"},
 *      "put"={"security"="is_granted(['ROLE_ADMIN_SYST','ROLE_ADMIN'])", "security_message"="Seul ADMIN_SYST peut bloquer un user"}
 * }  )
 */
class Compte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $montantI;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("post")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="comptes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usercreateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Partenaire", inversedBy="comptes")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     * @Groups("post")
     */
    private $partenaire;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getMontantI(): ?string
    {
        return $this->montantI;
    }

    public function setMontantI(string $montantI): self
    {
        $this->montantI = $montantI;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
        $this->creatAt=  new \DateTime();
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUsercreateur(): ?User
    {
        return $this->usercreateur;
    }

    public function setUsercreateur(?User $usercreateur): self
    {
        $this->usercreateur = $usercreateur;

        return $this;
    }

    public function getPartenaire(): ?Partenaire
    {
        return $this->partenaire;
    }

    public function setPartenaire(?Partenaire $partenaire): self
    {
        $this->partenaire = $partenaire;

        return $this;
    }

    
}
