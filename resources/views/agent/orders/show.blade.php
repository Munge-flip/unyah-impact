<x-layouts.agent>
    
    <section class="content">
        
        {{-- Header with Back Button --}}
        <div class="section-header">
            <h1>Order Details</h1>
            <a href="{{ route('agent.order') }}" class="btn-secondary" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                ← Back to My Tasks
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
                <span class="label">Customer:</span>
                <strong>{{ $order->user->name ?? 'Unknown User' }}</strong>
            </div>

            <div class="detail-row">
                <span class="label">Amount Paid:</span>
                <span class="price">₱{{ number_format($order->price, 2) }}</span>
            </div>
        </div>

        {{-- 3. Timeline Card --}}
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
                        Work in progress...
                    </strong>
                </div>
            @endif
        </div>

        {{-- 4. Actions Card (Agent Specific) --}}
        <div class="info-card">
            <h3>Actions</h3>
            
            <div class="agent-actions" style="margin-top: 20px; display: flex; gap: 10px;">
                
                {{-- Chat Button --}}
                <a href="{{ route('agent.chat') }}" class="action-btn secondary" style="text-decoration:none; text-align:center;">
                    Chat with Customer
                </a>

                {{-- Mark as Complete Button (Only if not done) --}}
                @if($order->status !== 'completed')
                    <form action="{{ route('agent.order.complete', $order->id) }}" method="POST" style="flex: 1;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="action-btn success" style="width: 100%;" onclick="return confirm('Are you sure you want to mark this order as complete?')">
                            Mark as Complete
                        </button>
                    </form>
                @else
                    <button class="action-btn" disabled style="background: #e0e0e0; color: #888; cursor: not-allowed; flex: 1;">
                        Order Completed
                    </button>
                @endif

            </div>
        </div>

    </section>

</x-layouts.agent>