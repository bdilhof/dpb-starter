@props([
    'small' => true,
    'striped' => true,
])

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table @class(['table align-middle text-nowrap m-0', 'table-sm' => $small, 'table-hover'])>
                {{ $slot }}
            </table>
        </div>
    </div>
</div>
