<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

#[ORM\Entity(repositoryClass: 'App\Repository\PasswordResetTokenRepository')]
class PasswordResetToken
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\Column(type: 'string', length: 255)]
    private $token;

    #[ORM\Column(type: 'datetime')]
    private $expiresAt;

    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
        $this->expiresAt = new \DateTime('+1 hour');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    // Método para obtener la fecha de expiración
    public function getExpiresAt(): ?\DateTimeInterface
    {
        return $this->expiresAt;
    }

    // Método para actualizar la fecha de expiración si es necesario
    public function setExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $this->expiresAt = $expiresAt;
        return $this;
    }

    // Método que verifica si el token ha expirado
    public function isExpired(): bool
    {
        return $this->expiresAt < new \DateTime();
    }
}