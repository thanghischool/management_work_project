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
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
        Schema::create("workspaces", function (Blueprint $table) {
            $table->id();
            $talbe->string("name",50)->nullable(false);
            $table->string("avatar")->nullable(false);
            $table->bigInteger("admin_ID");
            $table->tinyInteger("isPublic")->nullable(false)->default(0);
            $table->foreign("admin_ID")->references("id")->on("users");
        });
        Schema::create("projects", function (Blueprint $table) {
            $table->id();
            $table->bigInteger("workspace_ID");
            $talbe->string("name",50)->nullable(false);
            $table->string("background_color");
            $table->tinyInteger("isPublic")->nullable(false)->default(0);
            $table->smallInteger('index')->nullable(false);
            $table->decimal("rate", 5, 2)->nullable(true)->default(0);
            $table->foreign("workspace_ID")->references("id")->on("workspaces")->onDelete("cascade");
        });
        Schema::create("lists", function (Blueprint $table) {
            $table->id();
            $table->bigInteger("project_ID");
            $talbe->string("title",50)->nullable(false);
            $table->smallInteger('index')->nullable(false);
            $table->foreign("project_ID")->references("id")->on("projects")->onDelete("cascade");
        });
        Schema::create("cards", function (Blueprint $table) {
            $table->id();
            $table->bigInteger("list_ID")->nullable(false);
            $talbe->string("title",50)->nullable(false);
            $table->string("description");
            $table->smallInteger('index')->nullable(false);
            $table->foreign("list_ID")->references("id")->on("lists")->onDelete("cascade");
        });
        Schema::create("files", function (Blueprint $table) {
            $table->id();
            $table->bigInteger("card_ID")->nullable(false);
            $talbe->string("link")->nullable(false);
            $talbe->string("name")->nullable(false);
            $table->foreign("card_ID")->references("id")->on("cards")->onDelete("cascade");
        });
        Schema::create("comments", function (Blueprint $table) {
            $table->id();
            $table->bigInteger("card_ID")->nullable(false);
            $table->bigInteger("user_ID")->nullable(false);
            $table->dateTime('created_at');
            $talbe->string("content")->nullable(false);
            $table->foreign("card_ID")->references("id")->on("activities")->onDelete("cascade");
            $table->foreign("user_ID")->references("id")->on("users")->onDelete("cascade");
        });
        Schema::create("logs", function (Blueprint $table) {
            $table->id();
            $table->bigInteger("card_ID")->nullable(false);
            $table->bigInteger("user_ID")->nullable(false);
            $table->dateTime('created_at');
            $talbe->string("action")->nullable(false);
            $table->foreign("card_ID")->references("id")->on("cards")->onDelete("cascade");
            $table->foreign("user_ID")->references("id")->on("users")->onDelete("cascade");
        });
        Schema::create("checklists", function (Blueprint $table) {
            $table->id();
            $table->bigInteger("card_ID")->nullable(false);
            $talbe->string("title")->nullable(false);
            $table->foreign("card_ID")->references("id")->on("cards")->onDelete("cascade");
        });
        Schema::create("tasks", function (Blueprint $table) {
            $table->id();
            $table->bigInteger("checkList_ID")->nullable(false);
            $talbe->string("content")->nullable(false);
            $table->foreign("checkList_ID")->references("id")->on("checklists")->onDelete("cascade");
            $table->dateTime('overdue');
        });
        Schema::create("task_user", function (Blueprint $table) {
            $table->id();
            $table->bigInteger("task_ID")->nullable(false);
            $table->bigInteger("user_ID")->nullable(false);
            $talbe->string("content")->nullable(false);
            $table->foreign("task_ID")->references("id")->on("tasks")->onDelete("cascade");
            $table->foreign("user_ID")->references("id")->on("users")->onDelete("cascade");
        });
        Schema::create("user_workspace", function (Blueprint $table) {
            $table->id();
            $table->bigInteger("workspace_ID")->nullable(false);
            $table->bigInteger("user_ID")->nullable(false);
            $table->foreign("workspace_ID")->references("id")->on("workspaces")->onDelete("cascade");
            $table->foreign("user_ID")->references("id")->on("users")->onDelete("cascade");
        });
        Schema::create("message", function (Blueprint $table) {
            $table->id();
            $table->bigInteger("workspace_ID")->nullable(false);
            $table->dateTime('created_at');
            $table->bigInteger("user_ID")->nullable(false);
            $talbe->string("content")->nullable(false);
            $table->foreign("workspace_ID")->references("id")->on("workspaces")->onDelete("cascade");
            $table->foreign("user_ID")->references("id")->on("users")->onDelete("cascade");
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
