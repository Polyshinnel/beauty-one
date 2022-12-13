<?php


namespace App\Jobs;


use App\Controllers\Commands\CheckExpiredBooking;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckBookings extends Command
{
    private $checkExpiredBooking;

    public function __construct(CheckExpiredBooking $checkExpiredBooking,string $name = null)
    {
        parent::__construct($name);
        $this->checkExpiredBooking = $checkExpiredBooking;
    }

    protected function configure()
    {
        $this->setName('bookings:CheckBooking')
            ->setDescription('Проверка актуальных броней')
            ->setHelp('Проверяет не истекла ли бронь и не истек ли срок оплаты по данной брони');
    }

    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $this->checkExpiredBooking->processingExpiredBooking();
        return Command::SUCCESS;
    }
}