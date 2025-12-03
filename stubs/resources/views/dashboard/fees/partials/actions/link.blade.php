@if($fee)
    @if(method_exists($fee, 'trashed') && $fee->trashed())
        <a href="{{ route('dashboard.fees.trashed.show', $fee) }}" class="text-decoration-none text-ellipsis">
            {{ $fee->name }}
        </a>
    @else
        <a href="{{ route('dashboard.fees.show', $fee) }}" class="text-decoration-none text-ellipsis">
            {{ $fee->name }}
        </a>
    @endif
@else
    ---
@endif