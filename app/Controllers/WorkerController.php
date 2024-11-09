<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\BookingModel;

class WorkerController extends BaseController
{
    public function workerDashboard() // If user_role = Worker, it will show the following - eiryk
    {
        if (session()->get('user_role') !== 'worker') {
            return redirect()->to('/');
        }


        //Find the receipt that only booked that specific worker in the database using session (eg, if si jay worker, puro mga receipts lang niya magpapakita).

        $bookingModel = new BookingModel();
        $bookings = $bookingModel->where('worker_name', session()->get('name')) -> findall();




        return view('workers/workers',['bookings' => $bookings]);
    }
}


