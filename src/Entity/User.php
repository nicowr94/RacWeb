<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_8D93D649F85E0677", columns={"username"}), @ORM\UniqueConstraint(name="UNIQ_8D93D649E7927C74", columns={"email"})})
 * @ORM\Entity
 */
class User implements  UserInterface, \Serializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=100, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=45, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="roles", type="string", length=15, nullable=false)
     */
    private $roles;

    /**
     * @var int
     *
     * @ORM\Column(name="sys_val", type="integer", nullable=false)
     */
    private $sysVal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sys_time", type="date", nullable=false)
     */
    private $sysTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
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

    public function getRoles()
    {

        return[
            $this->roles
        ];
    }

    public function getRolesString()
    {
        return $this->roles;
    }



    public function setRoles(string $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getSysVal(): ?int
    {
        return $this->sysVal;
    }

    public function setSysVal(int $sysVal): self
    {
        $this->sysVal = $sysVal;

        return $this;
    }

    public function getSysTime(): ?\DateTimeInterface
    {
        return $this->sysTime;
    }

    public function setSysTime(\DateTimeInterface $sysTime): self
    {
        $this->sysTime = $sysTime;

        return $this;
    }

    public function getSalt(){}
    public function eraseCredentials(){}

    public function serialize(){
        return serialize([
            $this->id,
            $this->username,
            $this->email,
            $this->password,
        ]);
    }
    public function unserialize($string){
        list(
            $this->id,
            $this->username,
            $this->email,
            $this->password,
            ) = unserialize($string, ['allowed_classes'=>false]);
    }



}
