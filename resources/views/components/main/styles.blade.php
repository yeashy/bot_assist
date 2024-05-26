<style>
    .bg-company {
        background-color: {{ $company->background_color }};
    }

    .text-company {
        color: {{ $company->text_color }};
    }

    .border-company {
        border-color: {{ $company->border_color }};
    }

    .block-company {
        background-color: {{ $company->block_background_color }};
        color: {{ $company->text_color }};
    }

    .btn-shadow-company {
        box-shadow: inset 0 -200px 50px -130px {{ $company->button_background_color }}, 0px 0px 10px 0px rgba(0,0,0,0.3);
        color: {{ $company->button_text_color }};
    }

    .btn-company {
        background-color: {{ $company->button_background_color }};
        color: {{ $company->button_text_color }};
    }

    .main-block-company {
        background-color: {{ $company->main_background_color }};
        color: {{ $company->main_text_color }};
    }

    .additional-block-company {
        background-color: {{ $company->additional_background_color }};
        color: {{ $company->addtional_text_company }};
    }

    .box-shadow-basic {
        box-shadow: 0 0 30px 0 rgba(0,0,0,0.3);
    }
</style>
