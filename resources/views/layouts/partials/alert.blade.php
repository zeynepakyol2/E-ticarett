@if( session()->has('mesaj'))
    <div class="alert alert-{{ session('mesaj-tur') }}" style="width: 1142px; margin: 0 auto;">{{ session('mesaj') }}</div>
@endif
