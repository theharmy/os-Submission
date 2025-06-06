<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'User Management System' }}</title>
    
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .nav { background: #333; color: white; padding: 1rem; }
        .nav a { color: white; text-decoration: none; margin-right: 20px; }
        .nav a:hover { text-decoration: underline; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin: 20px 0; }
        .btn { background: #007bff; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn:hover { background: #0056b3; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input, .form-group select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        .alert { padding: 15px; margin: 20px 0; border-radius: 4px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .table th, .table td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        .table th { background: #f8f9fa; font-weight: bold; }
        .table tr:nth-child(even) { background: #f8f9fa; }
        .float-right { float: right; }
        .text-center { text-align: center; }
        .mt-4 { margin-top: 20px; }
        .mb-4 { margin-bottom: 20px; }
    </style>
    
    @livewireStyles
</head>
<body> 
    <!-- only for logged in users -->
    @auth   
    <nav class="nav">
        <div class="container">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            
            @if(auth()->user()->isAdmin()) <!-- only for admins -->
                <a href="{{ route('admin.users') }}">Manage Users</a>
            @endif
            
            <span class="float-right">
                Welcome, {{ auth()->user()->name }}
                <livewire:auth.logout />
            </span>
        </div>
    </nav>
    @endauth

    <div class="container">
        {{ $slot }}
    </div>

    @livewireScripts
</body>
</html>
