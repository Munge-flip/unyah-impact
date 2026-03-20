<x-layouts.agent>
    <section class="content">
        <div id="orders-section" class="content-section">
            <h1>Orders Handling</h1>

            <order-history-list 
                api-url="/agent/api/orders" 
                view-base-url="/agent/order"
                :is-agent="true"
            ></order-history-list>
        </div>
    </section>
</x-layouts.agent>