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

            <div class="detail-row" style="align-items: center;">
                <span class="label">Amount:</span>
                <div style="display: flex; align-items: center; gap: 10px;">
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
                    <button type="button" id="btnPayNow" class="btn-primary" style="padding: 5px 15px; font-size: 12px;">
                        Submit Payment
                    </button>
                    @elseif($order->payment_status === 'pending_verification')
                    <a href="{{ route('user.transactions.show', $order->transaction->id) }}" 
                       class="btn-secondary" style="padding: 5px 15px; font-size: 12px; text-decoration: none;">
                        View Transaction
                    </a>
                    @endif
                </div>
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
                <strong style="color: #888; font-style: italic;">Work in progress...</strong>
            </div>
            @endif
        </div>

        <div class="info-card">
            <h3>Assigned Pilot</h3>
            <div class="detail-row">
                <span class="label">Pilot:</span>
                @if($order->agent)
                <strong>{{ $order->agent->name }}</strong>
                @else
                <span style="color: #e74c3c; font-style: italic; font-weight: 600;">Finding a pilot...</span>
                @endif
            </div>
        </div>
    </section>

    @if($order->payment_status === 'unpaid')
    <div id="payModal" class="modal" style="display: none;">
        <div class="modal-content" style="max-width: 600px;">
            <div class="modal-header">
                <h2>Submit Payment</h2>
                <span class="close-modal" style="cursor: pointer; font-size: 28px;">&times;</span>
            </div>
            <div class="modal-body" style="padding: 30px;">
                <p style="text-align: center; margin-bottom: 20px;">
                    Scan this QR code to pay
                    <strong>₱{{ number_format($order->price, 2) }}</strong>
                    via <strong>{{ strtoupper($order->payment_method) }}</strong>
                </p>

                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=PayOrder{{ $order->id }}" 
                     alt="Payment QR" 
                     style="display: block; margin: 0 auto 20px; border: 5px solid #f0f0f0; border-radius: 10px;">

                <form action="{{ route('user.transactions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->id }}">

                    <div class="form-group">
                        <label>Transaction Reference Number</label>
                        <input type="text" name="transaction_reference" 
                               placeholder="e.g., GCash Ref #123456789" 
                               class="search-input" style="width: 100%;">
                        <span style="font-size: 12px; color: #888;">Optional: Enter the reference number from your payment receipt</span>
                    </div>

                    <div class="form-group">
                        <label>Upload Payment Proof (Screenshot/Receipt)</label>
                        <input type="file" name="payment_proof" accept="image/*" 
                               class="search-input" style="width: 100%;">
                        <span style="font-size: 12px; color: #888;">Optional: Upload a screenshot of your payment confirmation</span>
                    </div>

                    <div style="display: flex; gap: 10px; margin-top: 20px;">
                        <button type="button" class="btn-secondary close-modal" style="flex: 1;">
                            Cancel
                        </button>
                        <button type="submit" class="btn-primary" style="flex: 1;">
                            Submit Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const payModal = document.getElementById('payModal');
            const btnPayNow = document.getElementById('btnPayNow');
            const closeModalBtns = document.querySelectorAll('.close-modal');

            if (btnPayNow) {
                btnPayNow.addEventListener('click', function() {
                    payModal.style.display = 'block';
                });
            }

            closeModalBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    payModal.style.display = 'none';
                });
            });

            window.onclick = function(event) {
                if (event.target == payModal) {
                    payModal.style.display = "none";
                }
            }
        });
    </script>
    @endif
</x-layouts.app>