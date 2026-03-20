<x-layouts.agent>
    <section class="content">
        
        <div class="section-header">
            <h1>Order Details</h1>
            <a href="{{ route('agent.order') }}" class="btn-secondary">
                ← Back to My Tasks
            </a>
        </div>

        <info-card>
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
        </info-card>

        <info-card title="Service Details" :use-body="true">
            <detail-row label="Game" value="{{ $order->game }}"></detail-row>
            <detail-row label="Category" value="{{ ucfirst($order->service_category) }}"></detail-row>
            <detail-row label="Service Type" value="{{ $order->service_type }}"></detail-row>
            <detail-row label="Customer" value="{{ $order->user->name ?? 'Unknown User' }}"></detail-row>
            <detail-row label="Amount Paid" value="{{ $order->price }}" :is-price="true"></detail-row>
        </info-card>

        <info-card title="Timeline" :use-body="true">
            <detail-row label="Order Placed" value="{{ $order->created_at->format('M d, Y') }}"></detail-row>
            
            @if($order->status === 'completed')
                <detail-row label="Completed On" value="{{ $order->updated_at->format('M d, Y') }}"></detail-row>
            @else
                <detail-row label="Status" value="Work in progress..." value-class="status-text-pending"></detail-row>
            @endif
        </info-card>

        <info-card title="Actions" :use-body="true">
            <div class="agent-actions mt-20">
                
                <a href="{{ route('agent.order') }}" class="action-btn secondary">
                    Chat with Customer
                </a>

                @if($order->status !== 'completed')
                    <form action="{{ route('agent.order.complete', $order->id) }}" method="POST" class="flex-1">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="action-btn success w-100" onclick="return confirm('Are you sure you want to mark this order as complete?')">
                            Mark as Complete
                        </button>
                    </form>
                @else
                    <button class="btn-disabled">
                        Order Completed
                    </button>
                @endif

            </div>
        </info-card>

    </section>
</x-layouts.agent>