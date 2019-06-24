@extends('layouts.master')

@section('title')
    Dashboard!
@endsection

@section('logout')
    @include('includes.logout-block')
@endsection

@section('content')
    {{--    <h3>Dashboard</h3>--}}
    @include('includes.message-block')
    {{--    <p>{{ $test('000') }}</p>--}}
    <section class="row new-post">
        <div class="col-sm-3 pl-5" style="
    position: fixed; ">
            <img src="http://3.bp.blogspot.com/-XDZlbxUT6wk/UAfxAeG9YAI/AAAAAAAAA3o/Woqx5XuAFTc/s1600/Dark-Knight_Rises_Dan-Cohen_14.jpg"
                 width='100%' height="560px" alt='Advert 1'>
        </div>

        <div class="col-md-6 offset-md-3">
            <header><h5>What do you have in mind</h5></header>
            <form action="{{ route('post.create') }}" method="post">
                <div class="form-group">
                    <textarea class="form-control" name="body" id="new-post" cols="30" rows="6"
                              placeholder="Say something..."></textarea>
                </div>
                <button type="submit" class="btn btn-success">Create Post</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
    </section>

    <section class="row posts">
        <div class="col-md-6 offset-md-3">
            <header><h4>Others Said..</h4></header>
            @foreach($posts as $post)
                <article class="post" data-postid="{{ $post->id }}">
                    <p>{{$post->body}}</p>
                    <div class="info">
                        Posted by {{ $post->user->first_name }} on {{ $post->created_at }}.
                    </div>
                    <div class="interaction">
                        <a href="#" class="like">Like</a> |
                        <a href="#" class="like">Dislike</a>
                        @if(Auth::user() == $post->user)
                            |
                            <a href="" class="edit">Edit</a> |
                            {{--                            <a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>--}}
                            <a href="" class="delete">Delete</a>
                        @endif
                    </div>
                </article>
            @endforeach
            <nav class="pt-5">
                {{ $posts->links() }}
            </nav>

        </div>
    </section>

    {{--    edit modal--}}
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <textarea class="form-control" name="edit-body" id="edit-body" cols="30" rows="5"
                                  value=""></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="modal-save">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    {{--    delete modal--}}
    <div class="modal fade" tabindex="-1" role="dialog" id="delete-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Sure to delete post?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="modal-delete">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var token = '{{ Session::token() }}';
        var urlEdit = '{{ route('editpost') }}';
        var urlLike = '{{ route('likepost') }}';
        var urlNotif = '{{ route('notif') }}';
        $('.toast').toast('show');
        {{--var urlDelete = '{{ route('post.delete', ['post_id' => $post->id]) }}';--}}
    </script>
@endsection