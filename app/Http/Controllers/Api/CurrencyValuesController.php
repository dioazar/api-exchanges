<?php


namespace App\Http\Controllers\Api;


use App\Http\Requests\CurrencyFilterRequest;
use App\Http\Requests\LastCurrencyRequest;
use App\Http\Resources\CurrencyValueResource;
use App\Http\Resources\CurrencyValuesResource;
use App\Models\CurrencyValue;
use App\Services\CurrencyValueService;

class CurrencyValuesController extends \App\Http\Controllers\Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/currencies",
     *     @OA\Response(response="200", description="Display a listing of currency values.")
     * )
     */
    public function index()
    {
        $currencyValues = CurrencyValue::orderBy('id', 'DESC')->paginate(50);

        return new CurrencyValuesResource($currencyValues);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/currencies/filters?currency_code={currency_code}&date_from={date_from}&date_to={date_to}",
     *     @OA\Response(response="200", description="Display a listing of currency values with filters."),
     *     @OA\Parameter(
     *          name="currency_code",
     *          description="currency code",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *         @OA\Examples(example="string", value="USD", summary="USD currency."),
     *      ),
     *     @OA\Parameter(
     *          name="date_from",
     *          description="date from",
     *          required=false,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *          @OA\Examples(example="string", value="2020-10-12", summary="Date format YYYY-MM-DD."),
     *      ),
     *      @OA\Parameter(
     *          name="date_to",
     *          description="date to",
     *          required=false,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *          @OA\Examples(example="string", value="2020-10-14", summary="Date format YYYY-MM-DD."),
     *      ),
     * )
     * @param CurrencyFilterRequest $request
     * @return CurrencyValuesResource
     */
    public function filters(CurrencyFilterRequest $request)
    {
        $currencyValues = (new CurrencyValueService())->getWithFilters($request->validated());
        return new CurrencyValuesResource($currencyValues);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/currencies/{currency_code}/last",
     *     @OA\Response(response="200", description="Display a the last currency value of a specific currency."),
     *     @OA\Parameter(
     *          name="currency_code",
     *          description="currency code",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *          @OA\Examples(example="string", value="USD", summary="USD currency."),
     *      ),
     * )
     * @param LastCurrencyRequest $request
     * @param string $currency_code
     * @return CurrencyValueResource
     */
    public function last(LastCurrencyRequest $request, string $currency_code)
    {
        $currencyValues = (new CurrencyValueService())->getLast($currency_code);
        return new CurrencyValueResource($currencyValues);
    }
}
