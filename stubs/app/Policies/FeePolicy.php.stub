<?php

namespace App\Policies;

use App\Models\Fee;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laraeast\LaravelSettings\Facades\Settings;

class FeePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any fees.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.fees');
    }

    /**
     * Determine whether the user can view the fee.
     */
    public function view(User $user, Fee $fee): bool
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.fees');
    }

    /**
     * Determine whether the user can create fees.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.fees');
    }

    /**
     * Determine whether the user can update the fee.
     */
    public function update(User $user, Fee $fee): bool
    {
        return ($user->isAdmin() || $user->hasPermissionTo('manage.fees'))
            && ! $this->trashed($fee);
    }

    /**
     * Determine whether the user can delete the fee.
     */
    public function delete(User $user, Fee $fee): bool
    {
        return ($user->isAdmin() || $user->hasPermissionTo('manage.fees'))
            && ! $this->trashed($fee);
    }

    /**
     * Determine whether the user can view trashed fees.
     */
    public function viewAnyTrash(User $user): bool
    {
        return ($user->isAdmin() || $user->hasPermissionTo('manage.fees'))
            && $this->hasSoftDeletes();
    }

    /**
     * Determine whether the user can view the trashed fee.
     */
    public function viewTrash(User $user, Fee $fee): bool
    {
        return $this->view($user, $fee) && $fee->trashed();
    }

    /**
     * Determine whether the user can restore the fee.
     */
    public function restore(User $user, Fee $fee): bool
    {
        return ($user->isAdmin() || $user->hasPermissionTo('manage.fees'))
            && $this->trashed($fee);
    }

    /**
     * Determine whether the user can permanently delete the fee.
     */
    public function forceDelete(User $user, Fee $fee): bool
    {
        return ($user->isAdmin() || $user->hasPermissionTo('manage.fees'))
            && $this->trashed($fee)
            && Settings::get('delete_forever');
    }

    /**
     * Determine wither the given fee is trashed.
     */
    public function trashed(Fee $fee): bool
    {
        return $this->hasSoftDeletes() && method_exists($fee, 'trashed') && $fee->trashed();
    }

    /**
     * Determine wither the fee use soft deleting trait.
     */
    public function hasSoftDeletes(): bool
    {
        return in_array(
            SoftDeletes::class,
            array_keys((new \ReflectionClass(Fee::class))->getTraits())
        );
    }
}
