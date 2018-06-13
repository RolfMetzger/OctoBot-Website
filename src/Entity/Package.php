<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use App\Entity\PackageCategory;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;

/**
 * @ORM\Table(name="tbl_package")
 * @ORM\Entity(repositoryClass="App\Repository\PackageRepository")
 * @ApiResource(
 *     collectionOperations={
 *         "get"
 *     },
 *     itemOperations={
 *         "get"
 *     }
 * )
 */
class Package
{
    /**
     * @var int The id of this package.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The owner of the package.
     *
     * @ORM\Column(type="integer")
     */
    private $owner;

    /**
     * @var string The author of the package.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $vendor;

    /**
     * @var string The name of the package.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var string The version of the package.
     *
     * @ORM\Column(type="string", length=25)
     */
    private $version;

    /**
     * @var PackageCategory The type of package.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\PackageCategory", inversedBy="packages")
     * @ORM\JoinColumn(nullable=false)
     *
     * @ApiSubresource
     */
    private $category;

    /**
     * @var string The description of the package.
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var string The repository of the package.
     *
     * @Assert\Url()
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $repository;

    /**
     * @var string The web site of the package.
    *
     * @Assert\Url()
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @var string The creation date of the package.
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var string The updating date of the package.
     *
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;


    public function __construct(int $ownerUserId)
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
        $this->owner = $ownerUserId;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getVendor(): ?string
    {
        return $this->vendor;
    }

    public function setVendor(string $vendor): self
    {
        $this->vendor = $vendor;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->vendor.'/'.$this->name;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getRepository(): ?string
    {
        return $this->repository;
    }

    public function setRepository(?string $repository): self
    {
        $this->repository = $repository;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    private function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCategory(): ?PackageCategory
    {
        return $this->category;
    }

    public function setCategory(PackageCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function setOwner(int $owner): self
    {
        $this->owner = $owner;
        return $this;
    }

}
