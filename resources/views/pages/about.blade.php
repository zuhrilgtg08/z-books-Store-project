@extends('layouts.main', ["title" => "About"])
@section('main-content')

<div class="row justify-content-center mt-5">
    <h2 class="text-center font-semibold mt-5">About Store</h2>
    <div class="col-md-10 mt-3">
        <div class="mt-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-8 m-auto p-auto">
                    <p>
                        Z-Book's was founded in 1985 to provide high-quality imported books and magazines to readers in Indonesia. Through the
                        years, our network has grown and we now have over 45 retail outlets in strategic shopping areas around Indonesia
                        including airports and malls. Enables you to select from over 21 million international books and magazines with fast, guaranteed delivery and low
                        prices.
                    </p>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('assets/images/about-us.jpg') }}" alt="about owner"
                        class="img-fluid shadow-lg rounded" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-10 mt-3">
        <div class="mt-4">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-4">
                    <img src="{{ asset('assets/images/owner.jpg') }}" alt="about owner"
                        class="img-fluid shadow-lg rounded" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="col-md-8 m-auto p-auto">
                    <div class="card-body">
                        <h5 class="font-semibold card-title mb-3">Ahmad Zuhril Fahrizal (Owner Store)</h5>
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

        <div class="mt-5 text-center">
            <div class="card-body">
                <h5 class="mb-3">For bussiness can you contact with : </h5>
                <a href="https://www.facebook.com/ahmad.z.fahrizal.35/" class="btn btn-primary" target="blank">
                    <i class="fab fa-fw fa-facebook"></i>
                    Facebook
                </a>
                <a href="https://www.instagram.com/zuhrillfilm/" class="btn btn-danger" target="blank">
                    <i class="fab fa-fw fa-instagram"></i>
                    Instagram
                </a>
                <a href="https://wa.me/085843960995" class="btn btn-success" target="blank">
                    <i class="fab fa-fw fa-whatsapp"></i>
                    Whatsapp
                </a>
                <a href="https://www.linkedin.com/in/zuhril-fahrizal-b6a627245/" class="btn btn-dark" target="blank">
                    <i class="fab fa-fw fa-linkedin"></i>
                    Linkedin
                </a>
            </div>
        </div>
    </div>
</div>
@endsection