<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Categorizable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Kalnoy\Nestedset\NestedSet;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->text('type')->default('default');
            NestedSet::columns($table);
            $table->timestamps();
        });

        Schema::create('categories_relations', function (Blueprint $table) {
            $table->integer('category_id');
            $table->morphs('categorizable');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('categories_relations');
    }
}
