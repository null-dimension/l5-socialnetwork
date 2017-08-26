@extends('layouts.master')

@section('content')
	@include('includes.message-block')
	<section class="row new-post">
		<div class="col-md-6 col-md-offset-3">
			<header><h3>What do you have to say?</h3></header>
			<form action="{{ route('post.create') }}" method="post">
				{{ csrf_field() }}
				<div class="form-group">
					<textarea class="form-control" name="new-post" id="new-post" rows="5" placeholder="Say something..."></textarea>
				</div>
				<button class="btn btn-primary" type="submit">Create Post</button>
			</form>
		</div>
	</section>

	<section class="row posts">
		<div class="col-md-6 col-md-offset-3">
			<header><h3>What other people say...</h3></header>
			@foreach($posts as $post)
				<article class="post" data-postid="{{ $post->id }}">
					<p class="post-body-text"> {{ $post->body }} </p>
					<div class="info">
						Posted By {{ $post->user->username }} on {{ $post->created_at->format('d-m-Y H:i:s') }}
					</div>
					<div class="rating">
						<div class="likes-count" style="display:inline;">
							{{ Auth::user()->likes()->where('post_id', '=', $post->id)->where('like', '=', 1)->count() }}  <span class="glyphicon glyphicon-thumbs-up"></span>
						</div> | 
						<div class="dislikes-count" style="display:inline">
							{{ Auth::user()->likes()->where('post_id', '=', $post->id)->where('like', '=', 0)->count() }}  <span class="glyphicon glyphicon-thumbs-down"></span>
						</div>
					</div>
					<div class="interaction">
						<a href="#" class="like">
							{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like' }}
						</a> |
						<a href="#" class="like">
							{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You dislike this post' : 'Dislike' : 'Dislike' }}
						</a>
						@if(Auth::user() == $post->user)
							 |
							<a href="#" class="edit">Edit</a> |
							<a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>
						@endif
					</div>
				</article>
			@endforeach
		</div>
	</section>

	<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <h4 class="modal-title">Edit Post</h4>
			  </div>
			  <div class="modal-body">
			    <form>
			    	<label for="post-body">Edit the post</label>
			    	<textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
			    </form>
			  </div>
			  <div class="modal-footer">
			    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			    <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
			  </div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<script>
		var token = '{{ csrf_token() }}';
		var url = '{{ route('edit') }}';
		var urlLike = '{{ route('like') }}';
	</script>
@endsection