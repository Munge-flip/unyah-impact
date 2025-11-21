<x-layouts.app>
    <x-slot:sidebar>
        <x-user.sidebar />
    </x-slot:sidebar>

    <section class="content">
        <div class="section-header">
            <h1>Edit Personal Information</h1>
            <a href="{{ route('user.dashboard') }}" class="action-link">
                ← Back to Dashboard
            </a>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" id="editUsername" required="">
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" id="editEmail" required="">
        </div>
        <div class="form-group">
            <label>Mobile Number</label>
            <input type="tel" id="editMobile" required="">
        </div>
        <div class="modal-actions">
            <button type="button" class="btn-secondary">Cancel</button>
            <button type="submit" class="btn-primary">Save Changes</button>
        </div>
    </section>

</x-layouts.app>
