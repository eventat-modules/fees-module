<x-layout :title="__('fees.actions.create')" :breadcrumbs="['dashboard.fees.create']">
    {{ BsForm::resource('fees')->post(route('dashboard.fees.store')) }}
    @component('dashboard::components.box')
        @slot('title', __('fees.actions.create'))

        @include('dashboard.fees.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(__('fees.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>