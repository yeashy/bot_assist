@include('components.page-title', ['text' => 'Мы на карте'])

<div>
    <div id="map" class="w-full h-60 rounded-2xl overflow-hidden z-10 relative shadow-company border-t border-l border-r border-company bg-company">

    </div>
    <div class="h-64 pt-9 pb-3 overflow-y-auto rounded-2xl border-l border-r border-b mt-[-30px] border-company">
        <ul>
            @foreach($affiliates as $affiliate)
                <li class="flex flex-col p-3 pb-0 affiliate-element" id="affiliate-{{ $affiliate->id }}">
                    <div class="font-bold text-xl mb-3">
                        {{ $affiliate->name }}
                    </div>
                    <div class="font-bold opacity-85 mb-1">
                        {{ $affiliate->address }}
                    </div>
                    <a href="tel:{{ $affiliate->phone_number }}" class="mb-2 no-loading">
                        <i class="fa-solid fa-phone"></i> {{ $affiliate->phone_number }}
                    </a>
                    @include('components.button',
                        [
                            'text' => 'Открыть на карте',
                            'id' => $affiliate->id,
                            'class' => 'affiliate-toggle',
                            'onclick' => 'moveToMarker(this.dataset.latitude, this.dataset.longitude)',
                            'dataset' => [
                                'latitude' => $affiliate->latitude,
                                'longitude' => $affiliate->longitude,
                                'element_id' => 'affiliate-' . $affiliate->id
                            ]
                        ]
                    )
                </li>
            @endforeach
        </ul>
    </div>
</div>


<script>
    @php
        $mainAffiliate = $affiliates->first();
    @endphp

    const latitude = parseFloat("{{ $mainAffiliate?->latitude }}");
    const longitude = parseFloat("{{ $mainAffiliate?->longitude }}");

    initMap(latitude, longitude);

    async function initMap(latitude, longitude) {
        await ymaps3.ready;

        document.ymaps = ymaps3;
        document.ymaps.controls = await ymaps3.import('@yandex/ymaps3-controls@0.0.1');

        console.log(document.ymaps);

        document.map = new document.ymaps.YMap(
            document.getElementById('map'),
            {
                location: {
                    center: [longitude, latitude],
                    zoom: 15
                }
            }
        );

        const controls = new document.ymaps.YMapControls({position: 'top left', orientation: 'vertical'});
        controls.addChild(new document.ymaps.controls.YMapGeolocationControl());
        controls.addChild(new document.ymaps.controls.YMapZoomControl());
        document.map.addChild(controls);

        document.map.addChild(new document.ymaps.YMapDefaultSchemeLayer());
        document.map.addChild(new document.ymaps.YMapDefaultFeaturesLayer({zIndex: 1800}));

        initMarkers();
    }

    function initMarkers() {
        const affiliates = Array.from(document.getElementsByClassName('affiliate-toggle'));

        affiliates.forEach(function (affiliate) {
            addMarker(
                affiliate.dataset.element_id,
                affiliate.dataset.latitude,
                affiliate.dataset.longitude
            )
        });
    }

    function moveToMarker(latitude, longitude) {
        document.map.setLocation({
            center: [longitude, latitude],
            duration: 1000,
            zoom: 15
        });
    }

    function scrollToAffiliate(id) {
        const affiliateElement = document.querySelector(`.affiliate-element#` + id);
        affiliateElement.querySelector('.affiliate-toggle').click();

        affiliateElement.scrollIntoView({
            block: "center",
            inline: "center",
            behavior: "smooth"
        });
    }

    function addMarker(id, latitude, longitude) {
        const content = document.createElement('div');
        content.id = id;
        content.innerHTML = '<i class="fa-solid fa-location-dot fa-2xl"></i>';
        content.onclick = function () {
            scrollToAffiliate(this.id);
        }

        document.map.addChild(new document.ymaps.YMapMarker({
            coordinates: [longitude, latitude],
        }, content));
    }
</script>
