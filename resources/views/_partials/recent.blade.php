<div class="recent-section">
	<h2>Recent</h2>
	
	<ul class="recent-activities">
		@foreach($user->movies->slice(0, 5) as $u)
			<li>{{$u->title}}</li>
		@endforeach
	</ul>	
</div>