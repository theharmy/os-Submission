<div class="text-center">
    <div style="max-width: 400px; margin: 50px auto;">
        <div class="card">
            <h2 class="text-center mb-4">User Management System</h2>
            <h3 class="text-center mb-4">Login</h3>
            
            <form wire:submit="login">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" 
                           id="username" 
                           wire:model="username" 
                           placeholder="Enter your username"
                           required>
                    @error('username') 
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" 
                           id="password" 
                           wire:model="password" 
                           placeholder="Enter your password"
                           required>
                    @error('password') 
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox" wire:model="remember"> Remember me
                    </label>
                </div>

                <button type="submit" class="btn" style="width: 100%;">
                    Login
                </button>
            </form>

            <div class="mt-4">
                <p><strong>Test Accounts:</strong></p>
                <p>Admin: <code>admin</code> / <code>Admin123!</code></p>
                <p>User: <code>testuser</code> / <code>User123!</code></p>
            </div>
        </div>
    </div>
</div>