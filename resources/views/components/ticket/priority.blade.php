@if($ticket->hasHighPriority())
<span {{ $attributes->merge(['class' => $getClass]) }}>
    VIP
</span>
@endif