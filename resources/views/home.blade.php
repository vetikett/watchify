@extends('_layouts.default')

@section('content')
    <div class="row text-center">
        <section class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-center">
			@include('_partials.search_section')

		</section>
		
		<section class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-center">
			@include('_partials.recent')
		</section>
    </div>

@stop