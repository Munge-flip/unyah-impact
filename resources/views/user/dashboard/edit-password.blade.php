<x-layouts.app>
    <x-slot:sidebar>
        <x-user.sidebar />
    </x-slot:sidebar>

    <section class="content">
        <div class="section-header">
            <h1>Change Password</h1>
            <a href="{{ route('user.dashboard') }}" class="action-link">
                ← Back to Dashboard
            </a>
        </div>

        <div class="info-card">
            
            <form action="{{ route('user.password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" name="current_password" required>
                    @error('current_password') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="password" required minlength="8">
                    @error('password') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" name="password_confirmation" required>
                </div>

                <div class="modal-actions">
                    <a href="{{ route('user.dashboard') }}" class="btn-secondary" style="text-decoration:none; display:inline-flex; justify-content:center; align-items:center;">Cancel</a>
                    <button type="submit" class="btn-primary">Update Password</button>
                </div>
            </form>
            
        </div>
    </section>
</x-layouts.app>