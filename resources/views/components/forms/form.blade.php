<form {{ $attributes }}>
    @csrf

    <div class="vstack gap-4">
        <div class="vstack gap-3">
            {{ $slot }}
        </div>

        <button type="submit" class="btn btn-success">
            {{ trans('ui.save') }}
        </button>
    </div>
</form>
