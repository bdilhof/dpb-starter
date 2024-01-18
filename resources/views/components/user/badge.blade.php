@props(["user"])

<span style="background-color: {{ $user->color }} !important" class="badge rounded-pill text-bg-primary me-1" title="{{ $user->nameFormatted }}">
    {{ $user->initials }}
</span>
