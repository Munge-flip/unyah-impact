<x-layouts.service title="Zenless Zone Zero Services" :banner="asset('img/zzz banner.png')" :jsFile="null">
    <x-slot:sidebar>
        <x-service.sidebar :gameIcon="asset('img/zzz icon.png')" gameName="Zenless Zone Zero" instructionTitle="How to get started" :customInstructions="[
                'Select the service you want.',
                'Complete your payment.',
                'The service will be added to your service catalog.',
                'Wait for an agent to confirm and ask a few questions before proceeding.'
            ]" />
    </x-slot:sidebar>

    <form id="serviceForm" action="{{ route('user.order.store') }}" method="POST">
        @csrf
        <input type="hidden" name="game" value="Zenless Zone Zero">
        
        <!-- API Data Loader -->
        <service-catalog-loader game="Zenless Zone Zero"></service-catalog-loader>

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

            {{-- 2. Hollow Zero --}}
            <service-category title="Hollow Zero" description="Choose a Mode" :custom-layout="true" api-category="Hollow Zero">
                <mode-selection :items="[
                    {'slug': 'lost-void', 'name': 'Lost Void'},
                    {'slug': 'withered-domain', 'name': 'Withered Domain'},
                ]"></mode-selection>
            </service-category>

            {{-- 3. Explorations / Completion --}}
            <service-category title="Explorations" :custom-layout="true" api-category="100% Area Completion"></service-category>
        </div>

        <payment-section></payment-section>
        <order-summary></order-summary>
    </form>
</x-layouts.service>
