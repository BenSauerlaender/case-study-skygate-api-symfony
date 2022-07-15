<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity('email')]
class User
{
    //Validation RegEx
    const WORD_REGEX = "[a-zA-ZÄÖÜäöüß]{2,}";
    const WORDS_REGEX = "/^(" . User::WORD_REGEX . "[ ])*" . User::WORD_REGEX . "$/";
    const NUMBER_REGEX = "/^[0-9]+$/";
    const PHONE_NUMBER_REGEX = "/^[0-9 +\-()\/.x]*$/";

    public static function onlyNumbers($s)
    {
        return preg_replace("/[^0-9]/", "", $s);
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Email]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Regex(User::WORDS_REGEX)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Length(min: 5, max: 5)]
    #[Assert\Regex(User::NUMBER_REGEX)]
    private ?string $postcode = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Regex(User::WORDS_REGEX)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Length(
        min: 8,
        max: 5,
        normalizer: "App\Entity\User::onlyNumbers",
    )]
    #[Assert\Regex(User::PHONE_NUMBER_REGEX)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private ?string $hashed_pass = null;

    #[ORM\Column]
    #[Assert\NotNull]
    private ?bool $verified = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Type('string')]
    #[Assert\Length(min: 10, max: 10)]
    #[Assert\Regex(User::NUMBER_REGEX)]
    private ?string $verification_code = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    private ?int $refreshTokenCount = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull]
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
        $this->email = $email;

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
}
