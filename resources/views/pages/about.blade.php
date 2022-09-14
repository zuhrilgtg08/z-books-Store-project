@extends('layouts.main', ["title" => "About Us"])
@section('main-content')
<div class="row justify-content-center mt-5">
    <h2 class="text-center font-semibold mt-5">About Owner Store</h2>
    <div class="col-md-8 mt-3">
        <div class="card mt-3" style="max-width: 840px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset('assets/images/owner.jpg') }}" alt="about us"
                        class="img-fluid shadow-lg rounded-start">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Ahmad Zuhril Fahrizal</h5>
                        <p class="card-text">
                            hello, my name is Ahmad Zuhril Fahrizal. I am a business actor in the field of selling books
                            for all students or
                            students. Turnover per month that I get can reach 12 million. Plus, the books here are
                            written by many famous and great
                            writers.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-title bg-dark text-light">
                <h2 class="text-center">Contact for Bussiness</h2>
            </div>
            <div class="card-body">
                <h5>For bussiness can you contact with : </h5>
                <a href="#" class="btn btn-primary">
                    <i class="fab fa-fw fa-twitter"></i>
                    Twitter
                </a>
                <a href="#" class="btn btn-danger">
                    <i class="fab fa-fw fa-instagram"></i>
                    Instagram
                </a>
                <a href="#" class="btn btn-success">
                    <i class="fab fa-fw fa-whatsapp"></i>
                    Whatsapp
                </a>
                <a href="#" class="btn btn-dark">
                    <i class="fab fa-fw fa-linkedin"></i>
                    Linkedin
                </a>
            </div>
        </div>
    </div>
</div>
@endsection