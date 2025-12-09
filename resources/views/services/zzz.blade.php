<x-layouts.service title="Zenless Zone Zero Services" :banner="asset('img/zzz banner.png')" jsFile="services.js">
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

            {{-- 2. Hollow Zero (Custom Layout) --}}
            @if(isset($services['Hollow Zero']))
                <x-service.category title="Hollow Zero" description="Choose a Mode" :customLayout="true">
                    {{-- Static Mode Selection --}}
                    <x-service.world-selection type="mode" :items="[
                            ['slug' => 'lost-void', 'name' => 'Lost Void'],
                            ['slug' => 'withered-domain', 'name' => 'Withered Domain'],
                        ]" />

                    {{-- Dynamic Buttons --}}
                    <div class="service-options" style="margin-top: 20px">
                        @foreach($services['Hollow Zero'] as $service)
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

            {{-- 3. Explorations / Completion --}}
            <div class="service-category">
                <h3>Explorations</h3>
                
                @if(isset($services['100% Area Completion']))
                    <h4 style="font-size: 18px; margin-bottom: 15px; color: #666;">100% Area Completion</h4>
                    <div class="service-options">
                        @foreach($services['100% Area Completion'] as $service)
                            <x-service.button 
                                :category="$service->category" 
                                :service="$service->slug" 
                                :price="$service->price" 
                                :label="$service->name" 
                            />
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <x-service.payment-section />
        <x-service.order-summary />

        <div class="order-confirmation">
            <h2>Order Confirmation</h2>
            <p>
                By availing the service I automatically agree to the
                <a href="#">Terms of Service</a>
            </p>
            <button type="submit" class="submit-btn">Get Started</button>
        </div>
    </form>
</x-layouts.service>