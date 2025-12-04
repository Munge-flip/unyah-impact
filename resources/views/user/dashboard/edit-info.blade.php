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

        {{-- Wrapper Card for styling --}}
        <div class="info-card">
            
            {{-- 1. Form Setup --}}
            <form action="{{ route('user.profile.update') }}" method="POST">
                @csrf
                @method('PATCH') {{-- Use PATCH for updates --}}

                <div class="form-group">
                    <label>Name</label>
                    {{-- 2. Value Binding: Shows current user data --}}
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                    @error('name') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                    @error('email') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="tel" name="phone" value="{{ old('phone', auth()->user()->phone) }}">
                    @error('phone') <span style="color:red; font-size:13px;">{{ $message }}</span> @enderror
                </div>

                <div class="modal-actions">
                    <a href="{{ route('user.dashboard') }}" class="btn-secondary" style="text-decoration:none; display:inline-flex; justify-content:center; align-items:center;">Cancel</a>
                    <button type="submit" class="btn-primary">Save Changes</button>
                </div>
            </form>

        </div>
    </section>
</x-layouts.app>