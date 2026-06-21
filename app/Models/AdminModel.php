<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table         = 'admins';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['name', 'email', 'password'];
    protected $useTimestamps = true;

    /**
     * Find an admin by email address.
     *
     * @param string $email
     * @return array|null
     */
    public function findByEmail(string $email)
    {
        return $this->where('email', $email)->first();
    }
}
