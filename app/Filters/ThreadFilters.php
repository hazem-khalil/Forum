<?php

namespace App\Filters;

use App\Models\User;
use Illuminate\Http\Request;

class ThreadFilters
{
	protected $builder;
	protected $request;
	protected $filters = ['by'];

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function apply($builder)
	{
		$this->builder = $builder;

		foreach ($this->request->only($this->filters) as $filter => $value) {
			if ($this->request->$filter && method_exists($this, $filter)) {
				$this->$filter($value);
			}
		}
	}

	protected function by($username)
	{
        $user = User::where('name', $username)->firstOrFail();
        return $this->builder->where('user_id', $user->id);
	}
}