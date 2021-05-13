<?php

use App\Models\Client;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function(Blueprint $table) {
            $table->id();
            $table->string('client_name', 100);
            $table->text('address1');
            $table->text('address2');
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('country', 100);
            $table->double('latitude', 10, 7);
            $table->double('longitude', 10, 7);
            $table->string('phone_no1', 20);
            $table->string('phone_no2', 20);
            $table->string('zip', 20);
            $table->date('start_validity');
            $table->date('end_validity');
            $table->enum('status', [Client::ACTIVE, Client::INACTIVE]);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
