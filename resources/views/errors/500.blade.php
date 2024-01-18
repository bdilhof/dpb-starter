@extends("_layouts.guest")

@section("main")
    <div class="h-100 w-100">
        <div class="d-flex w-100 h-100 justify-content-center align-items-center">
            <div class="w-50">

                <!-- Title -->
                <div class="mb-4 text-center">
                    <!-- <h1 class="h3">{{ trans('ui.error') }} 500</h1> -->
                    <h1 class="h3">500 - Chyba servera</h1>
                </div>

                <div class="bg-white p-4">
                    Ospravedlňujeme sa, ale niečo sa pokazilo na našej strane a nemôžeme spracovať vašu požiadavku v tejto chvíli. Prosím, skúste to znova o niekoľko minút. Ak problém pretrváva, kontaktujte náš tím podpory. Ďakujeme za vašu trpezlivosť a pochopenie.
                </div>
            </div>
        </div>
    </div>
@endsection
