@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           @if(session('response'))
                <div class="alert alert-success">{{session('response')}}</div> 
                @endif      
          

            <div class="card">
                <div class="card-header">View Post</div>
             <div class="card-body">
                 <div class="col-md-4">
                    
                 <ul class="list-group">
                 	@if(count($categories) > 0)
                 	      @foreach($categories->all() as $category)
                              <li class="list-group-item"><a href='{{ url("category/{$category->id}") }}'>{{$category->category}}</a></li>
                 	      @endforeach

                 	@else
                 	      <p>No Category Found</p>
                 	@endif
                 	
                 </ul>

                 </div>
                 <div class="col-md-8">
                    @if(count($posts) > 0)
                        @foreach($posts->all() as $post)
                           <h4>{{$post->post_title}}</h4>
                           <img src="{{ $post->post_image }}" alt="">
                           <p>{{ $post->post_body }}</p>
                           <ul class="nav nav-pills">
                               <li role="presentation"></li>
                               <a href='{{ url("/like/{$post->id}") }}'>
                                 <i class="fa fa-thumbs-up" aria-hidden="true"> Like({{$likeCtr}}) &nbsp &nbsp</i>
                                 
                               </a></li>
                               <li role="presentation"></li>
                               <a href='{{ url("/dislike/{$post->id}") }}'>
                                <i class="fa fa-thumbs-down" aria-hidden="true">  Dislike({{$dislikeCtr}}) &nbsp &nbsp</i>
                                 
                               </a></li>
                               <li role="presentation"></li>
                               <a href='{{ url("/comment/{$post->id}") }}'>
                                
                                <i class="fa fa-comment" aria-hidden="true"> Comment(</i>
                               </a></li>
                           </ul>
                           
                        @endforeach

                    @else
                    <p>No post available</p>
                    @endif

                    

                     <form method="POST" action='{{ url("/comment/{$post->id}") }}' enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                          <textarea id="comment" rows="6" class="form-control" name="comment" required autofocus></textarea>
                        </div> 
                        <div class="form-group row">
                           
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    {{ __('Post Comment') }}
                                </button>
                            </div>
                    
                      </form>
                      <h3>Comments</h3>
                        @if(count($comments) > 0)
                        @foreach($comments->all() as $comment)
                          <p>{{ $comment->comment }}</p>
                          <p>Posted by: {{ $comment->name }}</p>
                          <hr>

                        @endforeach

                    @else
                    <p>No post available</p>
                    @endif

                  


                 </div>
             </div>  

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

