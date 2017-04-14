@extends('layouts.app')

@section('content')
@section('css')
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
  background:#fff;
  border-raduis:5px;
}
.container-m {
  padding: 0 16px;
}
.container-m::after {
  content: "";
  clear: both;
  display: table;
}
.card  .title {
  color: grey;
  
}
.card  button {
  margin-top:15px;
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

.card  a {
  text-decoration: none;
 
  color: black;
}

.card button:hover, a:hover {
  opacity: 0.7;
}
@endsection
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <img src="{{asset('uploads/users/img.jpg')}}" alt="John" style="width:100%">
                <div class="container-m">
                    <h3>{{Auth::user()->name}}</h3>
                    <p class="title">CEO & Founder, Example</p>
                    <p>Harvard University</p>
                    <a href="#"><i class="fa fa-dribbble"></i></a> 
                    <a href="#"><i class="fa fa-twitter"></i></a> 
                    <a href="#"><i class="fa fa-linkedin"></i></a> 
                    <a href="#"><i class="fa fa-facebook"></i></a> 
                    <p><button>Contact</button></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
