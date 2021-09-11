<?php
namespace App\Models\Traits;

trait UserPermissionTrait {
    public function isAdmin()
    {
        return $this->roles->contains('name', 'admin');
    }

    public function isModerator()
    {
        return $this->roles->contains('name', 'moderator');
    }

    public function isWebmaster()
    {
        return $this->roles->contains('name', 'webmaster');
    }

    public function isBuyer()
    {
        return $this->roles->contains('name', 'buyer');
    }
}
