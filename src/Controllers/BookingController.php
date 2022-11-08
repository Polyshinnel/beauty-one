<?php


namespace App\Controllers;


use App\Repository\BookingRepository;

class BookingController
{
    private $bookingRepository;

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function checkBooking($seatId,$dateStart,$dateEnd) {
        $filter = [
            'seat_id' => $seatId
        ];
        $bookings = $this->getBookings($filter,$dateStart);
        if(!empty($bookings)) {
            foreach ($bookings as $booking) {
                $starBooking = $booking['time_start'];
                $endBooking = $booking['time_end'];
                //Если есть сопадения хоть с одной записью - ставим true
                $resultChecking = $this->checkBookingPeriod($starBooking,$endBooking,$dateStart,$dateEnd);
                if($resultChecking == true) {
                    return true;
                }
            }
        }


        return false;
    }

    private function getBookings($filter,$dateStart) {
        $dateArr = explode(' ',$dateStart);
        $startPeriod = $dateArr[0].' 00:00:00';
        $endPeriod = $dateArr[0].' 23:59:00';

        return $this->bookingRepository->getBookingsFromPeriod($filter,$startPeriod,$endPeriod);
    }

    private function checkBookingPeriod($starBooking,$endBooking,$dateStart,$dateEnd) {
        $startBookingNum = (int)strtotime($starBooking);
        $endBookingNum = (int)strtotime($endBooking);

        $dateStartNum = (int)strtotime($dateStart);
        $dateEndNum = (int)strtotime($dateEnd);

        $resultChecking = false;

        //Проверяем входит ли время старта в период бронирования
        if(($dateStartNum > $startBookingNum) && ($dateStartNum < $endBookingNum)) {
            $resultChecking = true;
        }

        //Проверяем входит ли время конца в период бронирования
        if(($dateEndNum > $startBookingNum) && ($dateEndNum < $endBookingNum)) {
            $resultChecking = true;
        }

        //Проверяем входит ли начало бронирования во время будущей брони
        if(($startBookingNum > $dateStartNum) && ($startBookingNum < $dateEndNum)) {
            $resultChecking = true;
        }

        //Проверяем входит ли конец бронирования во время будущей брони
        if(($endBookingNum > $dateStartNum) && ($endBookingNum < $dateEndNum)) {
            $resultChecking = true;
        }

        return $resultChecking;
    }

    public function getAllBookingsSeat($seatId) {
        return $this->bookingRepository->getAllBookingsSeat($seatId);
    }
}