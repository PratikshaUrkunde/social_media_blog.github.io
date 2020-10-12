@extends('layouts.app')
<style type="text/css">
    .default2{
        border-radius: 100%;
        max-width: 100px;
    }
</style>

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
             @if(count($errors) > 0)
                     @foreach($errors->all() as $error)
                          <div class="alert alert-danger">{{$error}}
                          </div>
                     @endforeach
             @endif

             @if(session('response'))
                     <div class="alert alert-success">{{session('response')}}
                     </div> 
             @endif     
            <div class="card">
                <div class="card-header">
                  <div class="row">
                   <div class="col-md-4">Dashboard</div>
                   <div class="col-md-8">

                  <form method="POST" action='{{ url("/search") }}' enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">

                          <input type="text" name="search" class="form-control form-control-sm ml-7 w-75" placeholder="Search for...">
                          
                            <button type="submit" class="btn btn-primary btn-sm">Go!</button>
                         </div><!--form-group row!-->
                  </form>
                </div><!--card header!-->
             </div><!--row!-->
           </div><!--extra!-->
             <div class="card-body">
                 <div class="col-md-4">
                   @if(!empty($profile))
                     <img src="{{ $profile->profile_pic }}">
                     
                     <hr size="20"> 
                     @else
                        <img src="{{ url('images/default2.png')}}" class="default2" alt="">

                   @endif

                    @if(!empty($profile))
                    <p class="lead"><b>{{ $profile->name }}</b></p>
                     
                    @else
                    <p></p>

                    @endif

                    @if(!empty($profile))
                     <p class="lead"><b>{{ $profile->designation }}</b></p>
                    <hr size="20"> 
                    @else
                    <p></p>
                    @endif
                   


                 </div><!--col-md-4!-->

                 <div class="col-md-8">
                    @if(count($posts) > 0)
                        @foreach($posts->all() as $post)
                           <h4>{{$post->post_title}}</h4>
                           <img src="{{ $post->post_image }}" alt="">
                           <p>{{ substr($post->post_body, 0, 100) }}</p>
                           <ul class="nav nav-pills">
                               <li role="presentation"></li>
                               <a href='{{ url("/view/{$post->id}") }}'>
                                 <i class="fa fa-eye" aria-hidden="true"> View &nbsp &nbsp</i>
                                 
                               </a></li>
                               


                               @if(Auth::id() == 20) 
                               <li role="presentation"></li>
                               <a href='{{ url("/edit/{$post->id}") }}'>
                                <i class="fa fa-pencil-square-o" aria-hidden="true">  Edit &nbsp &nbsp</i>
                                 
                               </a>
                               <li role="presentation"></li>
                               <a href='{{ url("/delete/{$post->id}") }}'>
                                
                                 <i class="fa fa-trash-o" aria-hidden="true"> Delete</i>
                               </a>
                               @endif



                           </ul>
                           <cite style="float:left;">Posted on:{{date('M j,Y H:i',strtotime($post->updated_at))}}</cite>
                           <hr/>
                        @endforeach

                    @else
                    <p>No post available</p>
                    @endif
                    
                   
                     
                 </div><!--col-md-8!-->
                
             
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div><!--alert alert!-->
                    @endif

                  {{$posts->links()}}
                </div><!--card body!-->
            </div><!--card!-->
        </div><!--col-md-8!-->
    </div><!--row justify!-->
</div><!--container!-->
@endsection
