<form
    id="{{ $id }}"
    action="{{ $action }}"
    method="{{ $method }}"
    data-method="{{ $method }}"
    class="{{ $class ?? '' }}"
>

    @if(!empty($title))
        @include('components.page-title', [
            'text' => $title
        ])
    @endif

    @foreach($inputs as $name => $input)
        <div class="form-group mb-2">
            <label
                class="block font-bold mb-1"
            >{{ !empty($input['label']) ? $input['label'] : '' }}</label>
            <input
                name="{{ $name }}"
                type="{{ !empty($input['type']) ? $input['type'] : 'text' }}"
                class="rounded border input-company border-company w-full p-2 bg-company mb-1 {{ !empty($input['class']) ? $input['class'] : '' }}"
                value="{{ !empty($input['value']) ? $input['value'] : '' }}"
                placeholder="{{ !empty($input['placeholder']) ? $input['placeholder'] : '' }}"
                @if(!empty($input['disabled'])) disabled @endif
                autocomplete="off"
                oninput="clearErrors(this)"
            >
        </div>
    @endforeach
    @if(!empty($submitBtn))
        @include('components.button', [
            'type' => 'submit',
            'text' => $submitBtn['text'],
            'class' => !empty($submitBtn['class']) ? $submitBtn['class'] : ''
        ])
    @endif
</form>

<script defer>
    const form = document.getElementById('{{ $id }}');

    function createErrorMessage(text, parentElement) {
        const errorMessage = document.createElement('p');
        errorMessage.classList.add('error-message', 'text-red-500', 'text-xs');

        errorMessage.innerText = '- ' + text;
        parentElement.appendChild(errorMessage);
    }

    function clearErrors(input) {
        input.classList.remove('border-red-500');
        input.classList.add('border-company');

        input.parentNode.querySelectorAll('.error-message').forEach(function (element) {
            element.remove();
        });
    }

    form.addEventListener('requested', (e) => {
        form.querySelectorAll('input').forEach(function (input) {
            clearErrors(input);
        });
    });

    form.addEventListener('error', (e) => {
        const response = e.detail.response;

        if (response.status === 422) {
            Object.entries(response.data.errors).forEach(function (attribute) {
                const input = form.querySelector('[name=' + attribute[0] + ']');

                input.classList.remove('border-company');
                input.classList.add('border-red-500');

                const attributeElement = input.parentNode;

                attribute[1].forEach(function (message) {
                    createErrorMessage(message, attributeElement)
                });
            });
        }
    });
</script>
