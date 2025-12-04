<x-layouts.app>

    <x-slot:sidebar>
        <x-user.sidebar />
    </x-slot:sidebar>

    <section class="content">

        <div class="section-header">
            <h1>Order Details</h1>
            <a href="{{ route('user.order') }}" class="btn-secondary" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                ← Back to Orders
            </a>
        </div>

        <div class="info-card">
            <div class="card-header">
                <div>
                    <h3>Order #{{ $order->id }}</h3>
                    <span class="order-date">
                        {{ $order->created_at->format('M d, Y \a\t h:i A') }}
                    </span>
                </div>

                @php
                $statusClass = match($order->status) {
                'completed' => 'completed',
                'in-progress' => 'in-progress',
                default => 'pending',
                };
                @endphp
                <span class="status-badge {{ $statusClass }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

        <div class="info-card">
            <h3>Service Details</h3>
            <div style="display: flex; align-items: center; gap: 10px;">
                <span class="badge {{ $order->payment_status === 'paid' ? 'completed' : 'pending' }}" style="background: {{ $order->payment_status === 'paid' ? '#d1e7dd' : '#f8d7da' }}; 
                     color: {{ $order->payment_status === 'paid' ? '#0f5132' : '#721c24' }};">
                    {{ ucfirst($order->payment_status) }}
                </span>

                @if($order->payment_status === 'unpaid')
                <form action="{{ route('user.order.pay', $order->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn-primary" style="padding: 5px 15px; font-size: 12px;" onclick="return confirm('Simulating QR Scan... Click OK to confirm payment.')">
                        Pay Now
                    </button>
                </form>
                @endif
            </div>

            <div class="detail-row">
                <span class="label">Game:</span>
                <strong>{{ $order->game }}</strong>
            </div>

            <div class="detail-row">
                <span class="label">Category:</span>
                <strong>{{ ucfirst($order->service_category) }}</strong>
            </div>

            <div class="detail-row">
                <span class="label">Service Type:</span>
                <strong>{{ $order->service_type }}</strong>
            </div>

            <div class="detail-row">
                <span class="label">Amount Paid:</span>
                <span class="price">₱{{ number_format($order->price, 2) }}</span>
            </div>

            <div class="detail-row">
                <span class="label">Payment Method:</span>
                <strong style="text-transform: uppercase;">
                    {{ $order->payment_method ?? 'N/A' }}
                </strong>
            </div>
        </div>

        <div class="info-card">
            <h3>Timeline</h3>
            <div class="detail-row">
                <span class="label">Order Placed:</span>
                <strong>{{ $order->created_at->format('M d, Y') }}</strong>
            </div>

            @if($order->status === 'completed')
            <div class="detail-row">
                <span class="label">Completed On:</span>
                <strong>{{ $order->updated_at->format('M d, Y') }}</strong>
            </div>
            @else
            <div class="detail-row">
                <span class="label">Status:</span>
                <strong style="color: #888; font-style: italic;">
                    Waiting for completion...
                </strong>
            </div>
            @endif
        </div>

        <div class="info-card">
            <h3>Assigned Pilot</h3>
            <div class="detail-row">
                <span class="label">Pilot ID:</span>
                @if($order->agent)
                <strong>{{ $order->agent->name }}</strong>
                @else
                <span style="color: #e74c3c; font-style: italic; font-weight: 600;">
                    Finding a pilot...
                </span>
                @endif
            </div>
        </div>

    </section>

</x-layouts.app>
