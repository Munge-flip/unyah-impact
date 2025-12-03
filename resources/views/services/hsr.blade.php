<x-layouts.service 
    title="Honkai Star Rail Services"
    :banner="asset('img/hsr banner.png')"
    cssFile="hsr.css"
    jsFile="hsr.js"
>
    <x-slot:sidebar>
        <x-service.sidebar 
            :gameIcon="asset('img/hsr icon.png')"
            gameName="Honkai Star Rail"
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
                <x-service.button category="maintenance" service="full-patch" :price="700" label="Full Patch (6 weeks)" />
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
                <x-service.button category="endgame" service="memory-chaos" :price="120" label="Memory of Chaos" />
                <x-service.button category="endgame" service="pure-fiction" :price="120" label="Pure Fiction" />
                <x-service.button category="endgame" service="apocalyptic" :price="120" label="Apocalyptic Shadow" />
            </x-service.category>

            {{-- Simulated Universe --}}
            <x-service.category 
                title="Simulated Universe" 
                description="Choose a World"
            >
                {{-- World Selection --}}
                <x-service.world-selection 
                    type="world"
                    :items="[
                        ['slug' => 'swarm-disaster', 'name' => 'Swarm Disaster'],
                        ['slug' => 'gold-gears', 'name' => 'Gold and Gears'],
                        ['slug' => 'unknowable-domain', 'name' => 'Unknowable Domain'],
                    ]" 
                />

                {{-- Clear Type Options --}}
                <div class="service-options" style="margin-top: 20px">
                    <x-service.button category="simulated-clear" service="basic" :price="200" label="Basic Clear (1 World)" />
                    <x-service.button category="simulated-clear" service="full" :price="1000" label="Full Clear (All Worlds)" />
                </div>
            </x-service.category>

            {{-- Divergent Universe --}}
            <x-service.category title="Divergent Universe">
                <x-service.button category="divergent" service="basic" :price="200" label="Basic Clear (1 Protocol)" />
                <x-service.button category="divergent" service="full" :price="1000" label="Full Clear (All Protocols)" />
            </x-service.category>

            {{-- Explorations --}}
            <x-service.category 
                title="Explorations" 
                description="Select regions for your services"
                :customLayout="true"
            >
                <x-service.exploration-grid :regions="[
                    ['slug' => 'herta-space-station', 'name' => 'Herta Space Station'],
                    ['slug' => 'jarilo-vi', 'name' => 'Jarilo-VI'],
                    ['slug' => 'xianzhou-luofu', 'name' => 'Xianzhou Luofu'],
                    ['slug' => 'penacony', 'name' => 'Penacony'],
                    ['slug' => 'amphoreus', 'name' => 'Amphoreus'],
                ]" />
            </x-service.category>

            {{-- 100% Area Completion --}}
            <x-service.category title="100% Area Completion">
                <x-service.button 
                    category="completion" 
                    service="small" 
                    :price="170" 
                    label='Small area/ex. "Fallen Twilight City" Okhema' 
                />
                <x-service.button category="completion" service="whole" :price="500" label="Whole Map" />
            </x-service.category>
        </div>

        {{-- Payment Method --}}
        <x-service.payment-section />

        {{-- Order Summary --}}
        <x-service.order-summary />

        {{-- Order Confirmation --}}
        <x-service.order-confirmation />
    </form>
</x-layouts.service>