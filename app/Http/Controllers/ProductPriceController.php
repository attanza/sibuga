<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductPrice;
use App\Http\Requests\UpdateProductPrice;
use App\Traits\DbTrait;
use Illuminate\Http\Request;

class ProductPriceController extends Controller
{
    use DbTrait;

    protected $searchable = ['product_id', 'qty', 'price', 'lead_time',];

    public function index()
    {
        return view('productPrice.index');
    }

    public function list(Request $request)
    {
        return $this->getPaginated($request, 'ProductPrice', $this->searchable);
    }

    public function create()
    {
        return view('productPrice.create')->with(['fields' => $this->getFields()]);
    }

    public function store(StoreProductPrice $request)
    {
        $data = $this->dbStore($request, 'ProductPrice');
        if ($request->ajax()) {
            $data->load('product');
            return $data;
        }
        return redirect()->route('product-prices.index');
    }

    public function show($id)
    {
        $data = $this->dbGetById($id, 'ProductPrice');
        return view('productPrice.show')->with([
            'data' => $data,
            'fields' => $this->getFields()
        ]);
    }

    public function update(UpdateProductPrice $request, $id)
    {
        $data = $this->dbUpdate($request, $id, 'ProductPrice');
        if ($request->ajax()) {
            $data->load('product');
            return $data;
        }

        return redirect()->route('product-prices.index');
    }

    public function destroy($id)
    {
        $this->dbDelete($id, 'ProductPrice');
        return ['message' => 'ProductPrice deleted'];
    }

    protected function getFields()
    {
        $products = $this->getComboData('Product', [], 'combo', 'name');

        return [
            ['key' => 'product_id', 'caption' => 'Product', 'htmlElement' => 'select', 'selectValue' => $products],
            ['key' => 'qty', 'caption' => 'Qty', 'htmlElement' => 'text', 'type' => 'text'],
            ['key' => 'price', 'caption' => 'Price', 'htmlElement' => 'text', 'type' => 'text'],
            ['key' => 'lead_time', 'caption' => 'Lead_time', 'htmlElement' => 'text', 'type' => 'text'],
        ];
    }
}
