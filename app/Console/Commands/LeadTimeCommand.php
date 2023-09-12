<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Consumer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\LeadTime;

class LeadTimeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders to users';

    /**
     * Execute the console command.
     */

    public function handle(): void
    {
        $products = Product::get();
        $productIds = $products->pluck('id');
        $productsLeadTime = $products->pluck('lead_time');
        $reminders = Product::whereIn('id', $productIds)
                            ->whereDate('created_at', '<=', now()->addDays($productsLeadTime))
                            ->whereDate('created_at', '>=', now())
                            ->get();

        foreach ($reminders as $reminder) {
            LeadTime::create([
                'product_id' => $reminder->id,
                'notification' => 'Barang ini sudah melebihi dari tenggat waktu',
            ]);
        }
        $this->info('Reminders sent successfully.');
    }

}
# * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
