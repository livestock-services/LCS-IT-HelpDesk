<html>
<head>
    <title>Laravel Livewire Dependant Dropdown - NiceSnippets.com</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3>Laravel Livewire Dependant Dropdown -ff NiceSnippets.com</h3>
                    </div>
                    <div class="card-body">
                        @livewire('category-sub-category')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
</body>
</html>