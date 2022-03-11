<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class Post extends Component
{
	use WithPagination;
	public $search;
	public $perPage;
	public $sortColumnName;
	public $sortDirection;
	
	public function mount()
	{
		$this->search = '';
		$this->perPage = 10;
		$this->sortColumnName = '';
		$this->sortDirection = 'desc';
	}
	
	public function sortBy($columnName)
	{
		if($this->sortColumnName === $columnName)
		{
			$this->sortDirection = $this->swapSortDirection();
		}
		else
		{
			$this->sortDirection = 'asc';
		}
		
		$this->sortColumnName = $columnName;
	}
	
	public function swapSortDirection()
	{
		return $this->sortDirection === 'asc' ? 'desc' : 'asc';
	}
	
    public function render()
    {
		return view('livewire.post', [
		'cities' => \App\Models\City::search($this->search)
			->orderBy($this->sortColumnName, $this->sortDirection)
			->simplePaginate($this->perPage)
		]);
    }
}
