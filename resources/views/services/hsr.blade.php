<x-layouts.service title="Honkai Star Rail Services" :banner="asset('img/hsr banner.png')" :jsFile="null">
    <x-slot:sidebar>
        <x-service.sidebar :gameIcon="asset('img/hsr icon.png')" gameName="Honkai Star Rail" />
    </x-slot:sidebar>

    <form id="serviceForm" action="{{ route('user.order.store') }}" method="POST">
        @csrf

        <input type="hidden" name="game" value="Honkai Star Rail">
        <input type="hidden" name="service_category" :value="serviceStore.categoryString">
        <input type="hidden" name="service_type" :value="serviceStore.serviceTypeString">
        <input type="hidden" name="price" :value="serviceStore.totalPriceRaw">
        <input type="hidden" name="payment_method" :value="serviceStore.paymentMethod">

        <div class="service-section">
            <h2>Choose a service</h2>

            {{-- 1. Standard Categories --}}
            @php
                $standardCategories = ['Maintenance', 'Regular Quests', 'Events', 'Endgame'];
            @endphp

            @foreach($standardCategories as $categoryName)
                @if(isset($services[$categoryName]))
                    <service-category title="{{ $categoryName }}">
                        @foreach($services[$categoryName] as $service)
                            <service-button 
                                category="{{ $service->category }}" 
                                service="{{ $service->slug }}" 
                                :price="{{ $service->price }}" 
                                label="{{ $service->name }}" 
                            ></service-button>
                        @endforeach
                    </service-category>
                @endif
            @endforeach

            {{-- 2. Simulated Universe --}}
            @if(isset($services['Simulated Universe']))
                <service-category title="Simulated Universe" description="Choose a World">
                    <world-selection :items="[
                        {'slug': 'swarm-disaster', 'name': 'Swarm Disaster'},
                        {'slug': 'gold-gears', 'name': 'Gold and Gears'},
                        {'slug': 'unknowable-domain', 'name': 'Unknowable Domain'},
                    ]"></world-selection>

                    <div class="world-selection" style="margin-top: 20px">
                        @foreach($services['Simulated Universe'] as $service)
                            <service-button 
                                category="{{ $service->category }}" 
                                service="{{ $service->slug }}" 
                                :price="{{ $service->price }}" 
                                label="{{ $service->name }}" 
                            ></service-button>
                        @endforeach
                    </div>
                </service-category>
            @endif

            {{-- 3. Divergent Universe --}}
            @if(isset($services['Divergent Universe']))
                <service-category title="Divergent Universe">
                    @foreach($services['Divergent Universe'] as $service)
                        <service-button 
                            category="{{ $service->category }}" 
                            service="{{ $service->slug }}" 
                            :price="{{ $service->price }}" 
                            label="{{ $service->name }}" 
                        ></service-button>
                    @endforeach
                </service-category>
            @endif

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
            @if(isset($services['100% Area Completion']))
                <service-category title="100% Area Completion">
                    @foreach($services['100% Area Completion'] as $service)
                        <service-button 
                            category="{{ $service->category }}" 
                            service="{{ $service->slug }}" 
                            :price="{{ $service->price }}" 
                            label="{{ $service->name }}" 
                        ></service-button>
                    @endforeach
                </service-category>
            @endif

        </div>

        <payment-section></payment-section>
        <order-summary></order-summary>
    </form>
</x-layouts.service>
