<x-layouts.app>
    <x-slot:sidebar>
        <x-admin.sidebar />
    </x-slot:sidebar>

    <section class="content">

        {{-- Header with Back Button --}}
        <div class="section-header">
            <h1>Order Details</h1>
            <a href="{{ route('admin.order') }}" class="action-link">
                ← Back to Orders
            </a>
        </div>

        {{-- 1. Order Header Card --}}
        <div class="info-card">
            <div class="card-header">
                <div>
                    <h3>Order #{{ $id }}</h3>
                    <span class="order-date">Oct 15, 2025</span>
                </div>
                <!-- Status Badge (You can make this dynamic later) -->
                <span class="badge completed">Completed</span>
            </div>
        </div>

        {{-- 2. Service Details Card --}}
        <div class="info-card">
            <div class="card-header">
                <h3>Service Details</h3>
            </div>
            <div class="card-body">
                <div class="detail-row">
                    <span class="label">Game:</span>
                    <strong>Genshin Impact</strong>
                </div>
                <div class="detail-row">
                    <span class="label">Service Type:</span>
                    <strong>Spiral Abyss</strong>
                </div>
                <div class="detail-row">
                    <span class="label">Description:</span>
                    <strong>Complete Spiral Abyss Floor 11 to 12</strong>
                </div>
                <div class="detail-row">
                    <span class="label">Customer:</span>
                    <strong>U***nh</strong>
                </div>
                <div class="detail-row">
                    <span class="label">Amount Paid:</span>
                    <span class="price">₱250.00</span>
                </div>
            </div>
        </div>

        {{-- 3. Timeline Card --}}
        <div class="info-card">
            <div class="card-header">
                <h3>Timeline</h3>
            </div>
            <div class="card-body">
                <div class="detail-row">
                    <span class="label">Order Placed:</span>
                    <strong>Oct 15, 2025</strong>
                </div>
                <div class="detail-row">
                    <span class="label">Completed On:</span>
                    <strong>Oct 20, 2025</strong>
                </div>
            </div>
        </div>

        {{-- 4. Assignment Card (Admin Specific) --}}
        <div class="info-card">
            <div class="card-header">
                <h3>Assignment</h3>
            </div>
            <div class="card-body">
                <div class="detail-row">
                    <span class="label">Assigned Agent:</span>
                    <strong>Darkbeam</strong>
                </div>

                {{-- Admin Action Buttons --}}
                <div class="agent-actions" style="margin-top: 20px;">
                    <button class="action-btn secondary">Reassign Agent</button>
                    <button class="action-btn success">Mark as Complete</button>
                </div>
            </div>
        </div>

    </section>

</x-layouts.app>
