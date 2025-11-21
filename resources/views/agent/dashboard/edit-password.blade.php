<x-layouts.agent>

    <section class="content">
        <div class="section-header">
            <h1>Change Password</h1>
            <a href="{{ route('user.dashboard') }}" class="action-link">
                ← Back to Dashboard
            </a>
        </div>
        <div class="form-group">
            <label>Current Password</label>
            <input type="password" id="currentPassword" required="">
        </div>
        <div class="form-group">
            <label>New Password</label>
            <input type="password" id="newPassword" required="" minlength="6">
        </div>
        <div class="form-group">
            <label>Confirm New Password</label>
            <input type="password" id="confirmPassword" required="">
        </div>
        <div class="modal-actions">
            <button type="button" class="btn-secondary">Cancel</button>
            <button type="submit" class="btn-primary">Update Password</button>
        </div>
    </section>

</x-layouts.agent>