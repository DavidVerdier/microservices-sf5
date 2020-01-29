<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
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
 *        },
 *       "delete"={
 *            "access_control"="true"
 *        },
 *    }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\MailsRepository")
 */
class Mails
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Groups({"mail"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Groups({"mail"})
     */
    private $type;

    /**
     * @ORM\Column(type="json", nullable=true)
     * @Groups({"mail"})
     */
    private $data;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"mail"})
     */
    private $fromEmail;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"mail:read"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"mail"})
     */
    private $sentAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ToEmails", mappedBy="mail", cascade={"persist"}, orphanRemoval=true)
     * @Groups({"mail"})
     */
    private $toEmails;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->toEmails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = strtolower($type);

        return $this;
    }

    public function getData(): ?string
    {
        return $this->data;
    }

    public function setData(string $data): self
    {
        $this->data = stripslashes(trim($data));

        return $this;
    }

    public function getFromEmail(): ?string
    {
        return $this->fromEmail;
    }

    public function setFromEmail(string $fromEmail): self
    {
        $this->fromEmail = $fromEmail;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getSentAt(): ?\DateTimeInterface
    {
        return $this->sentAt;
    }

    public function setSentAt(?\DateTimeInterface $sentAt): self
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    /**
     * @return Collection|ToEmails[]
     */
    public function getToEmails(): Collection
    {
        return $this->toEmails;
    }

    public function addToEmail(ToEmails $toEmail): self
    {
        if (!$this->toEmails->contains($toEmail)) {
            $this->toEmails[] = $toEmail;
            $toEmail->setMail($this);
        }

        return $this;
    }

    public function removeToEmail(ToEmails $toEmail): self
    {
        if ($this->toEmails->contains($toEmail)) {
            $this->toEmails->removeElement($toEmail);
            // set the owning side to null (unless already changed)
            if ($toEmail->getMail() === $this) {
                $toEmail->setMail(null);
            }
        }

        return $this;
    }
}
