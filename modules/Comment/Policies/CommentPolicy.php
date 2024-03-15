<?php

declare(strict_types=1);

namespace Modules\Comment\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Comment\Entities\V1\Comment;
use Modules\User\Entities\V1\User;

class CommentPolicy
{
    use HandlesAuthorization;

    public static string $entity = Comment::class;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_comment');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Comment $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Comment $comment): bool
    {
        return $user->can('view_comment');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_comment');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Comment $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Comment $comment): bool
    {
        return $user->can('update_comment');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Comment $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Comment $comment): bool
    {
        return $user->can('delete_comment');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_comment');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param User $user
     * @param Comment $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Comment $comment): bool
    {
        return $user->can('force_delete_comment');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_comment');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param User $user
     * @param Comment $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Comment $comment): bool
    {
        return $user->can('restore_comment');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_comment');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param User $user
     * @param Comment $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate(User $user, Comment $comment): bool
    {
        return $user->can('replicate_page');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('{{ Reorder }}');
    }
}
