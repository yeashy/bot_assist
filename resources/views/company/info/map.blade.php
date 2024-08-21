@include('components.page-title', ['text' => 'Мы на карте'])

<div id="map" class="w-full h-60 rounded-2xl overflow-hidden">

</div>

<script>
    @php
        $mainAffiliate = $affiliates->where('is_main', true)->first();
    @endphp

    const latitude = parseFloat("{{ $mainAffiliate?->latitude }}");
    const longitude = parseFloat("{{ $mainAffiliate?->longitude }}");

    initMap(latitude, longitude);

    async function initMap(latitude, longitude) {
        await ymaps3.ready;

        const {
            YMap,
            YMapDefaultSchemeLayer,
            YMapMarker,
            YMapDefaultFeaturesLayer
        } = ymaps3;

        document.map = new YMap(
            document.getElementById('map'),
            {
                location: {
                    center: [latitude, longitude],
                    zoom: 15
                }
            }
        );

        document.map.addChild(new YMapDefaultSchemeLayer());

        const content = document.createElement('div');
        content.innerHTML = '<i class="fa-solid fa-location-dot fa-2xl"></i>'

        document.map.addChild(new YMapDefaultFeaturesLayer({zIndex: 1800}))
        document.map.addChild(new YMapMarker({
            coordinates: [latitude, longitude],
            draggable: true
        }, content));
    }
</script>
