<script defer>
    const loadingOverlay = document.getElementById('loading');

    document.querySelectorAll('a').forEach((element) => {
        element.addEventListener('click', (e) => {
            loadingOverlay.classList.remove('hidden');
        })
    })
</script>
