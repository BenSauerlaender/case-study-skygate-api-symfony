<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $postcode = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $hashed_pass = null;

    #[ORM\Column]
    private ?bool $verified = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $verification_code = null;

    #[ORM\Column]
    private ?int $refreshTokenCount = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Role $role = null;

    #[ORM\OneToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
    private ?EmailChangeRequest $emailChangeRequest = null;

    public static function create(?string $email, ?string $name, ?string $postcode, ?string $city, ?string $phone, ?string $password, ?Role $role, ?string $code): self
    {
        $user = new self();
        $user->setEmail($email);
        $user->setName($name);
        $user->setPostcode($postcode);
        $user->setCity($city);
        $user->setPhone($phone);
        $user->setHashedPass($password);
        $user->setRole($role);
        $user->setVerified(false);
        $user->setRefreshTokenCount(0);
        $user->setVerificationCode($code);
        return $user;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = strtolower($email);

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(?string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getHashedPass(): ?string
    {
        return $this->hashed_pass;
    }

    public function setHashedPass(?string $hashed_pass): self
    {
        $this->hashed_pass = $hashed_pass;

        return $this;
    }

    public function isVerified(): ?bool
    {
        return $this->verified;
    }

    public function setVerified(?bool $verified): self
    {
        $this->verified = $verified;

        return $this;
    }

    public function getVerificationCode(): ?string
    {
        return $this->verification_code;
    }

    public function setVerificationCode(?string $verification_code): self
    {
        $this->verification_code = $verification_code;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getEmailChangeRequest(): ?EmailChangeRequest
    {
        return $this->emailChangeRequest;
    }

    public function setEmailChangeRequest(?EmailChangeRequest $emailChangeRequest): self
    {
        $this->emailChangeRequest = $emailChangeRequest;

        return $this;
    }

    public function getRefreshTokenCount(): ?int
    {
        return $this->refreshTokenCount;
    }

    public function setRefreshTokenCount(?int $refreshTokenCount): self
    {
        $this->refreshTokenCount = $refreshTokenCount;

        return $this;
    }

    public function increaseRefreshTokenCount(): self
    {
        $this->refreshTokenCount++;
        return $this;
    }


    public function verify(string $code): bool
    {
        if ($code !== $this->getVerificationCode()) return false;

        $this->setVerified(true);
        $this->setVerificationCode(null);
        return true;
    }

    public function getPublicArray(): array
    {
        return [
            "id" => $this->getId(),
            "email" => $this->getEmail(),
            "name" => $this->getName(),
            "postcode" => $this->getPostcode(),
            "city" => $this->getCity(),
            "phone" => $this->getPhone(),
            "role" => $this->getRole()->getName(),
            "verified" => $this->isVerified(),
        ];
    }
}
