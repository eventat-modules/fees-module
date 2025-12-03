<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\FeeRequest;
use App\Models\Fee;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class FeeController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->authorizeResource(Fee::class, 'fee');
    }

    /**
     * Display a listing of the fees.
     */
    public function index(): View
    {
        $fees = Fee::filter()->latest()->paginate();

        return view('dashboard.fees.index', compact('fees'));
    }

    /**
     * Show the form for creating a new fee.
     */
    public function create(): View
    {
        return view('dashboard.fees.create');
    }

    /**
     * Store a newly created fee in storage.
     */
    public function store(FeeRequest $request): RedirectResponse
    {
        $fee = Fee::create($request->getData());

        flash()->success(__('fees.messages.created'));

        return redirect()->route('dashboard.fees.show', $fee);
    }

    /**
     * Display the specified fee.
     */
    public function show(Fee $fee): View
    {
        return view('dashboard.fees.show', compact('fee'));
    }

    /**
     * Show the form for editing the specified fee.
     */
    public function edit(Fee $fee): View
    {
        return view('dashboard.fees.edit', compact('fee'));
    }

    /**
     * Update the specified fee in storage.
     */
    public function update(FeeRequest $request, Fee $fee): RedirectResponse
    {
        $fee->update($request->getData());

        flash()->success(__('fees.messages.updated'));

        return redirect()->route('dashboard.fees.show', $fee);
    }

    /**
     * Remove the specified fee from storage.
     */
    public function destroy(Fee $fee): RedirectResponse
    {
        $fee->delete();

        flash()->success(__('fees.messages.deleted'));

        return redirect()->route('dashboard.fees.index');
    }

    /**
     * Display a listing of the trashed fees.
     */
    public function trashed(): View
    {
        $this->authorize('viewAnyTrash', Fee::class);

        $fees = Fee::onlyTrashed()->latest('deleted_at')->paginate();

        return view('dashboard.fees.trashed', compact('fees'));
    }

    /**
     * Display the specified trashed fee.
     */
    public function showTrashed(Fee $fee): View
    {
        $this->authorize('viewTrash', $fee);

        return view('dashboard.fees.show', compact('fee'));
    }

    /**
     * Restore the trashed fee.
     */
    public function restore(Fee $fee): RedirectResponse
    {
        $this->authorize('restore', $fee);

        $fee->restore();

        flash()->success(__('fees.messages.restored'));

        return redirect()->route('dashboard.fees.trashed');
    }

    /**
     * Force delete the specified fee from storage.
     */
    public function forceDelete(Fee $fee): RedirectResponse
    {
        $this->authorize('forceDelete', $fee);

        $fee->forceDelete();

        flash()->success(__('fees.messages.deleted'));

        return redirect()->route('dashboard.fees.trashed');
    }
}
