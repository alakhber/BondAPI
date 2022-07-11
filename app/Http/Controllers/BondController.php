<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseOrderStoreRequest;
use App\Repositories\Bond\BondInterface;

/**
 * @OA\Info(title="API List", version="1.0")
 */
class BondController extends Controller
{
    private $repository;

    public function __construct(BondInterface $bondInterface)
    {
        $this->repository = $bondInterface;
    }

    /**
     *  @OA\Get(
     *    path="/api/bond/{id}/payouts",
     *    summary="Get Bond Payout Dates",
     *    description="Get Bond Payout Dates",
     *    tags={"Bond API"},
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Bond Id",
     *         required=true,
     *         example="1",
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *  )
     */
    public function payouts($id)
    {
        return $this->repository->payouts($id);
    }

    /**
     * @OA\Post(
     *  path="/api/bond/{id}/order",
     *  summary="Create Order API",
     *  description="Create Order API",
     *  tags={"Bond API"},
     *      @OA\Parameter(
     *              name="order_date",
     *              in="query",
     *              description="Order Date",
     *              required=true,
     *              example="2021-11-08",
     *      ),
     *      @OA\Parameter(
     *              name="bond_received",
     *              in="query",
     *              description="bond received",
     *              required=true,
     *              example="1",
     *       ),
     *      @OA\Parameter(
     *              name="id",
     *              in="path",
     *              description="Bond Id",
     *              required=true,
     *              example="1",
     *       ),
     *      @OA\Response(
     *           response=200,
     *           description="OK",
     *           @OA\MediaType(mediaType="application/json",)
     *      ),
     * ),
     */
    public function purchaseOrderStore(PurchaseOrderStoreRequest $request, $id)
    {
        return $this->repository->purchaseOrderStore($request, $id);
    }

    /**
     * @OA\Post(
     *    path="/api/bond/order/{id}",
     *    summary="Bond Order Interest Payments API",
     *    description="Bond Order Interest Payments API",
     *    tags={"Bond API"},
     *      @OA\Parameter(
     *           name="id",
     *           in="path",
     *           description="Bond Id",
     *           required=true,
     *           example="1",
     *      ),
     *      @OA\Response(
     *           response=200,
     *           description="OK",
     *           @OA\MediaType(mediaType="application/json",)
     *      ),
     * ),
     */
    public function bondInterestPayments($id)
    {
        return $this->repository->bondInterestPayments($id);
    }
}
