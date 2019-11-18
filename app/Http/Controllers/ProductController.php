<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use App\Models\Product;
use App\Traits\DbTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use DbTrait;

    protected $searchable = ['name', 'buy_price', 'sell_price', 'weight', 'lead_time'];

    public function index()
    {
        return view('product.index');
    }

    public function list(Request $request)
    {
        return $this->getPaginated($request, 'Product', $this->searchable);
    }

    public function create()
    {
        return view('product.create')->with(['fields' => $this->getFields()]);
    }

    public function store(StoreProduct $request)
    {
        if ($request->has('is_publish')) {
            $request->merge(['is_publish' => true]);
        } else {
            $request->merge(['is_publish' => false]);
        }

        $data = $this->dbStore($request, 'Product');
        if ($request->ajax()) {
            return $data;
        }
        return redirect()->route('products.index');
    }

    public function show($id)
    {
        $data = $this->dbGetById($id, 'Product');
        return view('product.show')->with([
            'data' => $data,
            'fields' => $this->getFields()
        ]);
    }

    public function update(UpdateProduct $request, $id)
    {
        if ($request->has('is_publish')) {
            $request->merge(['is_publish' => true]);
        } else {
            $request->merge(['is_publish' => false]);
        }

        $data = $this->dbUpdate($request, $id, 'Product');
        if ($request->ajax()) {
            return $data;
        }
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $this->dbDelete($id, 'Product');
        return ['message' => 'Product deleted'];
    }

    public function getPriceById($id)
    {
        $product = Product::find($id);
        if (!isset($product)) {
            return response("Product not found", 400);
        }
        return $product->sell_price;
    }

    protected function getFields()
    {
        $companies = $this->getComboData('Company', ['category' => 'Vendor'], 'combo_vendor', 'name');

        return [
            ['key' => 'company_id', 'caption' => 'Vendor', 'htmlElement' => 'select', 'selectValue' => $companies],
            ['key' => 'code', 'caption' => 'Code', 'htmlElement' => 'text', 'type' => 'text'],
            ['key' => 'name', 'caption' => 'Name', 'htmlElement' => 'text', 'type' => 'text'],
            ['key' => 'buy_price', 'caption' => 'Buy Price', 'htmlElement' => 'text', 'type' => 'number'],
            ['key' => 'sell_price', 'caption' => 'Sell Price', 'htmlElement' => 'text', 'type' => 'number'],
            ['key' => 'stock', 'caption' => 'Stock', 'htmlElement' => 'text', 'type' => 'text'],
            ['key' => 'weight', 'caption' => 'Weight (gr)', 'htmlElement' => 'text', 'type' => 'number'],
            ['key' => 'lead_time', 'caption' => 'Lead Time', 'htmlElement' => 'text', 'type' => 'number'],
            ['key' => 'is_publish', 'caption' => 'Publish ?', 'htmlElement' => 'checkbox'],
            ['key' => 'description', 'caption' => 'Description', 'htmlElement' => 'text', 'type' => 'text'],
        ];
    }
}
