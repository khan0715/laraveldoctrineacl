<?php

namespace App\Domain\Entities;

use Doctrine\ORM\Mapping as ORM;
use LaravelDoctrine\ACL\Contracts\HasRoles as HasRolesContract;
use LaravelDoctrine\ACL\Contracts\HasPermissions as HasPermissionContract;
use LaravelDoctrine\ACL\Mappings as ACL;
use LaravelDoctrine\ACL\Roles\HasRoles;
use LaravelDoctrine\ACL\Permissions\HasPermissions;
use LaravelDoctrine\ORM\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * @ORM\Entity()
 */
class User implements AuthenticatableContract, CanResetPasswordContract, AuthorizableContract, HasRolesContract, HasPermissionContract 
{
    use Authenticatable, Timestamps, CanResetPassword, Authorizable, HasRoles, HasPermissions;

     /**
     * @ORM\Column(type="integer", length=10)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="string", length=50)
     * @var Login
     */
    protected $login;


    
    /**
     * @ACL\HasRoles()
     * @var \Doctrine\Common\Collections\ArrayCollection|\LaravelDoctrine\ACL\Contracts\Role[]
     */
    protected $roles;

    /**
     * @ACL\HasPermissions
     */
     public $permissions;


    /**
     * @param string $email
     */
    public function __construct($login)
    {
        $this->login = $login;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setEmail($login)
    {
        $this->login = $login;
    }

        public function getRoles()
    {
        return $this->roles;
    }
    
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    /**
     * @return ArrayCollection|Permission[]
     */
    public function getPermissions(){

        return $this->permissions;
        
    }

    /**
     * @param string $permission
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
    }
    
}
