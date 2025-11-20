<x-layouts.service 
    title="Zenless Zone Zero Services"
    :banner="asset('img/zzz banner.png')"
    cssFile="zzz.css"
    jsFile="zzz.js"
>
    <x-slot:sidebar>
        <x-service.sidebar 
            :gameIcon="asset('img/zzz icon.png')"
            gameName="Zenless Zone Zero"
            instructionTitle="How to get started"
            :customInstructions="[
                'Select the service you want.',
                'Complete your payment.',
                'The service will be added to your service catalog.',
                'Wait for an agent to confirm and ask a few questions before proceeding.'
            ]"
        />
    </x-slot:sidebar>

    <form id="serviceForm">
        <div class="service-section">
            <h2>Choose a service</h2>

            {{-- Maintenance --}}
            <x-service.category title="Maintenance">
                <x-service.button category="maintenance" service="daily" :price="57" label="Daily" />
                <x-service.button category="maintenance" service="weekly" :price="300" label="Weekly" />
                <x-service.button category="maintenance" service="monthly" :price="1300" label="Monthly" />
                <x-service.button category="maintenance" service="full-patch" :price="1700" label="Full Patch (6 weeks)" />
            </x-service.category>

            {{-- Regular Quests --}}
            <x-service.category title="Regular Quests">
                <x-service.button category="quests" service="short" :price="60" label="Short quests (1-2 parts)" />
                <x-service.button category="quests" service="long" :price="170" label="Long quests (multiple parts, lots of dialogue/fighting)" />
            </x-service.category>

            {{-- Events --}}
            <x-service.category 
                title="Events" 
                :note="['*If the event hasn\'t been touched', '*If the event is halfway done']"
            >
                <x-service.button category="events" service="light" :price="120" label="Light events" />
                <x-service.button category="events" service="full" :price="120" label="Full event" />
                <x-service.button category="events" service="light-half" :price="100" label="Light events" />
                <x-service.button category="events" service="full-half" :price="200" label="Full event" />
            </x-service.category>

            {{-- Endgame --}}
            <x-service.category title="Endgame">
                <x-service.button category="endgame" service="shiyu-defense" :price="150" label="Shiyu Defense" />
                <x-service.button category="endgame" service="deadly-assault" :price="150" label="Deadly Assault" />
            </x-service.category>

            {{-- Hollow Zero --}}
            <x-service.category 
                title="Hollow Zero" 
                description="Choose a Mode"
            >
                {{-- Mode Selection --}}
                <x-service.world-selection 
                    type="mode"
                    :items="[
                        ['slug' => 'lost-void', 'name' => 'Lost Void'],
                        ['slug' => 'withered-domain', 'name' => 'Withered Domain'],
                    ]" 
                />

                {{-- Level Selection --}}
                <div class="service-options" style="margin-top: 20px">
                    <x-service.button category="hollow-zero" service="20-levels" :price="200" label="20 levels" />
                    <x-service.button category="hollow-zero" service="full-level" :price="1000" label="Full level" />
                </div>
            </x-service.category>

            {{-- Explorations --}}
            <div class="service-category">
                <h3>Explorations</h3>
                
                {{-- 100% Area Completion --}}
                <h4 style="font-size: 18px; margin-bottom: 15px; color: #666;">100% Area Completion</h4>
                <div class="service-options">
                    <x-service.button 
                        category="completion" 
                        service="one-location" 
                        :price="170" 
                        label="1 Location(ex. Sixth Street)" 
                    />
                    <x-service.button category="completion" service="whole-location" :price="500" label="Whole Location" />
                </div>
            </div>
        </div>

        {{-- Payment Method --}}
        <x-service.payment-section />

        {{-- Order Summary --}}
        <x-service.order-summary />

        {{-- Order Confirmation with custom button text --}}
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