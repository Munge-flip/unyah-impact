<x-layouts.admin>
    <x-slot:sidebar>
        <x-admin.sidebar />
    </x-slot:sidebar>

    <section class="content">

        <div class="section-header">
            <h1>Order Details</h1>
            <a href="{{ route('admin.order') }}" class="action-link">
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
                <span class="badge {{ $statusClass }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

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

        <div class="info-card">
            <div class="card-header">
                <h3>Assignment</h3>
            </div>
            <div class="card-body">
                <div class="detail-row">
                    <span class="label">Current Agent:</span>
                    <strong>{{ $order->agent->name ?? 'Unassigned' }}</strong>
                </div>

                <form action="{{ route('admin.order.assign', $order->id) }}" method="POST" style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee;">
                    @csrf
                    @method('PATCH')

                    <label style="display: block; margin-bottom: 10px; font-weight: 600;">Assign to Agent:</label>

                    <div style="display: flex; gap: 10px;">
                        <select name="agent_id" class="search-input" style="flex: 1;">
                            <option value="" disabled selected>Select an Agent</option>
                            @foreach($agents as $agent)
                            <option value="{{ $agent->id }}" {{ $order->agent_id == $agent->id ? 'selected' : '' }}>
                                {{ $agent->name }}
                            </option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn-primary" style="padding: 10px 20px;">
                            Assign
                        </button>
                    </div>
                </form>

                @if($order->status !== 'completed')
                <div style="margin-top: 15px;">
                    <button class="action-btn success" style="width: 100%;">Mark as Complete</button>
                </div>
                @endif
            </div>
        </div>

    </section>

</x-layouts.admin>
