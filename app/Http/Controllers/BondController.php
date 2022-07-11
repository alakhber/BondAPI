<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseOrderStoreRequest;
use App\Repositories\Bond\BondInterface;

class BondController extends Controller
{
    private $repository;

    public function __construct(BondInterface $bondInterface)
    {
        $this->repository = $bondInterface;
    }

    public function payouts($id)
    {
        return $this->repository->payouts($id);
    }

    public function purchaseOrderStore(PurchaseOrderStoreRequest $request, $id)
    {
        return $this->repository->purchaseOrderStore($request, $id);
    }

    public function bondInterestPayments($id)
    {
        return $this->repository->bondInterestPayments($id);
    }
}
