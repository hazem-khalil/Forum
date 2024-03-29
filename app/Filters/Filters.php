<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
	protected $request;
	protected $builder;
	protected $filters = [];

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
}