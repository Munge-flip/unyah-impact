<x-layouts.service 
    title="Genshin Impact Services"
    :banner="asset('img/genshin banner.png')"
    cssFile="genshin.css"
    :jsFile="null"
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
        
        <!-- API Data Loader -->
        <service-catalog-loader game="Genshin Impact"></service-catalog-loader>

        <!-- Bind hidden inputs to the store -->
        <input type="hidden" name="service_category" :value="serviceStore.categoryString">
        <input type="hidden" name="service_type" :value="serviceStore.serviceTypeString">
        <input type="hidden" name="price" :value="serviceStore.totalPriceRaw">
        <input type="hidden" name="payment_method" :value="serviceStore.paymentMethod">
        
        <div class="service-section">
            <h2>Choose a service</h2>

            {{-- 1. TOP SECTION (NOW API DRIVEN) --}}
            <service-category title="Maintenance" api-category="Maintenance"></service-category>
            <service-category title="Regular Quests" api-category="Regular Quests"></service-category>
            <service-category title="Events" api-category="Events"></service-category>
            <service-category title="Endgame" api-category="Endgame"></service-category>

            {{-- 2. MIDDLE SECTION: Explorations --}}
            <service-category 
                title="Explorations" 
                description="Select regions for your services"
                :custom-layout="true"
            >
                <exploration-grid :regions="[
                    {'slug': 'mondstadt', 'name': 'Mondstadt'},
                    {'slug': 'liyue', 'name': 'Liyue'},
                    {'slug': 'inazuma', 'name': 'Inazuma'},
                    {'slug': 'fontaine', 'name': 'Fontaine'},
                    {'slug': 'natlan', 'name': 'Natlan'},
                    {'slug': 'nod-krai', 'name': 'Nod Krai'},
                ]"></exploration-grid>
            </service-category>

            {{-- 3. BOTTOM SECTION (NOW API DRIVEN) --}}
            <service-category title="Unlocking Waypoints & Statues" api-category="Unlocking Waypoints & Statues"></service-category>
            <service-category title="Chest Farming" api-category="Chest Farming"></service-category>
            <service-category title="Collecting oculi" api-category="Collecting oculi"></service-category>
            <service-category title="100% Area Completion" api-category="100% Area Completion"></service-category>
        </div>

        <!-- Use Vue components for payment and summary -->
        <payment-section></payment-section>
        <order-summary></order-summary>
    </form>
</x-layouts.service>
