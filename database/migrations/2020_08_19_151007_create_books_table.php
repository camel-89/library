<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{

	public function up()
	{
		Schema::create('books', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->year('year');
			$table->decimal('rating', 3, 2)->unsigned()->default(0.00);
			$table->unsignedBigInteger('author_id')->index();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('books');
	}

}
