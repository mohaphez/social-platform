<?php

declare(strict_types=1);

namespace Modules\Comment\Database\Seeders\V1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();

        if (0 === DB::table(comment()->getTable())->count()) {
            comment()->factory()->count(50)->create();
        }

    }
}
