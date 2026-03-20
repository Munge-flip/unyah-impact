<x-layouts.app>
    <x-slot:sidebar>
        <x-user.sidebar />
    </x-slot:sidebar>

    <section class="content">
        <div id="orders-section" class="content-section">
            <h1>Order History</h1>

            <order-history-list api-url="/user/api/orders"></order-history-list>
        </div>
    </section>
</x-layouts.app>
