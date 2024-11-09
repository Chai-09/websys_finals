<?php

namespace App\Models;
use CodeIgniter\Model;

class BookingModel extends Model{

    protected $table = 'bookings';
     protected $primaryKey = 'id';
     protected $allowedFields = [

     'customer_name',
     'customer_email',
     'worker_name',
     'date_selected',
     'time_selected',
     'time_of_booking',




     ];



}