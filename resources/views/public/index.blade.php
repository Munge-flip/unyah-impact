<x-layouts.public>

        <div class="body-container">
            <service-card 
                title="Genshin Impact" 
                image="/img/genshin.png" 
                link="{{ route('services.genshin') }}"
                custom-class="first-frame"
                label-class="genshin"
                image-class="img1"
            ></service-card>

            <service-card 
                title="Honkai Star Rail" 
                image="/img/hsr.png" 
                link="{{ route('services.hsr') }}"
                custom-class="second-frame"
                label-class="honkai"
                image-class="img2"
            ></service-card>

            <service-card 
                title="Zenless Zone Zero" 
                image="/img/zzz.png" 
                link="{{ route('services.zzz') }}"
                custom-class="third-frame"
                label-class="zzz"
                image-class="img3"
            ></service-card>
        </div>

</x-layouts.public>