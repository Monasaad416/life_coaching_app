<?php

namespace App\Enums;


enum OrderStatus : int{
    case ORDERED = 1;
    case PENDING = 2;
    case ACCEPTED = 3;
    case UNDER_PROCESSING = 4;
    case DELIVERED = 5;
    case CONFIRMED = 6;
    case CANCELED = 7;
    case RETURNED = 8;


    public function label() : string {
        return match($this) {
            self::ORDERED => 'Order Submitted',
            self::PENDING => 'Order Pending',
            self::ACCEPTED => 'Order Accepted',
            self::UNDER_PROCESSING => 'Under Processing',
            self::DELIVERED => 'Order Deliverd',
            self::CONFIRMED => 'Order Confirmed',
            self::CANCELED => 'Order Canceled',
            self::RETURNED => 'Order Returned',
        };
    }


        public function status() : string {
            return match($this) {
                self::ORDERED => 'primary',
                self::PENDING => 'warning',
                self::ACCEPTED => 'success',
                self::UNDER_PROCESSING => 'warning',
                self::DELIVERED => 'success',
                self::CONFIRMED => 'success',
                self::CANCELED => 'danger',
                self::RETURNED => 'danger',
            };

        }
        

    

}
