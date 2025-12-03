<x-layouts.admin>
    <section class="content">
        <div class="section-header">
            <h1>Add New Agent</h1>
            <a href="{{ route('admin.agent') }}" class="action-link">← Back to Agents</a>
        </div>

        <div class="info-card">
            <div class="card-header">
                <h3>Agent Information</h3>
            </div>

            <form action="{{ route('admin.agent.store') }}" method="POST" class="modal-form">
                @csrf

                <div class="form-group">
                    <label>Agent Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required>
                    @error('name') <span style="color:red">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                    @error('email') <span style="color:red">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" required>
                    @error('phone') <span style="color:red">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required minlength="8">
                    @error('password') <span style="color:red">{{ $message }}</span> @enderror
                </div>

                <div class="modal-actions">
                    <a href="{{ route('admin.agent') }}" class="btn-secondary" style="text-decoration:none; display:inline-flex; justify-content:center; align-items:center;">Cancel</a>
                    <button type="submit" class="btn-primary">Add Agent</button>
                </div>
            </form>
        </div>
    </section>
</x-layouts.admin>
