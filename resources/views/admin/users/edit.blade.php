<x-layouts.admin>
    <section class="content">
        <div class="section-header">
            <h1>Edit User</h1>
            <a href="{{ route('admin.agent') }}" class="action-link">
                ← Back to Agents
            </a>
        </div>

        <div class="info-card">
            <div class="card-header">
                <h3>User Information</h3>
            </div>

            <form class="modal-form">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" id="agentName" name="name" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" id="agentEmail" name="email" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" id="agentPassword" name="password" required minlength="6">
                </div>

                <div class="modal-actions">
                    <a href="{{ route('admin.agent') }}" class="btn-secondary">Cancel</a>
                    <button type="submit" class="btn-primary">Save</button>
                </div>
            </form>
        </div>
    </section>
</x-layouts.admin>