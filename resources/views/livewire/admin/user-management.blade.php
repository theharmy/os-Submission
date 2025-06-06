<div>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>User Management</h1>
        @if(!$showForm)
            <button wire:click="showCreateForm" class="btn">
                Create New User
            </button>
        @endif
    </div>
    
    <!-- Success/Error Messages -->
    @if($successMessage)
        <div class="alert alert-success">
            {{ $successMessage }}
            <button type="button" wire:click="clearMessages" style="float: right; background: none; border: none; color: inherit;">&times;</button>
        </div>
    @endif

    @if($errorMessage)
        <div class="alert alert-danger">
            {{ $errorMessage }}
            <button type="button" wire:click="clearMessages" style="float: right; background: none; border: none; color: inherit;">&times;</button>
        </div>
    @endif

    <!-- Create/Edit Form -->
    @if($showForm)
        <div class="card mb-4">
            <h3>{{ $editingUserId ? 'Edit User' : 'Create New User' }}</h3>
            
            <form wire:submit="saveUser">
                <div class="form-group">
                    <label for="name">Username:</label>
                    <input type="text" 
                           id="name" 
                           wire:model="name" 
                           placeholder="Enter username"
                           required>
                    @error('name') 
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" 
                           id="email" 
                           wire:model="email" 
                           placeholder="Enter email address"
                           required>
                    @error('email') 
                        <div class="alert alert-danger">Please enter a valid, unique email address.</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" 
                           id="password" 
                           wire:model="password" 
                           placeholder="{{ $editingUserId ? 'Leave blank to keep current password' : 'Enter password' }}"
                           {{ $editingUserId ? '' : 'required' }}>
                    @error('password') 
                        <div class="alert alert-danger">Please choose a stronger password.</div>
                    @enderror
                    @if($editingUserId)
                        <small>Leave blank to keep current password</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="role">Role:</label>
                    <select id="role" wire:model="role" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    @error('role') 
                        <div class="alert alert-danger">Please select a valid role.</div>
                    @enderror
                </div>

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn">
                        {{ $editingUserId ? 'Update User' : 'Create User' }}
                    </button>
                    <button type="button" wire:click="cancelEdit" class="btn" style="background: #6c757d;">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    @endif

    <!-- Search -->
    @if(!$showForm)
        <div class="form-group" style="max-width: 300px;">
            <label for="search">Search Users:</label>
            <input type="text" 
                   id="search" 
                   wire:model.live="search" 
                   placeholder="Search by username or email...">
        </div>
    @endif

    <!-- Users Table -->
    @if(!$showForm)
        <div class="card">
            <h3>All Users ({{ $users->total() }} total)</h3>
            
            @if($users->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <strong>{{ $user->name }}</strong>
                                    @if($user->id === auth()->id())
                                        <span style="color: #007bff;">(You)</span>
                                    @endif
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span style="background: {{ $user->role === 'admin' ? '#28a745' : '#17a2b8' }}; 
                                                 color: white; 
                                                 padding: 2px 6px; 
                                                 border-radius: 3px; 
                                                 font-size: 12px;">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>{{ $user->created_at->format('M j, Y') }}</td>
                                <td>
                                    <button wire:click="editUser({{ $user->id }})" 
                                            class="btn" 
                                            style="background: #ffc107; color: #212529; padding: 4px 8px; font-size: 12px;">
                                        Edit
                                    </button>
                                    
                                    @if($user->id !== auth()->id())
                                        <button wire:click="deleteUser({{ $user->id }})" 
                                                wire:confirm="Are you sure you want to delete {{ $user->name }}? This action cannot be undone."
                                                class="btn btn-danger" 
                                                style="padding: 4px 8px; font-size: 12px;">
                                            Delete
                                        </button>
                                    @else
                                        <span style="color: #6c757d; font-size: 12px;">Cannot delete yourself</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            @else
                <p>No users found.</p>
            @endif
        </div>
    @endif
</div>