<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\MailsRepository")
 */
class Mails
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subject;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $from_email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $sentAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ToEmails", mappedBy="mail", orphanRemoval=true)
     */
    private $toEmails;

    public function __construct()
    {
        $this->toEmails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getFromEmail(): ?string
    {
        return $this->from_email;
    }

    public function setFromEmail(string $from_email): self
    {
        $this->from_email = $from_email;

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
