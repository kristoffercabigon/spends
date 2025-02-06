<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageType extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $MessageTypes = ['Received', 'Sent', 'Snoozed', 'Draft', 'Trash'];

        foreach ($MessageTypes as $MessageType) {
            DB::table('message_type_list')->insert([
                'message_type' => $MessageType,
            ]);
        }
    }
}
