@extends('_layouts.default')

@section('content')
	<div class="page-container">
        <section>
			@include('_partials.search_section')

			@include('_partials.movie_spec')
		</section>
		
		<section>
			@include('_partials.recent')
		</section>
			
	</div>	

@stop