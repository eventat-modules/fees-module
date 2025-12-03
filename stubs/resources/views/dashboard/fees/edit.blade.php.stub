<x-layout :title="$fee->name" :breadcrumbs="['dashboard.fees.edit', $fee]">
    {{ BsForm::resource('fees')->putModel($fee, route('dashboard.fees.update', $fee)) }}
    @component('dashboard::components.box')
        @slot('title', __('fees.actions.edit'))

        @include('dashboard.fees.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(__('fees.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>