<?php

namespace App\Listeners;

use App\Events\CurrencyUpdated;
use App\Models\Operation;
use Exception;
use Illuminate\Support\Facades\DB;

class AddEntryToOperations
{
    /**
     * Handle the event.
     *
     * @param CurrencyUpdated $event
     * @return void
     * @throws Exception
     */
    public function handle(CurrencyUpdated $event): void
    {
        try {
            DB::beginTransaction();

            $data = [
                'name' => str_replace('Save', '', $event->method),
                'currency_cipher' => $event->currency->cipher,
                'currency_cipher_donor' => $event->data['currency_cipher_donor'] ?? null,
                'course' => $event->data['course'] ?? null,
                'sum' => $event->data['amountCurrency'] ?? null,
                'sum_donor' => $event->data['amountCurrencyUah'] ?? null,
                'comment' => $event->data['comment'] ?? null,
                'date' => now(),
            ];

            Operation::create($data);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Поймано исключение:' . $e->getMessage() . '\n');
        }
    }
}
