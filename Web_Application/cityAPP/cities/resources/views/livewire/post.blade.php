@section('tabtitle')
    City Pop App
@endsection

@section('title')
    City Population Data
@endsection

<div>
<center>
	<h3>Cities in Database</h3>
	<div>
		<div  style="width:30%;">'
			<input class="form-input" wire:model='search' type="text" placeholder="Search... (City or County)">
		</div>
		<div class="form-group" style="width:30%;">
			<Strong class="form-label" align="left">Entries Per Page:</Strong>
			<select class="form-select" wire:model="perPage">
				<option>10</option>
				<option>15</option>
				<option>25</option>
				<option>50</option>
				<option>100</option>
				<option>150</option>
			</select>
		</div>
	</div>
	<br>
	{!! $cities->links() !!}
	<br>
	<table style="width:700px;" class="table table-striped">
        <tr style="background-color: rgb(0, 73, 6); color:rgb(229,229,229);">
            <th colspan="2" align="center">
                <img width=50 src="{{ URL::to('/assets/washingtonstate-1638402624944-3230.jpg') }}">
                &nbsp; &nbsp;
                Washington State
            </th>
            <th colspan="3" align="center">Populations</th>
        </tr>
        <tr>
            <th>
				City
				<span wire:click="sortBy('name')" class="float-right" style="cursor: pointer">
					<i class="icon icon-resize-vert"></i>
				</span>
			</th>
            <th>
				County
				<span wire:click="sortBy('county')" class="float-right" style="cursor: pointer">
					<i class="icon icon-resize-vert"></i>
				</span>
			</th>
            <th align="center">
				2000
				<span wire:click="sortBy('population_2000')" class="float-right" style="cursor: pointer">
					<i class="icon icon-resize-vert"></i>
				</span>
			</th>
            <th align="center">
				2010
				<span wire:click="sortBy('population_2010')" class="float-right" style="cursor: pointer">
					<i class="icon icon-resize-vert"></i>
				</span>
			</th>
            <th align="center">
				2020
				<span wire:click="sortBy('population_2020')" class="float-right" style="cursor: pointer">
					<i class="icon icon-resize-vert"></i>
				</span>
			</th>
        </tr>
        @foreach ($cities as $city)
            <tr>
                <td>{{ $city->name }}</td>
                <td>{{ $city->county }}</td>
                <td align="right">{{ $city->population_2000 }}</td>
                <td align="right">{{ $city->population_2010 }}</td>
                <td align="right">{{ $city->population_2020 }}</td>
            </tr>
        @endforeach
    </table>
	<br>
	{!! $cities->links()!!}
</center>
</div>

