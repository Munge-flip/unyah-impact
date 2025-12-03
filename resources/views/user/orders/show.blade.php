<x-layouts.app>
    
    <x-slot:sidebar>
        <x-user.sidebar />
    </x-slot:sidebar>

    <section class="content">
        
        {{-- Header with Back Button --}}
        <div class="section-header">
            <h1>Order Details</h1>
            <a href="{{ route('user.order') }}" class="btn-secondary" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                ← Back to Orders
            </a>
        </div>

        {{-- 1. Order Header Card --}}
        <div class="info-card">
            <div class="card-header">
                <div>
                    <h3>Order #{{ $order->id }}</h3>
                    <span class="order-date">
                        {{ $order->created_at->format('M d, Y \a\t h:i A') }}
                    </span>
                </div>
                
                {{-- Dynamic Status Badge --}}
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

        {{-- 2. Service Details Card --}}
        <div class="info-card">
            <h3>Service Details</h3>
            
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

        {{-- 3. Timeline Card --}}
        <div class="info-card">
            <h3>Timeline</h3>
            <div class="detail-row">
                <span class="label">Order Placed:</span>
                <strong>{{ $order->created_at->format('M d, Y') }}</strong>
            </div>
            
            {{-- Only show 'Completed On' if the status is actually completed --}}
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

        {{-- 4. Assigned Pilot Card --}}
        <div class="info-card">
            <h3>Assigned Pilot</h3>
            <div class="detail-row">
                <span class="label">Pilot ID:</span>
                @if($order->agent)
                    {{-- If an agent is assigned, show their name --}}
                    <strong>{{ $order->agent->name }}</strong>
                @else
                    {{-- If no agent yet --}}
                    <span style="color: #e74c3c; font-style: italic; font-weight: 600;">
                        Finding a pilot...
                    </span>
                @endif
            </div>
        </div>

    </section>

</x-layouts.app>