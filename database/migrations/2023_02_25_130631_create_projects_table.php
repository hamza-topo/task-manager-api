<?php

use App\Enums\Project;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->tinyInteger('visibility')->default(Project::PUBLIC)->comment('private:' . Project::PRIVATE . ';public:' . Project::PUBLIC);
            $table->tinyInteger('status')->default(Project::PENDING)->comment('pending:' . Project::PENDING . ';in_progress:' . Project::IN_PROGRESS . ';completed:' . Project::COMPLETED);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
