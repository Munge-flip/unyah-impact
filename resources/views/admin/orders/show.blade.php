<x-layouts.admin>
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
                <span class="badge {{ $statusClass }}">
                    {{ ucfirst($order->status) }}
                </span>
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
                    <span class="label">Customer:</span>
                    <strong>
                        {{ $order->user->name ?? 'Unknown User' }}
                        <span style="color: #888; font-weight: normal; font-size: 13px;">(ID: #{{ $order->user_id }})</span>
                    </strong>
                </div>
                <div class="detail-row">
                    <span class="label">Amount Paid:</span>
                    <span class="price">₱{{ number_format($order->price, 2) }}</span>
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
                        <strong style="color: #888; font-style: italic;">In Progress...</strong>
                    </div>
                @endif
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
                    @if($order->agent)
                        <strong>{{ $order->agent->name }}</strong>
                    @else
                        <span style="color: #e74c3c; font-style: italic; font-weight: 600;">Unassigned</span>
                    @endif
                </div>
                
                {{-- Admin Actions Form --}}
                <div class="agent-actions" style="margin-top: 20px;">
                    
                    {{-- 1. Reassign Agent --}}
                    {{-- Note: Ideally this opens a modal or goes to an edit page. For now, a placeholder button. --}}
                    <button class="action-btn secondary">Reassign Agent</button>
                    
                    {{-- 2. Mark as Complete (Only if not already completed) --}}
                    @if($order->status !== 'completed')
                        <button class="action-btn success">Mark as Complete</button>
                    @endif
                </div>
            </div>
        </div>

    </section>

</x-layouts.admin>