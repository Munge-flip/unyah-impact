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
        
        <!-- Bind hidden inputs to the store -->
        <input type="hidden" name="service_category" :value="serviceStore.category">
        <input type="hidden" name="service_type" :value="serviceStore.service">
        <input type="hidden" name="price" :value="serviceStore.price">
        <input type="hidden" name="payment_method" :value="serviceStore.paymentMethod">
        
        <div class="service-section">
            <h2>Choose a service</h2>

            {{-- 1. TOP SECTION --}}
            @php
                $topCategories = ['Maintenance', 'Regular Quests', 'Events', 'Endgame'];
            @endphp

            @foreach($topCategories as $categoryName)
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

            {{-- 3. BOTTOM SECTION --}}
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
        </div>

        <!-- Use Vue components for payment and summary -->
        <payment-section></payment-section>
        <order-summary></order-summary>
    </form>
</x-layouts.service>
