nt<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateArticleCommentsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('article_comments', function (Blueprint $table) {
                $table->char('article_comment_id')->primary();
                $table->char('article_id', 36);
                $table->char('source_id', 36);
                $table->text('comment');
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
            Schema::dropIfExists('article_comments');
        }
    }
