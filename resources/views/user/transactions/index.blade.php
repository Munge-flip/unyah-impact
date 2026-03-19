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
                        <status-badge status="{{ $transaction->status }}"></status-badge>
                    </div>

                    <div class="order-details">
                        <detail-row label="Order">
                            <a href="{{ route('user.order.show', $transaction->order_id) }}" 
                               style="color: #667eea; text-decoration: underline;">
                                Order #{{ $transaction->order_id }}
                            </a>
                        </detail-row>
                        <detail-row label="Amount" value="{{ $transaction->amount }}" :is-price="true"></detail-row>
                        <detail-row label="Payment Method" value="{{ $transaction->payment_method }}" value-class="text-uppercase"></detail-row>
                        <detail-row label="Reference" value="{{ $transaction->transaction_reference ?? 'N/A' }}"></detail-row>
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