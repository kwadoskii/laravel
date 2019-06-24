@if(count($errors)> 0)
    <div class="row">
        <div class="col-md-4 offset-md-4 error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if(Session::has('message'))
{{--    <div class="col-md-4 offset-md-4 success">--}}
{{--        {{Session::get('message') }}--}}
{{--    </div>--}}
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000" data-amimate="true" style="position: fixed; top:30px; right: calc((100%/2) - 150px); z-index: 1050; width: 300px">
    <div class="toast-header">
        <img src="favicon.png" class="rounded mr-2" alt="...">
        <strong class="mr-auto">Notification</strong>
        <!--<small>11 mins ago</small> -->
{{--        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">--}}
{{--            <span aria-hidden="true">&times;</span>--}}
{{--        </button>--}}
    </div>
    <div class="toast-body">
        {{ Session::get('message') }}
    </div>
</div>

{{--{{ Session::forget('message') }}--}}
@endif


{{--<div class="deltoast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000" data-amimate="true" style="position: fixed; top:30px; right: calc((100%/2) - 150px); z-index: 1050; width: 300px">--}}
{{--    <div class="toast-header">--}}
{{--        <img src="favicon.png" class="rounded mr-2" alt="...">--}}
{{--        <strong class="mr-auto">Notification</strong>--}}
{{--    </div>--}}
{{--    <div class="toast-body">--}}
{{--        <p class="notifp"></p>--}}
{{--    </div>--}}
{{--</div>--}}