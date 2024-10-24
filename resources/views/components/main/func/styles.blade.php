<style>
    .bg-company-primary {
        background-color: {{ $company->primary_color }};
    }

    .bg-company-secondary {
        background-color: {{ $company->secondary_color }};
    }

    .bg-company-accent {
        background-color: {{ $company->accent_color }};
    }

    .bg-company {
        background-color: {{ $company->background_color }};
    }

    .text-company-primary {
        color: {{ $company->primary_color }};
    }

    .text-company-secondary {
        color: {{ $company->secondary_color }};
    }

    .text-company-accent {
        color: {{ $company->accent_color }};
    }

    .btn-company {
        color: {{ $company->secondary_color }};
        background-color: {{ $company->accent_color }};
    }

    .btn-company-secondary {
        color: {{ $company->accent_color }};
        background-color: {{ $company->secondary_color }};
    }

    .btn-company:disabled, .btn-company-secondary:disabled {
        opacity: 0.5;
    }

    .border-company {
        border-color: {{ $company->primary_color }};
    }

    .shadow-company {
        box-shadow: 0 0 30px 0 {{ $company->primary_color }}4d;
    }

    .shadow-company-sm {
        box-shadow: 0 0 3px 0 {{ $company->primary_color }}4d;
    }

    .shadow-company-inner {
        box-shadow: inset 0 0 4px 0 {{ $company->primary_color }}4d;
    }

    .block-company {
        background-color: {{ $company->secondary_color }};
        color: {{ $company->primary_color }};
    }

    .block-company.active {
        box-shadow: inset 0 0 4px 0 {{ $company->primary_color }}4d;
    }

    .block-company-secondary {
        background-color: {{ $company->primary_color }};
        color: {{ $company->secondary_color }};
    }

    .input-company {
        background-color: {{ $company->secondary_color }};
        color: {{ $company->primary_color }};
        box-shadow: inset 0 0 4px 0 {{ $company->primary_color }}4d;
    }

    .input-company:disabled {
        box-shadow: none;
        opacity: 0.5;
    }

    .select-company {
        background-color: {{ $company->secondary_color }};
        color: {{ $company->primary_color }};
        box-shadow: inset 0 0 4px 0 {{ $company->primary_color }}4d;
    }

    .select-company:disabled {
        box-shadow: none;
        opacity: 0.5;
    }

    .option-company {
        background-color: {{ $company->secondary_color }};
        color: {{ $company->primary_color }};
    }

    .form-group:has(> .input-company[type=hidden]) {
        display: none;
    }

    .select-company {
        -moz-appearance: none;
        -webkit-appearance: none;
        appearance: none;
        background-image: url("data:image/svg+xml;utf8,<svg height='10px' width='10px' viewBox='0 0 16 16' fill='{{ urlencode($company->additional_text_color) }}' xmlns='http://www.w3.org/2000/svg'><path d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/></svg>");
        background-repeat: no-repeat, repeat;
        background-position: right .7em top 50%, 0 0;
        background-size: .65em auto, 100%;
    }

    .select-company:focus {
        outline: none;
    }

    .btn-shadow-company {
        box-shadow:
            inset 0 -200px 50px -130px {{ $company->primary_color }}bf,
            0px 0px 10px 0px {{ $company->primary_color }}4d;
        color: {{ $company->secondary_color }};
    }

    .btn-shadow-company:focus {
        box-shadow:
            inset 0 -200px 50px -130px {{ $company->primary_color }}bf,
            0px 0px 10px 0px {{ $company->primary_color }}4d,
            inset 0px 0px 10px 5px {{ $company->primary_color }}bf;
        transition: .08s;
    }

    input:checked + .btn-shadow-company {
        box-shadow:
            inset 0 -200px 50px -130px {{ $company->primary_color }}bf,
            0px 0px 10px 0px {{ $company->primary_color }}4d,
            inset 0px 0px 10px 5px {{ $company->primary_color }}bf;
        transition: .08s;
    }

    .heartbeat {
        -webkit-animation: heartbeat 1.5s ease-in-out infinite both;
        animation: heartbeat 1.5s ease-in-out infinite both;
    }

    ::-webkit-scrollbar {
        display: none;
    }

    /* ----------------------------------------------
 * Generated by Animista on 2024-5-26 23:44:12
 * Licensed under FreeBSD License.
 * See http://animista.net/license for more info.
 * w: http://animista.net, t: @cssanimista
 * ---------------------------------------------- */

    /**
     * ----------------------------------------
     * animation heartbeat
     * ----------------------------------------
     */
    @-webkit-keyframes heartbeat {
        from {
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-transform-origin: center center;
            transform-origin: center center;
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
        }
        10% {
            -webkit-transform: scale(0.91);
            transform: scale(0.91);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
        }
        17% {
            -webkit-transform: scale(0.98);
            transform: scale(0.98);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
        }
        33% {
            -webkit-transform: scale(0.87);
            transform: scale(0.87);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
        }
        45% {
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
        }
    }
    @keyframes heartbeat {
        from {
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-transform-origin: center center;
            transform-origin: center center;
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
        }
        10% {
            -webkit-transform: scale(0.91);
            transform: scale(0.91);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
        }
        17% {
            -webkit-transform: scale(0.98);
            transform: scale(0.98);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
        }
        33% {
            -webkit-transform: scale(0.87);
            transform: scale(0.87);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
        }
        45% {
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
        }
    }

</style>
