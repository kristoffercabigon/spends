<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

class MessageTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjectTemplates = [
            'Senior Application Under Evaluation',
            'Senior Application On Hold',
            'Senior Application Approved',
            'Senior Application Rejected'
        ];

        $messageTemplates = [
            'Dear applicant, your senior application is currently under evaluation. Please wait for further updates.',
            'Your senior application is on hold due to missing information. Kindly check your email for further instructions.',
            'Congratulations! Your senior application has been approved. You can now access OSCA Spends benefits.',
            'We regret to inform you that your senior application has been rejected. Please contact our office for more details.'
        ];

        if (Schema::hasTable('message_template')) {
            foreach ($subjectTemplates as $index => $subject) {
                DB::table('message_template')->insert([
                    'subject_templates' => $subject,
                    'message_templates' => $messageTemplates[$index],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }
    }
}
