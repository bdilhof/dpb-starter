@props([
    "color" => "secondary"
])

<div class="modal fade" tabindex="-1" data-bs-backdrop="static" {{ $attributes }}>
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-wrap">

      <div class="modal-header text-bg-{{ $color }}">
        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $header }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        {{ $slot }}
      </div>

      <div class="modal-footer">
        {{ $footer }}
      </div>

    </div>
  </div>
</div>