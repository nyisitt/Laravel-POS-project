@extends('user.layout.master')
@section('contant')

<!-- Contact Start -->
<div class="container-fluid">
      <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact Us</span></h2>
      @if (session('message'))
      <div class="mb-3 col-5 offset-7">
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong><i class='bx bx-check-double mr-2  fa-2x'></i>{{session('message')}}</strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
      </div>
      @endif
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="contact-form bg-light p-30">
                <div id="success"></div>
                <form action="{{route('user#dataPush')}}" method="post">
                    @csrf
                    <div class="control-group">
                        <input type="text" class="form-control " name="name" placeholder="Your Name"
                            required="required" data-validation-required-message="Please enter your name" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <input type="email" class="form-control" name="email" placeholder="Your Email"
                            required="required" data-validation-required-message="Please enter your email" />
                        <p class="help-block text-danger"></p>
                    </div>

                    <div class="control-group">
                        <textarea class="form-control" rows="8" name="message" placeholder="Message"
                            required="required"
                            data-validation-required-message="Please enter your message"></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div>
                        <button class="btn btn-primary py-2 px-4 " type="submit" id="sendMessageButton">Send
                            Message</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5 mb-5">
            <div class=" p-30 mb-30">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29819.837465124434!2d94.79604690305128!3d20.893012360337366!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30b60e87b573c265%3A0xc218fcf8cc1d5675!2sChauk!5e0!3m2!1sen!2smm!4v1697721020139!5m2!1sen!2smm" width="500" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"  frameborder="0"  allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

            </div>
            <div class="bg-light p-30 mb-3">
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Oake Pho Street ,Chauk</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>nyisittmarn@gmail.com</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>O9 956197161</p>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection






