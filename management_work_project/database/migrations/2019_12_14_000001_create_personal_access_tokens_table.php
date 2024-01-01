<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Nette\Schema\Schema as SchemaSchema;

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
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('expires_at')->nullable();
        });
        Schema::create("workspaces", function (Blueprint $table) {
            $table->id();
            $table->string("name", 255)->nullable(false);
            $table->string("avatar")->nullable(false);
            $table->unsignedBigInteger("admin_ID")->nullable(false);
            $table->foreign("admin_ID")->references("id")->on("users")->onDelete("cascade");
        });
        Schema::create("projects", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("workspace_ID");
            $table->string("name", 255)->nullable(false);
            $table->tinyInteger("isPublic")->nullable(false)->default(0);
            $table->string("background_color", 10)->nullable();
            $table->smallInteger('index')->nullable(false);
            $table->decimal("rate", 5, 2)->nullable()->default(0);
            $table->foreign("workspace_ID")->references("id")->on("workspaces")->onDelete("cascade");
        });
        Schema::create("lists", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("project_ID");
            $table->string("title", 255)->nullable(false);
            $table->smallInteger('index')->nullable(false);
            $table->foreign("project_ID")->references("id")->on("projects")->onDelete("cascade");
            $table->unsignedBigInteger("workspace_ID")->nullable(false);
            $table->foreign("workspace_ID")->references("id")->on("workspaces")->onDelete("cascade");
        });
        Schema::create("cards", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("list_ID")->nullable(false);
            $table->string("title", 255)->nullable(false);
            $table->string("description")->nullable();
            $table->timestamp('overdue')->nullable();
            $table->smallInteger('index')->nullable(false);
            $table->foreign("list_ID")->references("id")->on("lists")->onDelete("cascade");
            $table->unsignedBigInteger("workspace_ID")->nullable(false);
            $table->foreign("workspace_ID")->references("id")->on("workspaces")->onDelete("cascade");
        });
        Schema::create("files", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("card_ID")->nullable(false);
            $table->string("link")->nullable(false);
            $table->string("name")->nullable(false);
            $table->foreign("card_ID")->references("id")->on("cards")->onDelete("cascade");
            $table->unsignedBigInteger("workspace_ID")->nullable(false);
            $table->foreign("workspace_ID")->references("id")->on("workspaces")->onDelete("cascade");
        });
        Schema::create("comments", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("card_ID")->nullable(false);
            $table->unsignedBigInteger("user_ID")->nullable(false);
            $table->timestamp('created_at')->nullable(false);
            $table->string("content")->nullable(false);
            $table->foreign("card_ID")->references("id")->on("cards")->onDelete("cascade");
            $table->foreign("user_ID")->references("id")->on("users")->onDelete("cascade");
            $table->unsignedBigInteger("workspace_ID")->nullable(false);
            $table->foreign("workspace_ID")->references("id")->on("workspaces")->onDelete("cascade");
        });
        Schema::create("logs", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("card_ID")->nullable(false);
            $table->unsignedBigInteger("user_ID")->nullable(false);
            $table->timestamp('created_at')->nullable(false);
            $table->string("action")->nullable(false);
            $table->foreign("card_ID")->references("id")->on("cards")->onDelete("cascade");
            $table->foreign("user_ID")->references("id")->on("users")->onDelete("cascade");
        });
        Schema::create("checklists", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("card_ID")->nullable(false);
            $table->string("title")->nullable(false);
            $table->foreign("card_ID")->references("id")->on("cards")->onDelete("cascade");
            $table->unsignedBigInteger("workspace_ID")->nullable(false);
            $table->foreign("workspace_ID")->references("id")->on("workspaces")->onDelete("cascade");
        });
        Schema::create("tasks", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("checkList_ID")->nullable(false);
            $table->foreign("checkList_ID")->references("id")->on("checklists")->onDelete("cascade");
            $table->timestamp('overdue')->nullable();
            $table->unsignedBigInteger("workspace_ID")->nullable(false);
            $table->foreign("workspace_ID")->references("id")->on("workspaces")->onDelete("cascade");
        });
        Schema::create("task_user", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("task_ID")->nullable(false);
            $table->unsignedBigInteger("user_ID")->nullable(false);
            $table->string("content")->nullable(false);
            $table->foreign("task_ID")->references("id")->on("tasks")->onDelete("cascade");
            $table->foreign("user_ID")->references("id")->on("users")->onDelete("cascade");
        });
        Schema::create("user_workspace", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("workspace_ID")->nullable(false);
            $table->unsignedBigInteger("user_ID")->nullable(false);
            $table->foreign("workspace_ID")->references("id")->on("workspaces")->onDelete("cascade");
            $table->foreign("user_ID")->references("id")->on("users")->onDelete("cascade");
        });
        Schema::create("messages", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("workspace_ID")->nullable(false);
            $table->timestamp('created_at')->nullable();
            $table->unsignedBigInteger("user_ID")->nullable(false);
            $table->string("content")->nullable(false);
            $table->foreign("workspace_ID")->references("id")->on("workspaces")->onDelete("cascade");
            $table->foreign("user_ID")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_workspace');
        Schema::dropIfExists('task_user');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('logs');
        Schema::dropIfExists('files');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('checklists');
        Schema::dropIfExists('cards');
        Schema::dropIfExists('lists');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('personal_access_tokens');
        Schema::dropIfExists('workspaces');
        Schema::dropIfExists('users');
    }
};
