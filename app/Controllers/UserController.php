<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * List all users with search and filter support.
     */
    public function index()
    {
        $search     = $this->request->getGet('search');
        $department = $this->request->getGet('department');
        $status     = $this->request->getGet('status');

        $builder = $this->userModel->where('deleted_at', null);

        // Search by name, email, or mobile
        if ($search) {
            $builder->groupStart()
                    ->like('first_name', $search)
                    ->orLike('last_name', $search)
                    ->orLike('email', $search)
                    ->orLike('mobile', $search)
                    ->groupEnd();
        }

        // Filter by department
        if ($department) {
            $builder->where('department', $department);
        }

        // Filter by status
        if ($status) {
            $builder->where('status', $status);
        }

        $data = [
            'users'       => $builder->orderBy('id', 'DESC')->findAll(),
            'departments' => $this->userModel->getDepartments(),
            'search'      => $search,
            'department'  => $department,
            'status'      => $status,
            'pageTitle'   => 'Users',
        ];

        return view('users/index', $data);
    }

    /**
     * Show the create user form.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'Create User',
        ];

        return view('users/create', $data);
    }

    /**
     * Store a new user.
     */
    public function store()
    {
        $rules = [
            'first_name' => 'required|min_length[2]|max_length[100]|regex_match[/^[a-zA-Z\s]+$/]',
            'last_name'  => 'required|min_length[2]|max_length[100]|regex_match[/^[a-zA-Z\s]+$/]',
            'email'      => 'required|valid_email|max_length[100]|is_unique[users.email]',
            'mobile'     => 'required|exact_length[10]|numeric|is_unique[users.mobile]',
            'department' => 'required|max_length[100]|regex_match[/^[a-zA-Z\s]+$/]',
            'status'     => 'required|in_list[active,inactive]',
        ];

        $messages = [
            'first_name' => [
                'regex_match' => 'First name can only contain letters and spaces. No numbers or special characters allowed.',
            ],
            'last_name' => [
                'regex_match' => 'Last name can only contain letters and spaces. No numbers or special characters allowed.',
            ],
            'mobile' => [
                'exact_length' => 'Mobile number must be exactly 10 digits.',
                'numeric'      => 'Mobile number must contain digits only. No spaces, dashes or special characters.',
                'is_unique'    => 'This mobile number is already registered.',
            ],
            'department' => [
                'regex_match' => 'Department can only contain letters and spaces. No special characters allowed.',
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->insert([
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'email'      => $this->request->getPost('email'),
            'mobile'     => $this->request->getPost('mobile'),
            'department' => $this->request->getPost('department'),
            'status'     => $this->request->getPost('status'),
        ]);

        return redirect()->to('/users')->with('success', 'User created successfully.');
    }

    /**
     * Show the edit user form.
     */
    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (! $user) {
            return redirect()->to('/users')->with('error', 'User not found.');
        }

        $data = [
            'user'      => $user,
            'pageTitle' => 'Edit User',
        ];

        return view('users/edit', $data);
    }

    /**
     * Update an existing user.
     */
    public function update($id)
    {
        $user = $this->userModel->find($id);

        if (! $user) {
            return redirect()->to('/users')->with('error', 'User not found.');
        }

        // Email cannot be changed, so we only validate other fields
        // Mobile uniqueness check excludes the current user's ID
        $rules = [
            'first_name' => 'required|min_length[2]|max_length[100]|regex_match[/^[a-zA-Z\s]+$/]',
            'last_name'  => 'required|min_length[2]|max_length[100]|regex_match[/^[a-zA-Z\s]+$/]',
            'mobile'     => "required|exact_length[10]|numeric|is_unique[users.mobile,id,{$id}]",
            'department' => 'required|max_length[100]|regex_match[/^[a-zA-Z\s]+$/]',
            'status'     => 'required|in_list[active,inactive]',
        ];

        $messages = [
            'first_name' => [
                'regex_match' => 'First name can only contain letters and spaces. No numbers or special characters allowed.',
            ],
            'last_name' => [
                'regex_match' => 'Last name can only contain letters and spaces. No numbers or special characters allowed.',
            ],
            'mobile' => [
                'exact_length' => 'Mobile number must be exactly 10 digits.',
                'numeric'      => 'Mobile number must contain digits only. No spaces, dashes or special characters.',
                'is_unique'    => 'This mobile number is already registered.',
            ],
            'department' => [
                'regex_match' => 'Department can only contain letters and spaces. No special characters allowed.',
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->update($id, [
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'mobile'     => $this->request->getPost('mobile'),
            'department' => $this->request->getPost('department'),
            'status'     => $this->request->getPost('status'),
        ]);

        return redirect()->to('/users')->with('success', 'User updated successfully.');
    }

    /**
     * Soft delete a user.
     */
    public function delete($id)
    {
        $user = $this->userModel->find($id);

        if (! $user) {
            return redirect()->to('/users')->with('error', 'User not found.');
        }

        $this->userModel->delete($id);

        return redirect()->to('/users')->with('success', 'User deleted successfully.');
    }
}
