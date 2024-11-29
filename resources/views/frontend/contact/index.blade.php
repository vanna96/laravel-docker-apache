@extends('frontend.layouts.master')

@section('title', 'Contact Us')
@section('meta_description', 'Contact Us')

@section('content')
@include('frontend.layouts.breadcrumb', ['title' => 'Contact Us'])
<div class="contact_map mt-70">
    <div class="map-area">
        <div id="googleMap"></div>
    </div>
</div>
<div class="contact_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact_message content">
                    <h3>contact us</h3>
                        <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram anteposuerit litterarum formas human. qui sequitur mutationem consuetudium lectorum. Mirum est notare quam</p>
                    <ul>
                        <li><i class="fa fa-fax"></i>  Address : No 40 Baria Sreet 133/2 NewYork City</li>
                        <li><i class="fa fa-phone"></i> <a href="#">Infor@roadthemes.com</a></li>
                        <li><i class="fa fa-envelope-o"></i><a href="tel:0(1234)567890">0(1234) 567 890</a>  </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="contact_message form">
                    <h3>Tell us your project</h3>
                    <form id="contact-form" method="POST"  action="https://htmldemo.net/safira/safira/assets/mail.php">
                        <p>
                            <label> Your Name (required)</label>
                            <input name="name" placeholder="Name *" type="text">
                        </p>
                        <p>
                            <label>  Your Email (required)</label>
                            <input name="email" placeholder="Email *" type="email">
                        </p>
                        <p>
                            <label>  Subject</label>
                            <input name="subject" placeholder="Subject *" type="text">
                        </p>
                        <div class="contact_textarea">
                            <label>  Your Message</label>
                            <textarea placeholder="Message *" name="message"  class="form-control2" ></textarea>
                        </div>
                        <button type="submit"> Send</button>
                        <p class="form-messege"></p>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
