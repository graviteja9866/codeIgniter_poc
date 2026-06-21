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

    // Validation rules for creating a user
    protected $validationRules = [
        'first_name' => 'required|min_length[2]|max_length[100]',
        'last_name'  => 'required|min_length[2]|max_length[100]',
        'email'      => 'required|valid_email|max_length[100]|is_unique[users.email,id,{id}]',
        'mobile'     => 'required|min_length[10]|max_length[15]|is_unique[users.mobile,id,{id}]',
        'department' => 'required|max_length[100]',
        'status'     => 'required|in_list[active,inactive]',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'This email address is already registered.',
        ],
        'mobile' => [
            'is_unique' => 'This mobile number is already registered.',
        ],
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
