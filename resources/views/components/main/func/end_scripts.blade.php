<script defer>
    const loadingOverlay = document.getElementById('loading');

    document.querySelectorAll('a').forEach((element) => {
        if (!element.classList.contains('no-loading')) {
            element.addEventListener('click', (e) => {
                loadingOverlay.classList.remove('hidden');
            });
        }
    })
</script>
