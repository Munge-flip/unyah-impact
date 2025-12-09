<x-layouts.service 
    title="Genshin Impact Services"
    :banner="asset('img/genshin banner.png')"
    cssFile="genshin.css"
    jsFile="services.js"
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
        
        <div class="service-section">
            <h2>Choose a service</h2>

            {{-- 1. TOP SECTION: Categories before Explorations --}}
            @php
                $topCategories = ['Maintenance', 'Regular Quests', 'Events', 'Endgame'];
            @endphp

            @foreach($topCategories as $categoryName)
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

            {{-- 2. MIDDLE SECTION: Static Explorations Grid --}}
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

            {{-- 3. BOTTOM SECTION: Categories after Explorations --}}
            @php
                $bottomCategories = [
                    'Unlocking Waypoints & Statues', 
                    'Chest Farming', 
                    'Collecting oculi', 
                    '100% Area Completion'
                ];
            @endphp

            @foreach($bottomCategories as $categoryName)
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

        </div>

        <x-service.payment-section />
        <x-service.order-summary />
        <x-service.order-confirmation />
    </form>
</x-layouts.service>