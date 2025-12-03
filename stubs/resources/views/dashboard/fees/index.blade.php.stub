<x-layout :title="__('fees.plural')" :breadcrumbs="['dashboard.fees.index']">
    @include('dashboard.fees.partials.filter')

    @component('dashboard::components.table-box')
        @slot('title')
            @lang('fees.actions.list') ({{ $fees->total() }})
        @endslot

        <thead>
        <tr>
          <th colspan="100">
            <div class="d-flex">
                <x-check-all-delete
                        type="{{ \App\Models\Fee::class }}"
                        :resource="__('fees.plural')"></x-check-all-delete>

                <div class="ml-2 d-flex justify-content-between flex-grow-1">
                    @include('dashboard.fees.partials.actions.create')
                    @include('dashboard.fees.partials.actions.trashed')
                </div>
            </div>
          </th>
        </tr>
        <tr>
            <th style="width: 30px;" class="text-center">
              <x-check-all></x-check-all>
            </th>
            <th>@lang('fees.attributes.name')</th>
            <th>@lang('fees.attributes.price')</th>
            <th>@lang('fees.attributes.active')</th>
            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($fees as $fee)
            <tr>
                <td class="text-center">
                  <x-check-all-item :model="$fee"></x-check-all-item>
                </td>
                <td>
                    <a href="{{ route('dashboard.fees.show', $fee) }}"
                       class="text-decoration-none text-ellipsis">
                        {{ $fee->name }}
                    </a>
                </td>
                <td>{{ $fee->price }} SAR</td>
                <td>
                    <x-boolean is="{{ $fee->active }}"></x-boolean>
                </td>

                <td style="width: 160px">
                    @include('dashboard.fees.partials.actions.show')
                    @include('dashboard.fees.partials.actions.edit')
                    @include('dashboard.fees.partials.actions.delete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('fees.empty')</td>
            </tr>
        @endforelse

        @if($fees->hasPages())
            @slot('footer')
                {{ $fees->links() }}
            @endslot
        @endif
    @endcomponent
</x-layout>
