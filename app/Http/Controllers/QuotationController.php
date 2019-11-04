<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreQuotation;
use App\Http\Requests\UpdateQuotation;
use App\Models\Quotation;
use App\Traits\DbTrait;
use App\Traits\PdfTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class QuotationController extends Controller
{
    use DbTrait, PdfTrait;

    protected $searchable = ['company_id','no','title','terms','description',];

    public function index()
    {
        return view('quotation.index');
    }

    public function list(Request $request)
    {
        return $this->getPaginated($request, 'Quotation', $this->searchable, ['customer']);
    }

    public function create()
    {
        return view('quotation.create')->with(['fields' => $this->getFields()]);
    }

    public function store(StoreQuotation $request)
    {
        $this->dbStore($request, 'Quotation');
        return redirect()->route('quotations.index');
    }

    public function show($id)
    {
        $data = $this->dbGetById($id, 'Quotation');
        $products = $this->getComboData('Product', [], 'combo', 'name');


        return view('quotation.show')->with([
            'data' => $data,
            'products' => $products,
            'fields' => $this->getFields(),
        ]);
    }

    public function createPdf($id)
    {
        return $this->pdfForm($id);
    }

    public function generatePdf(Request $request, $id)
    {
        return $this->previewPdf($request, $id);
    }

    public function update(UpdateQuotation $request, $id)
    {
        $this->dbUpdate($request, $id, 'Quotation');
        return redirect()->route('quotations.index');
    }

    public function destroy($id)
    {
        $data = Quotation::findOrFail($id);
        if (isset($data->project)) {
            return response()->json("Quotation cannot be deleted", 400);
        }
        $this->dbDelete($id, 'Quotation', $data);
        return ['message' => 'Quotation deleted'];
    }

    protected function getFields()
    {
        $companies = $this->getComboData('Company', ['category' => 'Customer'], 'combo_customer', 'name');

        return [
            [ 'key' => 'no', 'caption' => 'No', 'htmlElement' => 'text', 'type' => 'text' ],
            [ 'key' => 'company_id', 'caption' => 'Company', 'htmlElement' => 'select', 'selectValue' => $companies ],
            [ 'key' => 'title', 'caption' => 'Title', 'htmlElement' => 'text', 'type' => 'text' ],
            [ 'key' => 'terms', 'caption' => 'Terms', 'htmlElement' => 'textarea' ],
            [ 'key' => 'description', 'caption' => 'Description', 'htmlElement' => 'textarea' ],
        ];
    }
}
