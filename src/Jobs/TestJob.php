<?php


namespace App\Jobs;


use App\Controllers\BookingProcessingController;
use App\Controllers\TariffCalculator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestJob extends Command
{
    private $bookingProcessingController;

    public function __construct(BookingProcessingController $bookingProcessingController,string $name = null)
    {
        parent::__construct($name);
        $this->bookingProcessingController = $bookingProcessingController;
    }

    protected function configure()
    {
        $this->setName('test:Test')
            ->setDescription('Тестовая комманда')
            ->setHelp('Команда для тестирования интерфейса CLI');
    }

    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $result = $this->bookingProcessingController->bookingProcessing(1,'2022-11-02 16:00:00','2022-11-02 19:00:00');
        print_r($result);
        return Command::SUCCESS;
    }
}