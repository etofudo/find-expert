@props([
    'slot' => 'header',
    'class' => '',
    'style' => ''
])

@if(config('adsense.enabled') && config('adsense.publisher_id'))
    @php
        $adUnit = config("adsense.ad_units.{$slot}");
        $publisherId = config('adsense.publisher_id');
        $slotId = $adUnit['slot_id'] ?? '';
    @endphp
    
    @if($slotId)
        <div class="adsense-container {{ $class }}" style="{{ $style }}">
            <!-- Google AdSense -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-{{ $publisherId }}"
                 data-ad-slot="{{ $slotId }}"
                 data-ad-format="{{ $adUnit['format'] ?? 'auto' }}"
                 @if($adUnit['responsive'] ?? true)
                 data-full-width-responsive="true"
                 @endif></ins>
            <script>
                 (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    @endif
@endif
