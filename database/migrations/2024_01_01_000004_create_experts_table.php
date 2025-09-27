<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('experts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('website')->nullable();
            $table->text('address');
            $table->foreignId('state_id')->constrained();
            $table->foreignId('lga_id')->nullable()->constrained();
            $table->foreignId('category_id')->constrained();
            $table->text('description');
            $table->string('profile_image')->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_premium')->default(false);
            $table->enum('status', ['active', 'inactive', 'pending'])->default('pending');
            $table->string('data_source')->nullable(); // manual, scraped, etc.
            $table->string('google_place_id')->nullable(); // Google Places ID for verification
            $table->json('social_media')->nullable(); // Facebook, Instagram, etc.
            $table->timestamp('premium_expires_at')->nullable();
            $table->timestamps();
            
            $table->index(['state_id', 'category_id']);
            $table->index(['status', 'is_premium']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('experts');
    }
};