@if (session()->has('message'))
<div class="alert alert-info">{{ session('message') }}</div>
@endif
@if (session()->has('status'))
<div class="alert alert-info">{{ session('status') }}</div>
@endif
@if (session()->has('error'))
<div class="alert alert-error">{{ session('error') }}</div>
@endif