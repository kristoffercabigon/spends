<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Web3\Web3;
use Web3\Contract;

class StorePensionSchedule extends Command
{
    protected $signature = 'pension:store {filePath}';
    protected $description = 'Store pension data on the blockchain';

    private $web3;
    private $contract;

    public function __construct()
    {
        parent::__construct();

        $rpcUrl = "http://127.0.0.1:8545";
        $contractAddress = "0x2e124F38F8021986c4Ba1459C42AeA2B7DE644cb";

        $contractJson = json_decode(file_get_contents(base_path('build/contracts/Spends.json')), true);
        $contractAbi = $contractJson['abi'];

        $this->web3 = new Web3($rpcUrl);
        $this->contract = new Contract($this->web3->provider, $contractAbi);
        $this->contract->at($contractAddress);
    }

    public function handle()
    {
        $filePath = $this->argument('filePath');

        if (!Storage::exists($filePath)) {
            $this->error("File not found: $filePath");
            return 1;
        }

        $jsonData = Storage::get($filePath);
        $data = json_decode($jsonData, true);

        if (!$data || !isset($data['total_beneficiaries'], $data['total_pension_amount'], $data['senior_ids'])) {
            $this->error("Invalid JSON structure.");
            return 1;
        }

        $this->info("Parsed Pension Data:");
        $this->info(json_encode($data, JSON_PRETTY_PRINT));

        $this->storeOnBlockchain($data);
        return 0;
    }

    private function storeOnBlockchain($data)
    {
        $fromAccount = "0xD41344EDa172b9080F488a99567c114688346996";

        $this->contract->send(
            'storePensionData',
            $data['total_beneficiaries'],
            $data['total_pension_amount'],
            json_encode($data['senior_ids']),
            ['from' => $fromAccount, 'gas' => '6000000'],
            function ($err, $result) {
                if ($err !== null) {
                    $this->error("Blockchain Error: " . $err->getMessage());
                    return;
                }
                $this->info("Transaction Successful: " . $result);
            }
        );
    }
}
