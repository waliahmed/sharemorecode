@extends( 'layouts/master' )

@section( 'content' )
    <div class="container">
        <h2>Finally Some Live reload!!</h2>
        <div data-bb-template="Snippet"></div>
    </div>
@stop

@section( 'scripts' )
    <script src="scripts/js/modules/snippet.js"></script>
@stop
