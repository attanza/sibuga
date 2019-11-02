<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreProject;
use App\Http\Requests\UpdateProject;
use App\Traits\DbTrait;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use DbTrait;

    protected $searchable = ['quotation_id','code','title','status', 'amount'];

    public function index()
    {
        return view('project.index');
    }

    public function list(Request $request)
    {
        return $this->getPaginated($request, 'Project', $this->searchable, ['company']);
    }

    public function create()
    {
        return view('project.create')->with(['fields' => $this->getFields()]);
    }

    public function store(StoreProject $request)
    {
        $this->dbStore($request, 'Project');
        return redirect()->route('projects.index');
    }

    public function show($id)
    {
        $data = $this->dbGetById($id, 'Project');
        $data->loadMissing('quotation.products.product');
        return view('project.show')->with([
            'data' => $data,
            'fields' => $this->getFields()
        ]);
    }

    public function update(UpdateProject $request, $id)
    {
        $this->dbUpdate($request, $id, 'Project');
        return redirect()->route('projects.index');
    }

    public function destroy($id)
    {
        $this->dbDelete($id, 'Project');
        return ['message' => 'Project deleted'];
    }

    protected function getFields()
    {
        $quotations = $this->getComboData('Quotation', [], 'combo_created_at_desc', 'no', 'created_at', 'desc');
        $quotationArray = [];
        foreach ($quotations as $q) {
            array_push($quotationArray, [
                'id' => $q->id,
                'name' => $q->no
            ]);
        }
        $statuses = ['new', 'purchasing', 'delivery', 'completed', 'cancel'];
        $status = [];
        foreach ($statuses as $s) {
            array_push($status, [
                'id' => $s,
                'name' => $s
            ]);
        }

        return [
            [ 'key' => 'quotation_id', 'caption' => 'Quotation', 'htmlElement' => 'select', 'selectValue' => $quotationArray],
            [ 'key' => 'code', 'caption' => 'Code', 'htmlElement' => 'text', 'type' => 'text' ],
            [ 'key' => 'title', 'caption' => 'Title', 'htmlElement' => 'text', 'type' => 'text' ],
            [ 'key' => 'start_date', 'caption' => 'Start Date', 'htmlElement' => 'text' , 'type' => 'text' ],
            [ 'key' => 'end_date', 'caption' => 'End Date', 'htmlElement' => 'text', 'type' => 'text' ],
            [ 'key' => 'status', 'caption' => 'Status', 'htmlElement' => 'select', 'selectValue' => $status],
            [ 'key' => 'amount', 'caption' => 'Amount', 'htmlElement' => 'text', 'type' => 'number' ],
            [ 'key' => 'terms', 'caption' => 'Terms', 'htmlElement' => 'textarea'],
            [ 'key' => 'description', 'caption' => 'Description', 'htmlElement' => 'textarea' ],

        ];
    }
}
