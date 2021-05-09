<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class Dashboard extends Component
{
    use withPagination;

    public $search = '';
    public $sortField = 'title';
    public $sortDirection = 'asc';
    public $showEditModal = false;
    public $showFilters = false;
    public $filters = [
        'search' => '',
        'status' => '',
        'amount-min' => null,
        'amount-max' => null,
        'date-min' => null,
        'date-max' => null,
    ];
    public Transaction $editing;

    // This will persist the query on the url if you want to use it later
    protected $queryString = ['sortField', 'sortDirection'];


    public function rules()
    {
        return [
            'editing.title' => 'required|min:3',
            'editing.amount' => 'required',
            'editing.status' => 'required|in:' . collect(Transaction::STATUSES)->keys()->implode(','),
            'editing.date_for_editing' => 'required',
        ];
    }

    public function makeBlankTransaction()
    {
        return Transaction::make(['status' => 'processing', 'date' => now()]);
    }

    public function mount()
    {
        $this->editing = $this->makeBlankTransaction();
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function create()
    {
        if ($this->editing->getkey()) $this->editing = $this->makeBlankTransaction();
        $this->showEditModal = true;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function edit(Transaction $transaction)
    {
        if ($this->editing->isNot($transaction)) $this->editing = $transaction;
        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->showEditModal = false;
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }
    public function render()
    {
        return view('livewire.dashboard', [
            'transactions' => Transaction::query()
                ->when(
                    $this->filters['status'],
                    fn ($query, $status) =>
                    $query->where('status', $status)
                )
                ->when(
                    $this->filters['amount-min'],
                    fn ($query, $amount) =>
                    $query->where('amount', '>=', $amount)
                )
                ->when(
                    $this->filters['amount-max'],
                    fn ($query, $amount) =>
                    $query->where('amount', '<=', $amount)
                )
                ->when(
                    $this->filters['date-min'],
                    fn ($query, $date) =>
                    $query->where('date', '>=', Carbon::parse($date))
                )
                ->when(
                    $this->filters['date-max'],
                    fn ($query, $date) =>
                    $query->where('date', '<=', Carbon::parse($date))
                )
                ->when(
                    $this->filters['search'],
                    fn ($query, $search) =>
                    $query->where('title', 'like', '%' . $search . '%')
                )
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10),
        ]);
    }
}
