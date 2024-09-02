<script>
    function sendAuthRequest(params) {
        window.axios.post('/companies/{{ $company->id }}/auth', params)
            .then((response) => {
                console.log(response);
            });
    }
</script>
