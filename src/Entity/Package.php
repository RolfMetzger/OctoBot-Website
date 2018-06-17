<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use App\Entity\PackageCategory;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Serializer\Filter\GroupFilter;

/**
 * @ORM\Table(name="tbl_package")
 * @ORM\Entity(repositoryClass="App\Repository\PackageRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ApiResource(
 *     attributes={
 *         "order"={
 *             "public": "ASC",
 *             "name": "ASC"
 *         }
 *     },
 *     collectionOperations={
 *         "api_questions_answer_get_subresource"={
 *             "method"="GET", "normalization_context"={"groups"={"allowed_group"}}
 *         }
 *     },
 *     itemOperations={
 *         "get"={
 *              "access_control"="is_granted('ROLE_SUPER_ADMIN') or object.getOwner() == user or object.getPublic()",
 *              "access_control_message"="Sorry, but this package is not public."
 *          }
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
     *
     * @Groups({"get", "allowed_group"})
     */
    private $id;

    /**
     * @var User The owner of the package.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="packages")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Groups({"get", "allowed_group"})
     * @ApiSubresource
     */
    private $owner;

    /**
     * @var string The author of the package.
     *
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"get"})
     */
    private $vendor;


    /**
     * @var boolean Access of the packages
     *
     * @ORM\Column(type="boolean", options={"default":false})
     *
     * @Groups({"get", "allowed_group"})
     */
    private $public = false;

    /**
     * @var string The name of the package.
     *
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"get", "allowed_group"})
     */
    private $name;

    /**
     * @var string The version of the package.
     *
     * @ORM\Column(type="string", length=25)
     *
     * @Groups({"get", "allowed_group"})
     */
    private $version;

    /**
     * @var PackageCategory The type of package.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\PackageCategory", inversedBy="packages")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Groups({"get", "allowed_group"})
     * @ApiSubresource
     */
    private $category;

    /**
     * @var string The description of the package.
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({"get", "allowed_group"})
     */
    private $description;

    /**
     * @var string The repository of the package.
     *
     * @Assert\Url()
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Groups({"get"})
     */
    private $repository;

    /**
     * @var string The web site of the package.
    *
     * @Assert\Url()
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({"get"})
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


    public function __construct(User $owner)
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
        $this->owner = $owner;
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

    public function getOwner(): User
    {
        return $this->owner;
    }

    public function setOwner(User $owner): self
    {
        $this->owner = $owner;
        return $this;
    }

    public function getPublic(): bool
    {
        return $this->public;
    }

    public function setPublic(bool $public): self
    {
        $this->public = $public;
        return $this;
    }

    /**
     * @ORM\PreUpdate
     */
    public function updateDate()
    {
        $this->setUpdatedAt(new \DateTime());
    }
}
