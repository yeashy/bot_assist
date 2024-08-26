<script>
    function sendAuthRequest(params) {
        axios.post('/companies/{{ $company->id }}/auth', params)
            .then((response) => {
                console.log(response);
            });
    }
</script>
