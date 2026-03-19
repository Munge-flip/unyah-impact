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

        <admin-card>
            <template #header>
                <div>
                    <h3 style="margin: 0; font-size: 18px; color: #333;">Order #{{ $order->id }}</h3>
                    <span class="order-date">
                        {{ $order->created_at->format('M d, Y \a\t h:i A') }}
                    </span>
                </div>
            </template>
            <template #action>
                <status-badge status="{{ $order->status }}"></status-badge>
            </template>
        </admin-card>

        <admin-card title="Service Details">
            <detail-row label="Game" value="{{ $order->game }}"></detail-row>
            <detail-row label="Category" value="{{ ucfirst($order->service_category) }}"></detail-row>
            <detail-row label="Service Type" value="{{ $order->service_type }}"></detail-row>
            <detail-row label="Customer">
                <strong>
                    {{ $order->user->name ?? 'Unknown User' }}
                    <span class="user-id-sub">(ID: #{{ $order->user_id }})</span>
                </strong>
            </detail-row>
            <detail-row label="Amount Paid" value="{{ $order->price }}" :is-price="true"></detail-row>
        </admin-card>

        <admin-card title="Timeline">
            <detail-row label="Order Placed" value="{{ $order->created_at->format('M d, Y') }}"></detail-row>
            @if($order->status === 'completed')
                <detail-row label="Completed On" value="{{ $order->updated_at->format('M d, Y') }}"></detail-row>
            @else
                <detail-row label="Status" value="In Progress..." value-class="status-text-pending"></detail-row>
            @endif
        </admin-card>

        <admin-card title="Assignment">
            <detail-row label="Current Agent" value="{{ $order->agent->name ?? 'Unassigned' }}"></detail-row>

            <form action="{{ route('admin.order.assign', $order->id) }}" method="POST" class="assignment-section">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label>Assign to Agent:</label>
                    <div class="assignment-row">
                        <select name="agent_id" class="search-input assignment-select">
                            <option value="" disabled selected>Select an Agent</option>
                            @foreach($agents as $agent)
                            <option value="{{ $agent->id }}" {{ $order->agent_id == $agent->id ? 'selected' : '' }}>
                                {{ $agent->name }}
                            </option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn-primary">
                            Assign
                        </button>
                    </div>
                </div>
            </form>

            @if($order->status !== 'completed')
            <div class="mt-15">
                <button class="action-btn success w-100">Mark as Complete</button>
            </div>
            @endif
        </admin-card>

    </section>
</x-layouts.admin>