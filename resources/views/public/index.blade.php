<x-layouts.public>

        <div class="body-container">
            <div class="frame first-frame">
                <a href="{{ route('services.genshin') }}">
                    <section class="label genshin">Genshin Impact</section>
                    <img src="/img/genshin.png" alt="" class="img1" />
                </a>
            </div>
            <div class="frame second-frame">
                <a href="{{ route('services.hsr') }}">
                    <section class="label honkai">Honkai Star Rail</section>
                    <img src="/img/hsr.png" alt="" class="img2" />
                </a>
            </div>
            <div class="frame third-frame">
                <a href="{{ route('services.zzz') }}">
                    <section class="label zzz">Zenless Zone Zero</section>
                    <img src="/img/zzz.png" alt="" class="img3" />
                </a>
            </div>
        </div>

</x-layouts.public>