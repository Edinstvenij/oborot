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
    public function handle(CurrencyUpdated $event)
    {
        try {
            DB::beginTransaction();

            $method = str_replace('Save', '', $event->method);

            $date = [
                'name' => $method,
                'currency_cipher' => $event->currency->cipher,
                'currency_cipher_donor' => $event->request->get('currency_cipher_donor'),
                'course' => $event->request->get('course'),
                'sum' => $event->request->get('result'),
                'sum_donor' => $event->request->get('input'),
                'comment' => $event->request->get('comment'),
                'date' => now(),
            ];

            Operation::create($date);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return throw new Exception('Поймано исключение:' . $e->getMessage() . '\n');
        }
    }
}
