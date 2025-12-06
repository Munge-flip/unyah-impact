<x-layouts.admin>
    <section class="content">
        <div class="content-section">
            <div class="section-header">
                <h1>Transaction Management</h1>
                <div style="display: flex; gap: 10px;">
                    <input type="text" placeholder="Search transactions..." class="search-input">
                    <select class="search-input" style="width: 200px;">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="verified">Verified</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
            </div>

            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Reference</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                        <tr>
                            <td>#{{ $transaction->id }}</td>
                            <td>
                                <a href="{{ route('admin.order.show', $transaction->order_id) }}" 
                                   style="color: #667eea; text-decoration: underline;">
                                    #{{ $transaction->order_id }}
                                </a>
                            </td>
                            <td>{{ $transaction->user->name }}</td>
                            <td>₱{{ number_format($transaction->amount, 2) }}</td>
                            <td style="text-transform: uppercase;">{{ $transaction->payment_method }}</td>
                            <td>{{ $transaction->transaction_reference ?? 'N/A' }}</td>
                            <td>
                                @php
                                $badgeClass = match($transaction->status) {
                                    'verified' => 'completed',
                                    'rejected' => 'pending',
                                    'pending' => 'in-progress',
                                    default => 'pending',
                                };
                                @endphp
                                <span class="badge {{ $badgeClass }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                            <td>{{ $transaction->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.transactions.show', $transaction->id) }}" class="action-link">
                                    View Details
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr class="empty-state-row">
                            <td colspan="9">No transactions found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper">
                {{ $transactions->links() }}
            </div>
        </div>
    </section>
</x-layouts.admin>