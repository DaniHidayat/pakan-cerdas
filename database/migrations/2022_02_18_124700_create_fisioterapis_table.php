<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFisioterapisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fisioterapis', function (Blueprint $table) {
            $table->char('fisioterapis_id', 36)->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->text('address')->nullable();
            $table->string('village');
            $table->string('district');
            $table->string('city');
            $table->string('province');
            $table->string('phone', 20);
            $table->double('price')->nullable();
            $table->longText('about')->nullable();
            $table->string('photo')->nullable();
            $table->longText('fcm_token')->nullable();
            $table->string('lang')->nullable();
            $table->string('long')->nullable();
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
        Schema::dropIfExists('fisioterapis');
    }
}
