<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExcelsapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'excelsaps', function(Blueprint $table){
		    $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->string('description', 200);
			$table->string('excelfile', 255);
			$table->boolean('approved', true);
			$table->unsignedInteger('user_id')->nullable();
			$table->unsignedInteger('user_id_edited')->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
			$table->foreign('user_id_edited')->references('id')->on('users')->onDelete('set null');$table->timestamps();
			$table -> softDeletes();
		}
		);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('excelsaps');
    }
}
