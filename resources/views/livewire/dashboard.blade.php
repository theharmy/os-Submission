<div class="card">
    <h1>Welcome to User Management System</h1>
    
    <p>You are logged in as: <strong>{{ auth()->user()->name }}</strong></p>
    <p>Your role: <strong>{{ ucfirst(auth()->user()->role) }}</strong></p>
    
    @if(auth()->user()->isAdmin())
        <div class="mt-4">
            <a href="{{ route('admin.users') }}" class="btn">
                Manage Users
            </a>
        </div>
    @else
        <p>Contact an administrator for additional access.</p>
    @endif
</div>