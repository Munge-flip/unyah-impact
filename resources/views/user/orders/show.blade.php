<x-layouts.app>
    
    <x-slot:sidebar>
        <x-user.sidebar />
    </x-slot:sidebar>

    <section class="content">
        
        <div class="section-header">
            <h1>Order Details</h1>
            <a href="{{ route('user.order') }}" class="btn-secondary">
                ← Back to Orders
            </a>
        </div>

        <div class="info-card">
            <div class="card-header">
                <div>
                    <h3>Order #{{ $id }}</h3>
                    <span class="order-date">Oct 15, 2025</span>
                </div>
                <span class="status-badge completed">Completed</span>
            </div>
        </div>

        <div class="info-card">
            <h3>Service Details</h3>
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
                <span class="label">Amount Paid:</span>
                <span class="price">₱250.00</span>
            </div>
        </div>

        <div class="info-card">
            <h3>Timeline</h3>
            <div class="detail-row">
                <span class="label">Order Placed:</span>
                <strong>Oct 15, 2025</strong>
            </div>
            <div class="detail-row">
                <span class="label">Completed On:</span>
                <strong>Oct 20, 2025</strong>
            </div>
        </div>

        <div class="info-card">
            <h3>Assigned Pilot</h3>
            <div class="detail-row">
                <span class="label">Pilot ID:</span>
                <strong>Darkbeam</strong>
            </div>
        </div>

    </section>

</x-layouts.app>