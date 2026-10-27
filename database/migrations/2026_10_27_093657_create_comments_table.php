<?php

use App\Models\Recipe;
use App\Models\User;
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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->tinyInteger('rating');
            $table->foreignIdFor(Recipe::class)->nullable()->constrained()->nullOnDelete(); //null zodat gebruiker aantal comments kan tellen, ookal is het recept weg
            $table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete();   //null zodat comment altijd bij recept blijven horen, ookal is er geen gebruiker
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
