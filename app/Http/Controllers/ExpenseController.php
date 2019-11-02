<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreExpense;
use App\Http\Requests\UpdateExpense;
use App\Traits\DbTrait;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    use DbTrait;

    protected $searchable = ['project_id','item','amount'];

    public function index()
    {
        return view('expense.index');
    }

    public function list(Request $request)
    {
        return $this->getPaginated($request, 'Expense', $this->searchable);
    }

    public function create()
    {
        return view('expense.create')->with(['fields' => $this->getFields()]);
    }

    public function store(StoreExpense $request)
    {
        $this->dbStore($request, 'Expense');
        return redirect()->route('expenses.index');
    }

    public function show($id)
    {
        $data = $this->dbGetById($id, 'Expense');
        return view('expense.show')->with([
            'data' => $data,
            'fields' => $this->getFields()
        ]);
    }

    public function update(UpdateExpense $request, $id)
    {
        $this->dbUpdate($request, $id, 'Expense');
        return redirect()->route('expenses.index');
    }

    public function destroy($id)
    {
        $this->dbDelete($id, 'Expense');
        return ['message' => 'Expense deleted'];
    }

    protected function getFields()
    {
        $projects = $this->getComboData('Project', [], 'combo_created_at_desc', 'code', 'created_at', 'desc');
        $projectArray = [];
        foreach ($projects as $p) {
            array_push($projectArray, [
                'id' => $p->id,
                'name' => $p->code
            ]);
        }

        return [
            [ 'key' => 'project_id', 'caption' => 'Project', 'htmlElement' => 'select', 'selectValue' => $projectArray ],
            [ 'key' => 'item', 'caption' => 'Item', 'htmlElement' => 'text', 'type' => 'text' ],
            [ 'key' => 'amount', 'caption' => 'Amount', 'htmlElement' => 'text', 'type' => 'text' ],
            [ 'key' => 'description', 'caption' => 'Description', 'htmlElement' => 'text', 'type' => 'text' ],

        ];
    }
}
