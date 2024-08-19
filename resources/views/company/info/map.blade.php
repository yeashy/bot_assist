@include('components.page-title', ['text' => 'Мы на карте'])

<div id="map" class="w-full h-60 rounded-2xl overflow-hidden">

</div>

<script>
    @php
        $mainAffiliate = $affiliates->where('is_main', true)->first();
    @endphp

    const latitude = parseFloat("{{ $mainAffiliate->latitude }}");
    const longitude = parseFloat("{{ $mainAffiliate->longitude }}");

    initMap();

    async function initMap() {
        await ymaps3.ready;

        const {YMap, YMapDefaultSchemeLayer} = ymaps3;

        const map = new YMap(
            document.getElementById('map'),
            {
                location: {
                    center: [latitude, longitude],
                    zoom: 15
                }
            }
        );

        map.addChild(new YMapDefaultSchemeLayer());
    }
</script>
