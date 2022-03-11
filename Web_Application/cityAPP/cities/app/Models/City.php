<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'county',
        'population_2000',
        'population_2010',
        'population_2020'
    ];
	
	public static function search($search)
	{
		return empty($search) ? static::query()
		: static::query()->where('name', 'like', '%'.$search.'%')
			->orWhere('county', 'like', '%'.$search.'%');
	}
}