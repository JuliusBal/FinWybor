<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->index(['category_id', 'published_at', 'id'], 'posts_cat_pub_idx');
            $table->index(['status', 'published_at', 'id'], 'posts_status_pub_idx');
            $table->index('title', 'posts_title_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex('posts_cat_pub_idx');
            $table->dropIndex('posts_status_pub_idx');
            $table->dropIndex('posts_title_idx');
        });
    }
};
