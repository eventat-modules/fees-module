<x-layout :title="$fee->name" :breadcrumbs="['dashboard.fees.show', $fee]">
    <div class="row">
        <div class="col-md-6">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')

                <table class="table table-striped table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('fees.attributes.name')</th>
                        <td>{{ $fee->name }}</td>
                    </tr>
                    @if($fee->description)
                        <tr>
                            <th width="200">@lang('fees.attributes.description')</th>
                            <td>{!! $fee->description !!}</td>
                        </tr>
                    @endif
                    <tr>
                        <th width="200">@lang('fees.attributes.price')</th>
                        <td>{{ $fee->price }} SAR</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('fees.attributes.active')</th>
                        <td>
                            <x-boolean is="{{ $fee->active }}"></x-boolean>
                        </td>
                    </tr>
                    </tbody>
                </table>

                @slot('footer')
                    @include('dashboard.fees.partials.actions.edit')
                    @include('dashboard.fees.partials.actions.delete')
                    @include('dashboard.fees.partials.actions.restore')
                    @include('dashboard.fees.partials.actions.forceDelete')
                @endslot
            @endcomponent
        </div>
    </div>
</x-layout>
