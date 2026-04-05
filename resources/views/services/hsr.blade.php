<x-layouts.service title="Honkai Star Rail Services" :banner="asset('img/hsr banner.png')" :jsFile="null">
    <x-slot:sidebar>
        <x-service.sidebar :gameIcon="asset('img/hsr icon.png')" gameName="Honkai Star Rail" />
    </x-slot:sidebar>

    <form id="serviceForm" action="{{ route('user.order.store') }}" method="POST">
        @csrf

        <input type="hidden" name="game" value="Honkai Star Rail">
        
        <!-- API Data Loader -->
        <service-catalog-loader game="Honkai Star Rail"></service-catalog-loader>

        <input type="hidden" name="service_category" :value="serviceStore.categoryString">
        <input type="hidden" name="service_type" :value="serviceStore.serviceTypeString">
        <input type="hidden" name="price" :value="serviceStore.totalPriceRaw">
        <input type="hidden" name="payment_method" :value="serviceStore.paymentMethod">

        <div class="service-section">
            <h2>Choose a service</h2>

            {{-- 1. Standard Categories --}}
            <service-category title="Maintenance" api-category="Maintenance"></service-category>
            <service-category title="Regular Quests" api-category="Regular Quests"></service-category>
            <service-category title="Events" api-category="Events"></service-category>
            <service-category title="Endgame" api-category="Endgame"></service-category>

            {{-- 2. Simulated Universe --}}
            <service-category title="Simulated Universe" description="Choose a World" api-category="Simulated Universe">
                <world-selection :items="[
                    {'slug': 'swarm-disaster', 'name': 'Swarm Disaster'},
                    {'slug': 'gold-gears', 'name': 'Gold and Gears'},
                    {'slug': 'unknowable-domain', 'name': 'Unknowable Domain'},
                ]"></world-selection>
            </service-category>

            {{-- 3. Divergent Universe --}}
            <service-category title="Divergent Universe" api-category="Divergent Universe"></service-category>

            {{-- 4. Explorations --}}
            <service-category title="Explorations" description="Select regions for your services" :custom-layout="true">
                <exploration-grid :regions="[
                    {'slug': 'herta-space-station', 'name': 'Herta Space Station'},
                    {'slug': 'jarilo', 'name': 'Jarilo-VI'},
                    {'slug': 'xianzhou', 'name': 'Xianzhou Luofu'},
                    {'slug': 'penacony', 'name': 'Penacony'},
                    {'slug': 'amphoreus', 'name': 'Amphoreus'},
                ]"></exploration-grid>
            </service-category>

            {{-- 5. 100% Area Completion --}}
            <service-category title="100% Area Completion" api-category="100% Area Completion"></service-category>

        </div>

        <payment-section></payment-section>
        <order-summary></order-summary>
    </form>
</x-layouts.service>
