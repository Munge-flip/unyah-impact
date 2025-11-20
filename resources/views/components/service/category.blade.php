@props(['title', 'description' => null, 'note' => null])

<div class="service-category">
    <h3>{{ $title }}</h3>
    
    @if($description)
        <p style="font-size: 14px; color: #666; margin-bottom: 15px">
            {{ $description }}
        </p>
    @endif
    
    @if($note)
        <ul class="event-note">
            @foreach($note as $noteItem)
                <li>{{ $noteItem }}</li>
            @endforeach
        </ul>
    @endif
    
    <div class="service-options">
        {{ $slot }}
    </div>
</div>