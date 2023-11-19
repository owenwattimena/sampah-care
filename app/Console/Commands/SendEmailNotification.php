<?php

namespace App\Console\Commands;

use App\Mail\NotificationMail;
use App\Models\Admin;
use App\Models\Pengaduan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengirimkan notifikasi kepada admin dan user.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pengaduanPending = Pengaduan::where('status', 'pending')->get();
        $emailAdmin = Admin::select('email','level', 'nama')->get();
        foreach ($emailAdmin as $key => $value) {
            if($value->email){
                $data = [
                    'nama' => $value->nama,
                    'totalPending' => $pengaduanPending->count(),
                    'pengaduan' => $pengaduanPending
                ];
                Mail::to($value->email)->send(new NotificationMail('mail.admin.index', $data));
            }
        }
        return Command::SUCCESS;
    }
}
