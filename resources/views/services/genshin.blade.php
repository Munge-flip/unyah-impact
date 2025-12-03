<x-layouts.service 
    title="Genshin Impact Services"
    :banner="asset('img/genshin banner.png')"
    cssFile="genshin.css"
    jsFile="genshin.js"
>
    <x-slot:sidebar>
        <x-service.sidebar 
            :gameIcon="asset('img/paimon logo.png')"
            gameName="Genshin Impact"
        />
    </x-slot:sidebar>

    <form id="serviceForm" action="{{ route('user.order.store') }}" method="POST">
    @csrf
        <input type="hidden" name="game" value="Genshin Impact">
        <input type="hidden" name="service_category" id="inputCategory">
        <input type="hidden" name="service_type" id="inputService">
        <input type="hidden" name="price" id="inputPrice">
        <input type="hidden" name="payment_method" id="inputPayment">
        <!-- Choose a Service -->
        <div class="service-section">
            <h2>Choose a service</h2>

            <!-- Maintenance -->
            <x-service.category title="Maintenance">
                <x-service.button category="maintenance" service="daily" :price="57" label="Daily" />
                <x-service.button category="maintenance" service="weekly" :price="300" label="Weekly" />
                <x-service.button category="maintenance" service="monthly" :price="1300" label="Monthly" />
                <x-service.button category="maintenance" service="full-patch" :price="700" label="Full Patch (6 weeks)" />
            </x-service.category>

            <!-- Regular Quests -->
            <x-service.category title="Regular Quests">
                <x-service.button category="quests" service="short" :price="50" label="Short quests (1-2 parts)" />
                <x-service.button category="quests" service="long" :price="170" label="Long quests (multiple parts, lots of dialogue/fighting)" />
            </x-service.category>

            <!-- Events -->
            <x-service.category 
                title="Events" 
                :note="['*If the event hasn\'t been touched', '*If the event is halfway done']"
            >
                <x-service.button category="events" service="light" :price="120" label="Light events" />
                <x-service.button category="events" service="full" :price="120" label="Full event" />
                <x-service.button category="events" service="light-half" :price="100" label="Light events" />
                <x-service.button category="events" service="full-half" :price="200" label="Full event" />
            </x-service.category>

            <!-- Endgame -->
            <x-service.category title="Endgame">
                <x-service.button category="endgame" service="spiral" :price="120" label="Spiral abyss" />
                <x-service.button category="endgame" service="imaginarium" :price="120" label="Imaginarium Theater" />
                <x-service.button category="endgame" service="stygian" :price="120" label="Stygian Onslaught" />
            </x-service.category>

            <!-- Explorations -->
            <x-service.category 
                title="Explorations" 
                description="Select regions for your services"
                :customLayout="true"
            >
                <x-service.exploration-grid :regions="[
                    ['slug' => 'mondstadt', 'name' => 'Mondstadt'],
                    ['slug' => 'liyue', 'name' => 'Liyue'],
                    ['slug' => 'inazuma', 'name' => 'Inazuma'],
                    ['slug' => 'fontaine', 'name' => 'Fontaine'],
                    ['slug' => 'natlan', 'name' => 'Natlan'],
                    ['slug' => 'nod-krai', 'name' => 'Nod Krai'],
                ]" />
            </x-service.category>

            <!-- Unlocking Waypoints & Statues -->
            <x-service.category title="Unlocking Waypoints & Statues">
                <x-service.button category="waypoints" service="small" :price="70" label="Small Area" />
                <x-service.button category="waypoints" service="full" :price="70" label="Full Region" />
            </x-service.category>

            <!-- Chest Farming -->
            <x-service.category title="Chest Farming">
                <x-service.button category="chest" service="light" :price="120" label="Light farming (30 chests)" />
                <x-service.button category="chest" service="full" :price="120" label="Full chest run (as many as possible in a region)" />
            </x-service.category>

            <!-- Collecting Oculi -->
            <x-service.category title="Collecting oculi">
                <x-service.button category="oculi" service="one" :price="170" label="1 Region" />
                <x-service.button category="oculi" service="full" :price="120" label="Full map(all available oculi)" />
            </x-service.category>

            <!-- 100% Area Completion -->
            <x-service.category title="100% Area Completion">
                <x-service.button category="completion" service="small" :price="170" label="Small area/ex. Starfell Valley" />
                <x-service.button category="completion" service="whole" :price="120" label="Whole region" />
            </x-service.category>
        </div>

        <!-- Payment Method -->
        <x-service.payment-section />

        <!-- Order Summary -->
        <x-service.order-summary />

        <!-- Order Confirmation -->
        <x-service.order-confirmation />
    </form>
</x-layouts.service>