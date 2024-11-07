@extends($layout)
@section('title', 'Setting')
@section('contents')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

<style>
/* Container styling */
.container {
    max-width: 750px;
    background: #ffffff;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.15);
    margin-top: 40px;
}

/* Header */
h1 {
    color: #222;
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 10px;
    text-align: center;
}

/* Tabs styling */
.nav-tabs {
    display: flex;
    justify-content: space-around;
    border-bottom: 2px solid #ddd;
}

.nav-tabs .nav-item {
    margin-bottom: -2px;
}

.nav-tabs .nav-link {
    color: #555;
    border: none;
    background: none;
    font-weight: bold;
    padding: 12px 20px;
    transition: color 0.3s, border-bottom 0.3s ease;
}

.nav-tabs .nav-link.active {
    color: #0069d9;
    border-bottom: 3px solid #0069d9;
}

.nav-tabs .nav-link i {
    font-size: 16px;
}

/* Tab content styling */
.tab-content {
    background: #ffffff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.08);
    margin-top: 20px;
}

/* Form styling */
form label {
    color: #444;
    font-weight: 600;
}

.form-control {
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    transition: border-color 0.3s ease;
    background-color: #f9fafb;
}

.form-control:focus {
    border-color: #0069d9;
    box-shadow: 0 0 8px rgba(0, 105, 217, 0.2);
}

.input-group-text {
    background: #f0f0f0;
    border: none;
    cursor: pointer;
    border-radius: 0 8px 8px 0;
}

.invalid-feedback {
    color: #e3342f;
    font-size: 13px;
    padding-left: 5px;
}

/* Button styling */
.btn2 {
    background: #0069d9;
    color: white;
    font-weight: bold;
    padding: 12px;
    border: none;
    border-radius: 8px;
    width: 100%;
    margin-top: 20px;
    transition: background 0.3s ease;
    font-size: 16px;
}

.btn2:hover {
    background: #0056b3;
}


/* Icon styles for eye toggle */
.input-group-text i {
    color: #666;
}

.input-group-text:hover i {
    color: #333;
}

/* Animated hover effect for tabs */
.nav-tabs .nav-link:hover {
    color: #0056b3;
    border-bottom: 3px solid #0056b3;
}

/* Subtle box shadow on form fields */
.form-control:hover {
    box-shadow: 0px 2px 8px rgba(0, 105, 217, 0.1);
}


@media (max-width: 768px) {
    .container {
        padding: 20px;
    }

    h1 {
        font-size: 24px;
    }

    .nav-tabs {
        flex-direction: column;
        align-items: center;
    }

    .nav-tabs .nav-link {
        width: 100%;
        text-align: center;
        padding: 10px;
    }

    .tab-content {
        padding: 20px;
    }
}


</style>

<div class="container mx-auto py-10">
    <h1 class="text-3xl font-bold mb-6">Account Settings</h1>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs" id="settingsTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">
                <i class="fas fa-user mr-2 text-blue-500"></i>Profile Information
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="notifications-tab" data-toggle="tab" href="#notifications" role="tab" aria-controls="notifications" aria-selected="false">
                <i class="fas fa-bell mr-2 text-yellow-500"></i>Notification Preferences
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security" aria-selected="false">
                <i class="fas fa-lock mr-2 text-red-500"></i>Security Settings
            </a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content bg-white shadow-md rounded-lg p-8 mt-4" id="settingsTabContent">

        <!-- Profile Information Tab -->
        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('setting.update.profile') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="font-semibold">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="font-semibold">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn2 btn-primary btn-block">Save Profile Information</button>
            </form>
        </div>

        <!-- Notification Preferences Tab -->
        <div class="tab-pane fade" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
            <form action="{{ route('setting.update.notifications') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email_notifications" class="font-semibold">Email Notifications</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="email_notifications" name="email_notifications" {{ old('email_notifications', $user->email_notifications) ? 'checked' : '' }}>
                        <label class="form-check-label" for="email_notifications"></label>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="push_notifications" class="font-semibold">Push Notifications</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="push_notifications" name="push_notifications" {{ old('push_notifications', $user->push_notifications) ? 'checked' : '' }}>
                        <label class="form-check-label" for="push_notifications"></label>
                    </div>
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn2 btn-primary btn-block">Save Notification Preferences</button>
            </form>
        </div>

        <!-- Security Settings Tab -->
        <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
            <form action="{{ route('setting.update.security') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="current_password" class="font-semibold">Current Password</label>
                    <div class="input-group">
                        <input type="password" id="current_password" name="current_password" class="form-control @error('current_password') is-invalid @enderror">
                        <span class="input-group-text" onclick="togglePasswordVisibility('current_password', 'current_password_icon')">
                            <i id="current_password_icon" class="fas fa-eye"></i>
                        </span>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="new_password" class="font-semibold">New Password</label>
                    <div class="input-group">
                        <input type="password" id="new_password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" required>
                        <span class="input-group-text" onclick="togglePasswordVisibility('new_password', 'new_password_icon')">
                            <i id="new_password_icon" class="fas fa-eye"></i>
                        </span>
                        @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="new_password_confirmation" class="font-semibold">Confirm New Password</label>
                    <div class="input-group">
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror" required>
                        <span class="input-group-text" onclick="togglePasswordVisibility('new_password_confirmation', 'new_password_confirmation_icon')">
                            <i id="new_password_confirmation_icon" class="fas fa-eye"></i>
                        </span>
                        @error('new_password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn2 btn-primary btn-block">Update Security Settings</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePasswordVisibility(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

@endsection