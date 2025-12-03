@component('dashboard::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\Fee::class])
    @slot('url', route('dashboard.fees.index'))
    @slot('name', __('fees.plural'))
    @slot('active', request()->routeIs('*fees*'))
    @slot('icon', 'fas fa-money-bill-wave')
    @slot('tree', [
        [
            'name' => __('fees.actions.list'),
            'url' => route('dashboard.fees.index'),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Fee::class],
            'active' => request()->routeIs('*fees.index')
            || request()->routeIs('*fees.show'),
        ],
        [
            'name' => __('fees.actions.create'),
            'url' => route('dashboard.fees.create'),
            'can' => ['ability' => 'create', 'model' => \App\Models\Fee::class],
            'active' => request()->routeIs('*fees.create'),
        ],
    ])
@endcomponent
