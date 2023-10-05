<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('listing_images', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Listing::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('image');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listing_images');
    }
};
