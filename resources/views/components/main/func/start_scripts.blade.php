<script>
    function sendAuthRequest() {
        axios.post('/companies/{{ $company->id }}/auth', {
            hash: window.Telegram.WebApp.initData
        })
            .then((response) => {
                console.log(response);
            });
    }
</script>
