<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ToEmailsRepository")
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"mail", "mail:read"}},
 *     denormalizationContext={"groups"={"mail", "mail:write"}},
 *     collectionOperations={"post"},
 *     itemOperations={
 *       "get"={
 *            "access_control"="true"
 *        },
 *       "put"={
 *            "access_control"="true"
 *        }
 *    }
 * )
 */
class ToEmails
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"mail"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Mails", inversedBy="toEmails")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"mail"})
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"mail"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"mail"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"mail"})
     */
    private $lastName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMail(): ?Mails
    {
        return $this->mail;
    }

    public function setMail(?Mails $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }
}
