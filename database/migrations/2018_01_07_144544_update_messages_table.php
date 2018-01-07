<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->integer('conversation_id')->unsigned()->nullable()->after('id');
            $table->foreign('conversation_id')->references('id')->on('conversations');

            $table->dropForeign(['from_id']);
            $table->dropColumn('from_id');
            $table->dropForeign(['to_id']);
            $table->dropColumn('to_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['conversation_id']);
            $table->dropColumn('conversation_id');
            $table->integer('from_id')->unsigned();
            $table->foreign('from_id')->references('id')->on('users');
            $table->integer('to_id')->unsigned();
            $table->foreign('to_id')->references('id')->on('users');
        });
    }
}
