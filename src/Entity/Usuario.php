<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UsuarioRepository::class)
 */
class Usuario implements UserInterface
{
    const REGISTRO_EXITOSO = 'Registro Exitoso';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estado;

    /**
     * @ORM\OneToMany(targetEntity=UsuarioRol::class, mappedBy="usuario")
     */
    private $usuarioRols;

    public function __construct()
    {
        $this->estado = true;
        $this->roles = [];
        $this->usuarioRols = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEstado(): ?bool
    {
        return $this->estado;
    }

    public function setEstado(bool $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * @return Collection|UsuarioRol[]
     */
    public function getUsuarioRols(): Collection
    {
        return $this->usuarioRols;
    }

    public function addUsuarioRol(UsuarioRol $usuarioRol): self
    {
        if (!$this->usuarioRols->contains($usuarioRol)) {
            $this->usuarioRols[] = $usuarioRol;
            $usuarioRol->setUsuario($this);
        }

        return $this;
    }

    public function removeUsuarioRol(UsuarioRol $usuarioRol): self
    {
        if ($this->usuarioRols->removeElement($usuarioRol)) {
            // set the owning side to null (unless already changed)
            if ($usuarioRol->getUsuario() === $this) {
                $usuarioRol->setUsuario(null);
            }
        }

        return $this;
    }
}
