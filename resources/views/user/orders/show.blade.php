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
            <div class="card-body"> <div class="detail-row">
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

                <div class="detail-row align-center">
                    <span class="label">Amount:</span>
                    <div class="flex-row-gap">
                        <span class="price">₱{{ number_format($order->price, 2) }}</span>

                        @php
                        $paymentBadge = match($order->payment_status) {
                            'paid' => ['class' => 'completed', 'text' => 'Paid'],
                            'pending_verification' => ['class' => 'in-progress', 'text' => 'Pending Verification'],
                            default => ['class' => 'pending', 'text' => 'Unpaid'],
                        };
                        @endphp
                        
                        <span class="badge {{ $paymentBadge['class'] }}">
                            {{ $paymentBadge['text'] }}
                        </span>

                        @if($order->payment_status === 'unpaid')
                            <button type="button" id="btnPayNow" class="btn-primary btn-sm">
                                Submit Payment
                            </button>
                        @elseif($order->payment_status === 'pending_verification')
                            <a href="{{ route('user.transactions.show', $order->transaction->id) }}" class="btn-secondary btn-sm">
                                View Transaction
                            </a>
                        @endif
                    </div>
                </div>

                <div class="detail-row">
                    <span class="label">Payment Method:</span>
                    <strong class="text-uppercase">
                        {{ $order->payment_method ?? 'N/A' }}
                    </strong>
                </div>
            </div>
        </div>

        <div class="info-card">
            <h3>Timeline</h3>
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
                    <strong class="status-text-pending">Work in progress...</strong>
                </div>
                @endif
            </div>
        </div>

        <div class="info-card">
            <h3>Assigned Pilot</h3>
            <div class="card-body">
                <div class="detail-row">
                    <span class="label">Pilot:</span>
                    @if($order->agent)
                        <strong>{{ $order->agent->name }}</strong>
                    @else
                        <span class="text-pilot-missing">Finding a pilot...</span>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Payment Modal --}}
    @if($order->payment_status === 'unpaid')
    <div id="payModal" class="modal"> <div class="modal-content modal-medium">
            <div class="modal-header">
                <h2>Submit Payment</h2>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body text-center p-30">
                <p class="mb-20">
                    Scan this QR code to pay
                    <strong>₱{{ number_format($order->price, 2) }}</strong>
                    via <strong>{{ strtoupper($order->payment_method) }}</strong>
                </p>

                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=PayOrder{{ $order->id }}" 
                     alt="Payment QR" 
                     class="qr-code">

                <form action="{{ route('user.transactions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->id }}">

                    <div class="form-group text-left">
                        <label>Transaction Reference Number</label>
                        <input type="text" name="transaction_reference" 
                               placeholder="e.g., GCash Ref #123456789" 
                               class="search-input w-100">
                        <span class="text-help">Optional: Enter the reference number from your payment receipt</span>
                    </div>

                    <div class="form-group text-left">
                        <label>Upload Payment Proof (Screenshot/Receipt)</label>
                        <input type="file" name="payment_proof" accept="image/*" 
                               class="search-input w-100">
                        <span class="text-help">Optional: Upload a screenshot of your payment confirmation</span>
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn-secondary close-modal flex-1">
                            Cancel
                        </button>
                        <button type="submit" class="btn-primary flex-1">
                            Submit Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</x-layouts.app>

<script src="{{ asset('js/order-show.js') }}"></script>