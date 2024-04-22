<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $fr_question = null;

    #[ORM\Column(length: 255)]
    private ?string $en_question = null;

    #[ORM\Column(length: 255)]
    private ?string $es_question = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updateAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    private ?Club $club = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    private ?Pays $pays = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\Column(length: 255)]
    private ?string $fr_1 = null;

    #[ORM\Column(length: 255)]
    private ?string $fr_2 = null;

    #[ORM\Column(length: 255)]
    private ?string $fr_3 = null;

    #[ORM\Column(length: 255)]
    private ?string $fr_correct = null;

    #[ORM\Column(length: 255)]
    private ?string $en_1 = null;

    #[ORM\Column(length: 255)]
    private ?string $en_2 = null;

    #[ORM\Column(length: 255)]
    private ?string $en_3 = null;

    #[ORM\Column(length: 255)]
    private ?string $en_correct = null;

    #[ORM\Column(length: 255)]
    private ?string $es_1 = null;

    #[ORM\Column(length: 255)]
    private ?string $es_2 = null;

    #[ORM\Column(length: 255)]
    private ?string $es_3 = null;

    #[ORM\Column(length: 255)]
    private ?string $es_correct = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFrQuestion(): ?string
    {
        return $this->fr_question;
    }

    public function setFrQuestion(string $fr_question): static
    {
        $this->fr_question = $fr_question;

        return $this;
    }

    public function getEnQuestion(): ?string
    {
        return $this->en_question;
    }

    public function setEnQuestion(string $en_question): static
    {
        $this->en_question = $en_question;

        return $this;
    }

    public function getEsQuestion(): ?string
    {
        return $this->es_question;
    }

    public function setEsQuestion(string $es_question): static
    {
        $this->es_question = $es_question;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?\DateTimeImmutable $updateAt): static
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): static
    {
        $this->club = $club;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function __toString(): string
    {
        return $this->fr_question;
    }

    public function getFr1(): ?string
    {
        return $this->fr_1;
    }

    public function setFr1(string $fr_1): static
    {
        $this->fr_1 = $fr_1;

        return $this;
    }

    public function getFr2(): ?string
    {
        return $this->fr_2;
    }

    public function setFr2(string $fr_2): static
    {
        $this->fr_2 = $fr_2;

        return $this;
    }

    public function getFr3(): ?string
    {
        return $this->fr_3;
    }

    public function setFr3(string $fr_3): static
    {
        $this->fr_3 = $fr_3;

        return $this;
    }

    public function getFrCorrect(): ?string
    {
        return $this->fr_correct;
    }

    public function setFrCorrect(string $fr_correct): static
    {
        $this->fr_correct = $fr_correct;

        return $this;
    }

    public function getEn1(): ?string
    {
        return $this->en_1;
    }

    public function setEn1(string $en_1): static
    {
        $this->en_1 = $en_1;

        return $this;
    }

    public function getEn2(): ?string
    {
        return $this->en_2;
    }

    public function setEn2(string $en_2): static
    {
        $this->en_2 = $en_2;

        return $this;
    }

    public function getEn3(): ?string
    {
        return $this->en_3;
    }

    public function setEn3(string $en_3): static
    {
        $this->en_3 = $en_3;

        return $this;
    }

    public function getEnCorrect(): ?string
    {
        return $this->en_correct;
    }

    public function setEnCorrect(string $en_correct): static
    {
        $this->en_correct = $en_correct;

        return $this;
    }

    public function getEs1(): ?string
    {
        return $this->es_1;
    }

    public function setEs1(string $es_1): static
    {
        $this->es_1 = $es_1;

        return $this;
    }

    public function getEs2(): ?string
    {
        return $this->es_2;
    }

    public function setEs2(string $es_2): static
    {
        $this->es_2 = $es_2;

        return $this;
    }

    public function getEs3(): ?string
    {
        return $this->es_3;
    }

    public function setEs3(string $es_3): static
    {
        $this->es_3 = $es_3;

        return $this;
    }

    public function getEsCorrect(): ?string
    {
        return $this->es_correct;
    }

    public function setEsCorrect(string $es_correct): static
    {
        $this->es_correct = $es_correct;

        return $this;
    }
}
