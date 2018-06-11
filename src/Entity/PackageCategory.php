<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\PersistentCollection;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Table(name="tbl_package_category")
 * @ORM\Entity(repositoryClass="App\Repository\PackageCategoryRepository")
 * @ApiResource
 */
class PackageCategory
{
    /**
     * @var int The id of this package type
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The shortname of the package type
     *
     * @ORM\Column(type="string", length=15)
     */
    private $shortname;

    /**
     * @var string The longname of the package type
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $longname;

    /**
     * @var string The packages list in this package type
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

    public function __toString()
    {
        return $this->getShortname();
    }

}
