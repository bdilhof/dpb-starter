@extends("_layouts.guest")

@section("main")
    <div class="h-100 w-100">
        <div class="d-flex w-100 h-100 justify-content-center align-items-center">
            <div class="w-50">

                <!-- Title -->
                <div class="mb-4 text-center">
                    <h1 class="h3">404 - Obsah sa nenašiel</h1>
                </div>

                <div class="bg-white p-4">
                    Ospravedlňujeme sa, ale požadovaná stránka nebola nájdená. Môže ísť o chybu v odkaze alebo stránka môže byť dočasne nedostupná. Skontrolujte prosím URL alebo sa vráťte na <a href="{{ route('dashboard') }}" class="text-black">domovskú stránku</a>.
                </div>
            </div>
        </div>
    </div>
@endsection
