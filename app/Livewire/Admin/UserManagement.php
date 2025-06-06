<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class UserManagement extends Component
{
    use WithPagination;

    // Form properties
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $role = 'user';
    
    // Edit mode
    public $editingUserId = null;
    public $showForm = false;
    
    // Search
    public $search = '';
    
    // Flash messages
    public $successMessage = '';
    public $errorMessage = '';

    protected $listeners = [
        'user-created' => 'showSuccessMessage',
        'user-updated' => 'showUpdateMessage', 
        'user-deleted' => 'showDeleteMessage',
        'user-delete-error' => 'showDeleteError'
    ];

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/',
        'role' => 'required|in:user,admin',
    ];

    protected $messages = [
        'name.required' => 'Username is required.',
        'name.unique' => 'This username is already taken.',
        'email.required' => 'Email is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email is already registered.',
        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 8 characters.',
        'password.regex' => 'Password must contain: uppercase letter, lowercase letter, number, and special character (@$!%*?&).',
        'role.required' => 'Role is required.',
    ];

    public function showCreateForm()
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function editUser($userId)
    {
        $this->clearMessages();
        $user = User::findOrFail($userId);
        
        $this->editingUserId = $userId;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $this->role = $user->role;
        $this->showForm = true;
    }

    public function saveUser()
    {
        // Adjust validation rules for editing
        $rules = $this->rules;
        
        if ($this->editingUserId) {
            // When editing, make password optional and add unique constraints
            $rules['password'] = 'nullable|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/';
            $rules['name'] = 'required|string|max:255|unique:users,name,' . $this->editingUserId;
            $rules['email'] = 'required|email|max:255|unique:users,email,' . $this->editingUserId;
        } else {
            // When creating, add unique constraints
            $rules['name'] = 'required|string|max:255|unique:users,name';
            $rules['email'] = 'required|email|max:255|unique:users,email';
        }

        $this->validate($rules);

        if ($this->editingUserId) {
            // Update existing user
            $user = User::findOrFail($this->editingUserId);
            
            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
            ];
            
            // Only update password if provided
            if (!empty($this->password)) {
                $data['password'] = Hash::make($this->password);
            }
            
            $user->update($data);
            
            $this->dispatch('user-updated');
        } else {
            // Create new user
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'role' => $this->role,
            ]);
            
            $this->dispatch('user-created');
        }

        $this->resetForm();
    }

    public function deleteUser($userId)
    {
        // Prevent deleting yourself
        if ($userId == auth()->id()) {
            $this->dispatch('user-delete-error');
            return;
        }

        $user = User::findOrFail($userId);
        $user->delete();
        
        $this->dispatch('user-deleted');
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->role = 'user';
        $this->editingUserId = null;
        $this->showForm = false;
        $this->resetValidation();
        $this->clearMessages();
    }

    public function clearMessages()
    {
        $this->successMessage = '';
        $this->errorMessage = '';
    }

    public function showSuccessMessage()
    {
        $this->successMessage = 'User created successfully!';
        $this->errorMessage = '';
    }

    public function showUpdateMessage()
    {
        $this->successMessage = 'User updated successfully!';
        $this->errorMessage = '';
    }

    public function showDeleteMessage()
    {
        $this->successMessage = 'User deleted successfully!';
        $this->errorMessage = '';
    }

    public function showDeleteError()
    {
        $this->errorMessage = 'You cannot delete yourself!';
        $this->successMessage = '';
    }

    public function updatingSearch()
    {
        $this->resetPage();
        $this->clearMessages();
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'asc')  // Chronological order by ID
            ->paginate(10);

        return view('livewire.admin.user-management', [
            'users' => $users
        ])->layout('layouts.app', ['title' => 'User Management']);
    }
}