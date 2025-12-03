@if(method_exists($fee, 'trashed') && $fee->trashed())
    @can('view', $fee)
        <a href="{{ route('dashboard.fees.trashed.show', $fee) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
    @endcan
@else
    @can('view', $fee)
        <a href="{{ route('dashboard.fees.show', $fee) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
    @endcan
@endif