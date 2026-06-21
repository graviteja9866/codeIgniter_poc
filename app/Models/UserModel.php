<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $deletedField  = 'deleted_at';
    protected $allowedFields = [
        'first_name',
        'last_name',
        'email',
        'mobile',
        'department',
        'status',
    ];



    /**
     * Get distinct department values for filter dropdown.
     *
     * @return array
     */
    public function getDepartments(): array
    {
        return $this->select('department')
                    ->distinct()
                    ->where('deleted_at', null)
                    ->orderBy('department', 'ASC')
                    ->findAll();
    }
}
