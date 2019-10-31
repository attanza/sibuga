<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreQuotationProduct;
use App\Http\Requests\UpdateQuotationProduct;
use App\Traits\DbTrait;
use Illuminate\Http\Request;

class QuotationProductController extends Controller
{
    use DbTrait;

    protected $searchable = ['quotation_id','product_id','qty','price'];

    public function index()
    {
        return view('quotationProduct.index');
    }

    public function list(Request $request)
    {
        return $this->getPaginated($request, 'QuotationProduct', $this->searchable, ['product', 'quotation']);
    }

    public function create()
    {
        return view('quotationProduct.create')->with(['fields' => $this->getFields()]);
    }

    public function store(StoreQuotationProduct $request)
    {
        $data = $this->dbStore($request, 'QuotationProduct');
        if ($request->ajax()) {
            $data->load('product');
            return $data;
        }
        return redirect()->route('quotation-products.index');
    }

    public function show($id)
    {
        $data = $this->dbGetById($id, 'QuotationProduct');
        return view('quotationProduct.show')->with([
            'data' => $data,
            'fields' => $this->getFields()
        ]);
    }

    public function update(UpdateQuotationProduct $request, $id)
    {
        $data = $this->dbUpdate($request, $id, 'QuotationProduct');
        if ($request->ajax()) {
            $data->load('product');
            return $data;
        }
        return redirect()->route('quotation-products.index');
    }

    public function destroy($id)
    {
        $this->dbDelete($id, 'QuotationProduct');
        return ['message' => 'QuotationProduct deleted'];
    }

    protected function getFields()
    {
        $quotations = $this->getComboData('Quotation', [], 'combo', 'no');
        $products = $this->getComboData('Product', [], 'combo', 'name');
        $quotationData = [];
        foreach ($quotations as $q) {
            array_push($quotationData, [
                'id' => $q->id,
                'name' => $q->no
            ]);
        }
        return [
            [ 'key' => 'quotation_id', 'caption' => 'Quotation', 'htmlElement' => 'select', 'selectValue' => $quotationData ],
            [ 'key' => 'product_id', 'caption' => 'Product', 'htmlElement' => 'select', 'selectValue' => $products],
            [ 'key' => 'qty', 'caption' => 'Quantity', 'htmlElement' => 'text', 'type' => 'text' ],
            [ 'key' => 'price', 'caption' => 'Price', 'htmlElement' => 'text', 'type' => 'text' ],
            [ 'key' => 'note', 'caption' => 'Note', 'htmlElement' => 'text', 'type' => 'text' ],

        ];
    }
}
