use App\Console\Commands\StorePensionSchedule;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('pension:store storage/app/pensionData.json')
        ->monthlyOn(30, '23:59')
        ->withoutOverlapping();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        $this->commands([
        StorePensionSchedule::class,
        ]);
    }
}