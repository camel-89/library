<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsTable extends Migration
{

	public function up()
	{
		Schema::create('authors', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->year('year');
			$table->decimal('rating', 3, 2)->unsigned()->default(0.00);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('authors');
	}

}
