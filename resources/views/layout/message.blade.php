@if(session()->has('message'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>
        {{  session()->get('message') }}
    </strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif  
