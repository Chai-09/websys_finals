<?php

namespace App\Models;
use CodeIgniter\Model;

class BookingModel extends Model{

    protected $table = 'bookings';
     protected $primaryKey = 'id';
     protected $allowedFields = [

     'worker_id',
     'customer_id',
     'worker_name',
     'date_selected',
     'time_selected',
     'time_of_booking',




     ];

    //para ma join yung dalawang tables since yung primary key id ni customer pati ni worker is nasa user table
     public function getBookingWithDetails() {
        return $this->select('bookings.*, 
                            worker.name as worker_name, 
                            customer.name as customer_name,
                            customer.email as customer_email')
                    ->join('users as worker', 'worker.id = bookings.worker_id')
                    ->join('users as customer', 'customer.id = bookings.customer_id')
                    ->findAll();
    }

    public function getWorkerBookings($workerId) {
        return $this->select('bookings.*, 
                            customer.name as customer_name,
                            customer.email as customer_email')
                    ->join('users as customer', 'customer.id = bookings.customer_id')
                    ->where('worker_id', $workerId)
                    ->findAll();
    }

    
    public function getCustomerBookings($customerId) {
        return $this->select('bookings.*, 
                            worker.name as worker_name')
                    ->join('users as worker', 'worker.id = bookings.worker_id')
                    ->where('customer_id', $customerId)
                    ->findAll();
    }


}