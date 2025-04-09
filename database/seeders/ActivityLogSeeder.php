<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Encoder;
use App\Models\Admin;
use App\Models\Seniors;
use App\Models\PensionDistribution;
use App\Models\Barangay;
use App\Models\Events;
use App\Models\AccountStatus;
use App\Models\ApplicationStatus;
use App\Models\UserType;

class ActivityLogSeeder extends Seeder
{
    public function run(): void
    {
        $activityTypes = [
            1 => ['Add Beneficiary', 'Add Pension Distribution Program', 'Add Event'],
            2 => ['Update Beneficiary Profile', 'Update Account Status of Senior', 'Update Application Status of Senior', 'Update Pension Distribution Program', 'Update Event'],
            3 => ['Archive Beneficiary', 'Archive Application Request', 'Delete Pension Distribution Program', 'Delete Events'],
        ];

        $statuses = ['Successful', 'Cancelled'];
        $usedBeneficiaryIds = [];
        $usedProgramIds = [];
        $usedEventIds = [];

        foreach (range(1, 50) as $index) {
            $activityTypeId = rand(1, 3);
            $activityUserTypeId = rand(2, 3);
            $randomDate = Carbon::now()->subDays(rand(0, 1095))
                ->setTime(8, 0, 0)
                ->addSeconds(rand(0, 32400));

            $activity = $activityTypes[$activityTypeId][array_rand($activityTypes[$activityTypeId])];
            $encoderId = $activityUserTypeId == 2 ? rand(1, 30) : null;
            $adminId = $activityUserTypeId == 3 ? 1 : null;
            $changes = null;

            if ($activity === 'Add Beneficiary') {
                $senior = Seniors::whereNotIn('id', $usedBeneficiaryIds)->inRandomOrder()->first();

                if ($senior) {
                    $usedBeneficiaryIds[] = $senior->id;

                    if ($activityUserTypeId == 2) {
                        $encoder = Encoder::find($encoderId);
                        $modifierName = "{$encoder->encoder_first_name} {$encoder->encoder_middle_name} {$encoder->encoder_last_name}";
                        $userType = 'Encoder'; 
                    } else {
                        $admin = Admin::find($adminId);
                        $modifierName = "{$admin->admin_first_name} {$admin->admin_middle_name} {$admin->admin_last_name}";
                        $userType = 'Admin';
                    }

                    $changes = "{$userType} {$modifierName} added {$senior->first_name} {$senior->middle_name} {$senior->last_name} with Osca ID {$senior->osca_id} as Beneficiary";
                }
            }

            if ($activity === 'Add Pension Distribution Program') {
                $program = PensionDistribution::whereNotIn('id', $usedProgramIds)->inRandomOrder()->first();

                if ($program) {
                    $usedProgramIds[] = $program->id;

                    $barangay = Barangay::find($program->barangay_id);
                    $barangayNo = $barangay ? $barangay->barangay_no : 'Unknown Barangay';
                    $distributionDate = Carbon::parse($program->date_of_distribution)->translatedFormat('F j, Y h:i A');

                    if ($activityUserTypeId == 2) {
                        $encoder = Encoder::find($encoderId);
                        $modifierName = "{$encoder->encoder_first_name} {$encoder->encoder_middle_name} {$encoder->encoder_last_name}";
                        $userType = 'Encoder';
                    } else {
                        $admin = Admin::find($adminId);
                        $modifierName = "{$admin->admin_first_name} {$admin->admin_middle_name} {$admin->admin_last_name}";
                        $userType = 'Admin'; 
                    }

                    $changes = "{$userType} {$modifierName} added Pension Distribution Program for {$barangayNo} on {$distributionDate}";
                }
            }

            if ($activity === 'Add Event') {
                $event = Events::whereNotIn('id', $usedEventIds)->inRandomOrder()->first();

                if ($event) {
                    $usedEventIds[] = $event->id;

                    $eventName = $event->title;
                    $eventDate = Carbon::parse($event->event_date)->translatedFormat('F j, Y h:i A');
                    $barangay = Barangay::find($event->barangay_id);
                    $barangayNo = $barangay ? $barangay->barangay_no : 'Unknown Barangay';

                    if ($activityUserTypeId == 2) {
                        $encoder = Encoder::find($encoderId);
                        $modifierName = "{$encoder->encoder_first_name} {$encoder->encoder_middle_name} {$encoder->encoder_last_name}";
                        $userType = 'Encoder';
                    } else {
                        $admin = Admin::find($adminId);
                        $modifierName = "{$admin->admin_first_name} {$admin->admin_middle_name} {$admin->admin_last_name}";
                        $userType = 'Admin';
                    }

                    $changes = "{$userType} {$modifierName} added Event '{$eventName}' happened on {$eventDate} from {$barangayNo}";
                }
            }

            if ($activity === 'Update Beneficiary Profile') {
                $senior = Seniors::whereNotIn('id', $usedBeneficiaryIds)->inRandomOrder()->first();

                if ($senior) {
                    $usedBeneficiaryIds[] = $senior->id;

                    $modifiedColumn = ['first_name', 'middle_name', 'last_name', 'address', 'age'][rand(0, 4)];
                    $oldValue = $senior->$modifiedColumn;
                    $newValue = $this->getNewValue($modifiedColumn);

                    if ($activityUserTypeId == 2) {
                        $encoder = Encoder::find($encoderId);
                        $modifierName = "{$encoder->encoder_first_name} {$encoder->encoder_middle_name} {$encoder->encoder_last_name}";
                        $userType = 'Encoder';
                    } else {
                        $admin = Admin::find($adminId);
                        $modifierName = "{$admin->admin_first_name} {$admin->admin_middle_name} {$admin->admin_last_name}";
                        $userType = 'Admin';
                    }

                    $formattedColumnName = ucwords(str_replace('_', ' ', $modifiedColumn));

                    $changes = "{$userType} {$modifierName} changed the {$formattedColumnName} of {$senior->first_name} {$senior->middle_name} {$senior->last_name} with Osca ID {$senior->osca_id} from {$oldValue} to {$newValue}";
                }
            }

            if ($activity === 'Update Account Status of Senior') {
                $senior = Seniors::whereNotIn('id', $usedBeneficiaryIds)->inRandomOrder()->first();

                if ($senior) {
                    $usedBeneficiaryIds[] = $senior->id;
                    $oldStatus = $senior->account_status_id ? AccountStatus::find($senior->account_status_id)->senior_account_status : 'Unassigned';

                    $newStatus = AccountStatus::where('id', '!=', $senior->account_status_id)
                    ->inRandomOrder()
                    ->first()->senior_account_status;

                    if ($activityUserTypeId == 2) {
                        $encoder = Encoder::find($encoderId);
                        $modifierName = "{$encoder->encoder_first_name} {$encoder->encoder_middle_name} {$encoder->encoder_last_name}";
                        $userType = 'Encoder';
                    } else {
                        $admin = Admin::find($adminId);
                        $modifierName = "{$admin->admin_first_name} {$admin->admin_middle_name} {$admin->admin_last_name}";
                        $userType = 'Admin';
                    }

                    $changes = "{$userType} {$modifierName} changed the account status of {$senior->first_name} {$senior->middle_name} {$senior->last_name} " .
                    "with Osca ID {$senior->osca_id} from {$oldStatus} to {$newStatus}";
                }
            }

            if ($activity === 'Update Application Status of Senior') {
                $senior = Seniors::whereNotIn('id', $usedBeneficiaryIds)->inRandomOrder()->first();

                if ($senior) {
                    $usedBeneficiaryIds[] = $senior->id;
                    $oldStatus = $senior->application_status_id
                    ? ApplicationStatus::find($senior->application_status_id)->senior_application_status
                    : 'Unassigned';

                    $newStatus = ApplicationStatus::where('id', '!=', $senior->application_status_id)
                    ->inRandomOrder()
                    ->first()->senior_application_status;

                    if ($activityUserTypeId == 2) {
                        $encoder = Encoder::find($encoderId);
                        $modifierName = "{$encoder->encoder_first_name} {$encoder->encoder_middle_name} {$encoder->encoder_last_name}";
                        $userType = 'Encoder';
                    } else {
                        $admin = Admin::find($adminId);
                        $modifierName = "{$admin->admin_first_name} {$admin->admin_middle_name} {$admin->admin_last_name}";
                        $userType = 'Admin';
                    }

                    $changes = "{$userType} {$modifierName} changed the application status of {$senior->first_name} {$senior->middle_name} {$senior->last_name} " .
                    "with Osca ID {$senior->osca_id} from {$oldStatus} to {$newStatus}";
                }
            }

            if ($activity === 'Update Pension Distribution Program') {
                $program = PensionDistribution::whereNotIn('id', $usedProgramIds)->inRandomOrder()->first();

                if ($program) {
                    $usedProgramIds[] = $program->id;

                    $modifiedColumn = ['venue', 'date_of_distribution', 'end_time'][rand(0, 2)];
                    $oldValue = $program->$modifiedColumn;
                    $newValue = $this->getNewValue($modifiedColumn);

                    if (in_array($modifiedColumn, ['date_of_distribution', 'end_time']) && $oldValue) {
                        $oldValue = \Carbon\Carbon::parse($oldValue)->format('F j, Y g:i A');
                        $newValue = \Carbon\Carbon::parse($newValue)->format('F j, Y g:i A');
                    }

                    if ($activityUserTypeId == 2) {
                        $encoder = Encoder::find($encoderId);
                        $modifierName = "{$encoder->encoder_first_name} {$encoder->encoder_middle_name} {$encoder->encoder_last_name}";
                        $userType = 'Encoder';
                    } else {
                        $admin = Admin::find($adminId);
                        $modifierName = "{$admin->admin_first_name} {$admin->admin_middle_name} {$admin->admin_last_name}";
                        $userType = 'Admin';
                    }

                    $barangay = Barangay::find($program->barangay_id);
                    $barangayNo = $barangay ? $barangay->barangay_no : 'Unknown Barangay';

                    $formattedColumnName = ucwords(str_replace('_', ' ', $modifiedColumn));

                    $changes = "{$userType} {$modifierName} updated the {$formattedColumnName} of Pension Distribution Program at {$barangayNo} from {$oldValue} to {$newValue}";
                }
            }

            if ($activity === 'Update Event') {
                $event = Events::whereNotIn('id', $usedEventIds)->inRandomOrder()->first();

                if ($event) {
                    $usedEventIds[] = $event->id;

                    $modifiedColumn = ['title', 'event_date'][rand(0, 1)];
                    $oldValue = $event->$modifiedColumn;

                    if ($modifiedColumn === 'event_date' && $oldValue) {
                        $oldValue = \Carbon\Carbon::parse($oldValue)->format('F j, Y g:i A');
                    }

                    $newValue = match ($modifiedColumn) {
                        'title' => 'Updated Event Title ' . rand(1, 100),
                        'event_date' => \Carbon\Carbon::now()->addDays(rand(1, 365))->format('Y-m-d H:i:s'),
                        default => 'Unknown',
                    };

                    if ($modifiedColumn === 'event_date') {
                        $newValue = \Carbon\Carbon::parse($newValue)->format('Y-m-d H:i:s');
                    }

                    if ($activityUserTypeId == 2) {
                        $encoder = Encoder::find($encoderId);
                        $modifierName = "{$encoder->encoder_first_name} {$encoder->encoder_middle_name} {$encoder->encoder_last_name}";
                        $userType = 'Encoder';
                    } else {
                        $admin = Admin::find($adminId);
                        $modifierName = "{$admin->admin_first_name} {$admin->admin_middle_name} {$admin->admin_last_name}";
                        $userType = 'Admin';
                    }

                    $formattedColumnName = ucwords(str_replace('_', ' ', $modifiedColumn));

                    $changes = "{$userType} {$modifierName} updated the {$formattedColumnName} of Event '{$event->title}' from {$oldValue} to {$newValue}";

                    $event->$modifiedColumn = $newValue;
                    $event->save();
                }
            }

            if ($activity === 'Archive Beneficiary') {
                $senior = Seniors::whereNotIn('id', $usedBeneficiaryIds)
                ->inRandomOrder()
                ->first();

                if ($senior) {
                    $usedBeneficiaryIds[] = $senior->id;

                    if ($activityUserTypeId == 2) {
                        $encoder = Encoder::find($encoderId);
                        $modifierName = "{$encoder->encoder_first_name} {$encoder->encoder_middle_name} {$encoder->encoder_last_name}";
                        $userType = 'Encoder';
                    } else {
                        $admin = Admin::find($adminId);
                        $modifierName = "{$admin->admin_first_name} {$admin->admin_middle_name} {$admin->admin_last_name}";
                        $userType = 'Admin';
                    }

                    $formattedDate = \Carbon\Carbon::now()->format('F j, Y g:i A');

                    $changes = "{$userType} {$modifierName} archived the Beneficiary {$senior->first_name} {$senior->middle_name} {$senior->last_name} " .
                    "with Osca ID {$senior->osca_id} on {$formattedDate}";
                }
            }

            if ($activity === 'Archive Application Request') {
                $applicationRequest = Seniors::whereNotIn('id', $usedBeneficiaryIds)
                ->whereNotNull('application_status_id')
                ->inRandomOrder()
                ->first();

                if ($applicationRequest) {
                    $usedBeneficiaryIds[] = $applicationRequest->id;

                    if ($activityUserTypeId == 2) {
                        $encoder = Encoder::find($encoderId);
                        $modifierName = "{$encoder->encoder_first_name} {$encoder->encoder_middle_name} {$encoder->encoder_last_name}";
                        $userType = 'Encoder';
                    } else {
                        $admin = Admin::find($adminId);
                        $modifierName = "{$admin->admin_first_name} {$admin->admin_middle_name} {$admin->admin_last_name}";
                        $userType = 'Admin';
                    }

                    $formattedDate = \Carbon\Carbon::now()->format('F j, Y g:i A');

                    $changes = "{$userType} {$modifierName} archived the application request for {$applicationRequest->first_name} {$applicationRequest->middle_name} {$applicationRequest->last_name} " .
                    "with Osca ID {$applicationRequest->osca_id} on {$formattedDate}";
                }
            }

            if ($activity === 'Delete Pension Distribution Program') {
                $program = PensionDistribution::whereNotIn('id', $usedProgramIds)
                    ->inRandomOrder()
                    ->first();

                if ($program) {
                    $usedProgramIds[] = $program->id;

                    $barangay = Barangay::find($program->barangay_id);
                    $barangayNo = $barangay ? $barangay->barangay_no : 'Unknown Barangay';
                    $distributionDate = Carbon::parse($program->date_of_distribution)
                    ->translatedFormat('F j, Y h:i A');

                    if ($activityUserTypeId == 2) {
                        $encoder = Encoder::find($encoderId);
                        $modifierName = "{$encoder->encoder_first_name} {$encoder->encoder_middle_name} {$encoder->encoder_last_name}";
                        $userType = 'Encoder';
                    } else {
                        $admin = Admin::find($adminId);
                        $modifierName = "{$admin->admin_first_name} {$admin->admin_middle_name} {$admin->admin_last_name}";
                        $userType = 'Admin';
                    }

                    $changes = "{$userType} {$modifierName} deleted Pension Distribution Program for {$barangayNo} on {$distributionDate}";
                }
            }

            if ($activity === 'Delete Events') {
                $event = Events::whereNotIn('id', $usedEventIds)
                    ->inRandomOrder()
                    ->first();

                if ($event) {
                    $usedEventIds[] = $event->id;

                    $eventName = $event->event_title;
                    $eventDate = Carbon::parse($event->event_date)
                    ->translatedFormat('F j, Y h:i A');
                    $barangay = Barangay::find($event->barangay_id);
                    $barangayNo = $barangay ? $barangay->barangay_no : 'Unknown Barangay';

                    if ($activityUserTypeId == 2) {
                        $encoder = Encoder::find($encoderId);
                        $modifierName = "{$encoder->encoder_first_name} {$encoder->encoder_middle_name} {$encoder->encoder_last_name}";
                        $userType = 'Encoder';
                    } else {
                        $admin = Admin::find($adminId);
                        $modifierName = "{$admin->admin_first_name} {$admin->admin_middle_name} {$admin->admin_last_name}";
                        $userType = 'Admin';
                    }

                    $changes = "{$userType} {$modifierName} deleted the event '{$eventName}' scheduled on {$eventDate} at {$barangayNo}";
                }
            }

            DB::table('activity_log')->insert([
                'activity' => $activity,
                'activity_type_id' => $activityTypeId,
                'changes' => $changes,
                'status' => $statuses[array_rand($statuses)],
                'activity_user_type_id' => $activityUserTypeId,
                'activity_encoder_id' => $encoderId,
                'activity_admin_id' => $adminId,
                'created_at' => $randomDate,
            ]);
        }
    }

    private function getNewValue($column)
    {
        switch ($column) {
            case 'first_name':
                return 'New First Name';
            case 'middle_name':
                return 'New Middle Name';
            case 'last_name':
                return 'New Last Name';
            case 'address':
                return 'New Address';
            case 'age':
                return rand(50, 100);
            case 'venue':
                return 'New Venue Name';
            case 'date_of_distribution':
                return Carbon::now()->addDays(rand(1, 30))->toDateTimeString();
            case 'end_time':
                return Carbon::now()->addMinutes(rand(60, 180))->format('H:i:s');
            default:
                return 'Unknown';
        }
    }
}
