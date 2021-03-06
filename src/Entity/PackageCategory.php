<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\PersistentCollection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Table(name="tbl_package_category")
 * @ORM\Entity(repositoryClass="App\Repository\PackageCategoryRepository")
 * @ApiResource(
 *     collectionOperations={
 *         "get"
 *     },
 *     itemOperations={
 *         "get"
 *     }
 * )
 */
class PackageCategory
{
    /**
     * @var int The id of this package category
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var PackageCategory The parent of this category.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\PackageCategory", inversedBy="categories")
     * @ORM\JoinColumn(nullable=true)
     *
     * @Groups({"set"})
     * @ApiSubresource
     */
    private $parent;

    /**
     * @var string The categories children list of this package category
     *
     * @ORM\OneToMany(targetEntity="App\Entity\PackageCategory", mappedBy="parent", cascade={"persist", "remove"})
     */
    private $categories;

    /**
     * @var string The shortname of the package category
     *
     * @ORM\Column(type="string", length=15)
     *
     * @Groups({"set"})
     */
    private $shortname;

    /**
     * @var string The longname of the package category
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     *
     * @Groups({"set"})
     */
    private $longname;

    /**
     * @var string The packages list in this package category
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Package", mappedBy="category", cascade={"persist", "remove"})
     */
    private $packages;


    public function getId()
    {
        return $this->id;
    }

    public function getShortname(): ?string
    {
        return $this->shortname;
    }

    public function setShortname(string $shortname): self
    {
        $this->shortname = $shortname;

        return $this;
    }

    public function getLongname(): ?string
    {
        return $this->longname;
    }

    public function setLongname(?string $longname): self
    {
        $this->longname = $longname;

        return $this;
    }

    public function getPackages(): ?PersistentCollection
    {
        return $this->packages;
    }

    public function setPackage(Package $package): self
    {
        $this->packages = $package;

        // set the owning side of the relation if necessary
        if ($this !== $package->getCategory()) {
            $package->setCategory($this);
        }

        return $this;
    }

    public function getParent(): ?PackageCategory
    {
        return $this->parent;
    }

    public function setParent(PackageCategory $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function __toString()
    {
        return $this->getShortname();
    }

}
