<x-layouts.agent>
    <section class="content">
        <div id="account-section" class="content-section active">
            <h1>My Account</h1>

            <agent-profile-card 
                name="{{ $agent->name }}" 
                id="{{ $agent->id }}" 
                handling="{{ $ordersHandling }}" 
                completed="{{ $completedCount }}" 
                rate="{{ $completionRate }}"
            ></agent-profile-card>

            <info-card title="Personal Information" manage-route="{{ route('agent.dashboard.edit') }}">
                <div class="info-grid">
                    <div class="info-item">
                        <label>Name</label>
                        <p>{{ $agent->name }}</p>
                    </div>
                    <div class="info-item">
                        <label>Email Address</label>
                        <p>{{ $agent->email }}</p>
                    </div>
                    <div class="info-item">
                        <label>Mobile Number</label>
                        <p>{{ $agent->phone ?? 'Not set' }}</p>
                    </div>
                </div>
            </info-card>

            <info-card title="Password and Security" manage-route="{{ route('agent.dashboard.update') }}">
                <div class="info-grid">
                    <div class="info-item">
                        <label>Password</label>
                        <p>••••••••</p>
                    </div>
                    <div class="info-item">
                        <label>Account Created</label>
                        <p>{{ $agent->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </info-card>
        </div>
    </section>
</x-layouts.agent>