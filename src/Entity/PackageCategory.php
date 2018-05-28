<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PackageTypeRepository")
 */
class PackageCategory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $shortname;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $longname;


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
        if (!is_null($this->longname)) {
            return $this->longname;
        }

        return $this->shortname;
    }

    public function setLongname(?string $longname): self
    {
        $this->longname = $longname;

        return $this;
    }

}
