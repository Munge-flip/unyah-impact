<x-layouts.app>
    <x-slot:sidebar>
        <x-user.sidebar />
    </x-slot:sidebar>

    <section class="content">
        <div class="content-section">
            <h1>My Transactions</h1>

            <div class="orders-container">
                @forelse ($transactions as $transaction)
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-id">
                            <strong>Transaction #{{ $transaction->id }}</strong>
                            <span class="order-date">{{ $transaction->created_at->format('M d, Y') }}</span>
                        </div>
                        @php
                        $statusClass = match($transaction->status) {
                            'verified' => 'completed',
                            'rejected' => 'pending',
                            'pending' => 'in-progress',
                            default => 'pending',
                        };
                        @endphp
                        <span class="status-badge {{ $statusClass }}">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </div>

                    <div class="order-details">
                        <div class="detail-row">
                            <span class="label">Order:</span>
                            <a href="{{ route('user.order.show', $transaction->order_id) }}" 
                               style="color: #667eea; text-decoration: underline;">
                                Order #{{ $transaction->order_id }}
                            </a>
                        </div>
                        <div class="detail-row">
                            <span class="label">Amount:</span>
                            <span>₱{{ number_format($transaction->amount, 2) }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Payment Method:</span>
                            <span style="text-transform: uppercase;">{{ $transaction->payment_method }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Reference:</span>
                            <span>{{ $transaction->transaction_reference ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <div class="order-actions">
                        <a href="{{ route('user.transactions.show', $transaction->id) }}" 
                           class="action-btn primary">
                            View Details
                        </a>
                    </div>
                </div>
                @empty
                <div class="order-card" style="text-align: center; color: #888;">
                    <p>No transactions found.</p>
                </div>
                @endforelse

                <div style="margin-top: 20px;">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>