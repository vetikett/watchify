@extends('_layouts.default')

@section('content')
        <section>
			@include('_partials.search_section')

			@include('_partials.movie_spec')
		</section>
		
		<section>
			@include('_partials.recent')
		</section>
			

@stop