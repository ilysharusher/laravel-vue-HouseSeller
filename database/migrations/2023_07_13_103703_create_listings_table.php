<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\User::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedSmallInteger('area');
            $table->unsignedTinyInteger('beds');
            $table->unsignedTinyInteger('baths');

            $table->tinyText('city');
            $table->tinyText('street');
            $table->tinyText('street_number');
            $table->tinyText('code');

            $table->unsignedInteger('price');

            $table->timestamp('sold_at')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::dropIfExists('listings');
        }
    }
};
