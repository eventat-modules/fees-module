<?php

Breadcrumbs::for('dashboard.fees.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(__('fees.plural'), route('dashboard.fees.index'));
});

Breadcrumbs::for('dashboard.fees.trashed', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.fees.index');
    $breadcrumb->push(__('fees.trashed'), route('dashboard.fees.trashed'));
});

Breadcrumbs::for('dashboard.fees.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.fees.index');
    $breadcrumb->push(__('fees.actions.create'), route('dashboard.fees.create'));
});

Breadcrumbs::for('dashboard.fees.show', function ($breadcrumb, $fee) {
    $breadcrumb->parent('dashboard.fees.index');
    $breadcrumb->push($fee->name ?: '#'.$fee->id, route('dashboard.fees.show', $fee));
});

Breadcrumbs::for('dashboard.fees.edit', function ($breadcrumb, $fee) {
    $breadcrumb->parent('dashboard.fees.show', $fee);
    $breadcrumb->push(__('fees.actions.edit'), route('dashboard.fees.edit', $fee));
});
