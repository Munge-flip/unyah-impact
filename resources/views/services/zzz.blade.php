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

            {{-- 2. Hollow Zero --}}
            @if(isset($services['Hollow Zero']))
                <service-category title="Hollow Zero" description="Choose a Mode" :custom-layout="true">
                    <mode-selection :items="[
                        {'slug': 'lost-void', 'name': 'Lost Void'},
                        {'slug': 'withered-domain', 'name': 'Withered Domain'},
                    ]"></mode-selection>

                    <div class="service-options" style="margin-top: 20px">
                        @foreach($services['Hollow Zero'] as $service)
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

            {{-- 3. Explorations / Completion --}}
            <service-category title="Explorations" :custom-layout="true">
                @if(isset($services['100% Area Completion']))
                    <h4 style="font-size: 18px; margin-bottom: 15px; color: #666;">100% Area Completion</h4>
                    <div class="service-options">
                        @foreach($services['100% Area Completion'] as $service)
                            <service-button 
                                category="{{ $service->category }}" 
                                service="{{ $service->slug }}" 
                                :price="{{ $service->price }}" 
                                label="{{ $service->name }}" 
                            ></service-button>
                        @endforeach
                    </div>
                @endif
            </service-category>
        </div>

        <payment-section></payment-section>
        <order-summary></order-summary>
    </form>
</x-layouts.service>
