<h5 class="text-success border border-success rounded px-2 py-1 d-inline-block mb-0">

    <div class="d-flex align-items-center justify-content-center gap-2">
	    <span>Balance: ₹{{ session('balance', 100) }}</span>
	    @if(session('balance') < 10 )
			<form method="POST" action="{{ route('games.reset-balance') }}">
			    @csrf
			    <button type="submit" class="btn btn-info btn-sm" title="Reset Balance to 100">
			        @include('partials.svg.reset', [
				        'width' => 20,
				        'height' => 20,
				        'color' => '#000000'
				    ])
			    </button>
			</form>
	    @endif
	</div>
</h5>
