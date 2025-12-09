<x-layouts.service title="Honkai Star Rail Services" :banner="asset('img/hsr banner.png')" jsFile="services.js">
    <x-slot:sidebar>
        <x-service.sidebar :gameIcon="asset('img/hsr icon.png')" gameName="Honkai Star Rail" />
    </x-slot:sidebar>

    <form id="serviceForm" action="{{ route('user.order.store') }}" method="POST">
        @csrf

        <input type="hidden" name="game" value="Honkai Star Rail">
        <input type="hidden" name="service_category" id="inputCategory">
        <input type="hidden" name="service_type" id="inputService">
        <input type="hidden" name="price" id="inputPrice">
        <input type="hidden" name="payment_method" id="inputPayment">
        <div class="service-section">
            <h2>Choose a service</h2>

            {{-- 1. Standard Categories --}}
            @php
                $standardCategories = ['Maintenance', 'Regular Quests', 'Events', 'Endgame'];
            @endphp

            @foreach($standardCategories as $categoryName)
                @if(isset($services[$categoryName]))
                    <x-service.category :title="$categoryName">
                        @foreach($services[$categoryName] as $service)
                            <x-service.button 
                                :category="$service->category" 
                                :service="$service->slug" 
                                :price="$service->price" 
                                :label="$service->name" 
                            />
                        @endforeach
                    </x-service.category>
                @endif
            @endforeach

            {{-- 2. Simulated Universe (Has Custom UI Elements) --}}
            @if(isset($services['Simulated Universe']))
                <x-service.category title="Simulated Universe" description="Choose a World">
                    {{-- Static World Selection UI --}}
                    <x-service.world-selection type="world" :items="[
                            ['slug' => 'swarm-disaster', 'name' => 'Swarm Disaster'],
                            ['slug' => 'gold-gears', 'name' => 'Gold and Gears'],
                            ['slug' => 'unknowable-domain', 'name' => 'Unknowable Domain'],
                        ]" />

                    {{-- Dynamic Clear Options --}}
                    <div class="world-selection" style="margin-top: 20px">
                        @foreach($services['Simulated Universe'] as $service)
                            <x-service.button 
                                :category="$service->category" 
                                :service="$service->slug" 
                                :price="$service->price" 
                                :label="$service->name" 
                            />
                        @endforeach
                    </div>
                </x-service.category>
            @endif

            {{-- 3. Divergent Universe --}}
            @if(isset($services['Divergent Universe']))
                <x-service.category title="Divergent Universe">
                    @foreach($services['Divergent Universe'] as $service)
                        <x-service.button 
                            :category="$service->category" 
                            :service="$service->slug" 
                            :price="$service->price" 
                            :label="$service->name" 
                        />
                    @endforeach
                </x-service.category>
            @endif

            {{-- 4. Explorations (Static Grid) --}}
            <x-service.category title="Explorations" description="Select regions for your services" :customLayout="true">
                <x-service.exploration-grid :regions="[
                    ['slug' => 'herta-space-station', 'name' => 'Herta Space Station'],
                    ['slug' => 'jarilo-vi', 'name' => 'Jarilo-VI'],
                    ['slug' => 'xianzhou-luofu', 'name' => 'Xianzhou Luofu'],
                    ['slug' => 'penacony', 'name' => 'Penacony'],
                    ['slug' => 'amphoreus', 'name' => 'Amphoreus'],
                ]" />
            </x-service.category>

            {{-- 5. 100% Area Completion --}}
            @if(isset($services['100% Area Completion']))
                <x-service.category title="100% Area Completion">
                    @foreach($services['100% Area Completion'] as $service)
                        <x-service.button 
                            :category="$service->category" 
                            :service="$service->slug" 
                            :price="$service->price" 
                            :label="$service->name" 
                        />
                    @endforeach
                </x-service.category>
            @endif

        </div>

        {{-- Payment Method --}}
        <x-service.payment-section />
        {{-- Order Summary --}}
        <x-service.order-summary />
        {{-- Order Confirmation --}}
        <x-service.order-confirmation />
    </form>
</x-layouts.service>