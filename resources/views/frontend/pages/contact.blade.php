@extends('layouts.frontend.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle: 'Admin Management')

@section('content')

        <!-- page-title -->
        <div class="tf-page-title">
            <div class="container-full">
                <div class="heading text-center">Contact Us</div>
            </div>
        </div>
        <!-- /page-title -->

        <!-- map -->
        <section class="flat-spacing-9">
            <div class="container">
                <div class="tf-grid-layout gap-0 lg-col-2">
                    <div class="w-100">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d317859.6089702069!2d-0.075949!3d51.508112!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48760349331f38dd%3A0xa8bf49dde1d56467!2sTower%20of%20London!5e0!3m2!1sen!2sus!4v1719221598456!5m2!1sen!2sus"
                            width="100%" height="894" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="tf-content-left has-mt">
                        <div class="sticky-top">
                            <h5 class="mb_20">Visit Our Store</h5>
                            <div class="mb_20">
                                <p class="mb_15"><strong>Address</strong></p>
                                <p>66 Mott St, New York, New York, Zip Code: 10006, AS</p>
                            </div>
                            <div class="mb_20">
                                <p class="mb_15"><strong>Phone</strong></p>
                                <p>(623) 934-2400</p>
                            </div>
                            <div class="mb_20">
                                <p class="mb_15"><strong>Email</strong></p>
                                <p>EComposer@example.com</p>
                            </div>
                            <div class="mb_36">
                                <p class="mb_15"><strong>Open Time</strong></p>
                                <p class="mb_15">Our store has re-opened for shopping, </p>
                                <p>exchange Every day 11am to 7pm</p>
                            </div>
                            <div>
                                <ul class="tf-social-icon d-flex gap-20 style-default">
                                    <li><a href="#" class="box-icon link round social-facebook border-line-black"><i
                                                class="icon fs-14 icon-fb"></i></a></li>
                                    <li><a href="#" class="box-icon link round social-twiter border-line-black"><i
                                                class="icon fs-12 icon-Icon-x"></i></a></li>
                                    <li><a href="#" class="box-icon link round social-instagram border-line-black"><i
                                                class="icon fs-14 icon-instagram"></i></a></li>
                                    <li><a href="#" class="box-icon link round social-tiktok border-line-black"><i
                                                class="icon fs-14 icon-tiktok"></i></a></li>
                                    <li><a href="#" class="box-icon link round social-pinterest border-line-black"><i
                                                class="icon fs-14 icon-pinterest-1"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /map -->
        <!-- form -->
        <section class="bg_grey-7 flat-spacing-9">
            <div class="container">
                <div class="flat-title">
                    <span class="title">Get in Touch</span>
                    <p class="sub-title text_black-2">If you’ve got great products your making or looking to work with
                        us then drop us a line.</p>
                </div>
                <div>
                    <form class="mw-705 mx-auto text-center form-contact" id="contactform"
                        action="./contact/contact-process.php" method="post">
                        <div class="d-flex gap-15 mb_15">
                            <fieldset class="w-100">
                                <input type="text" name="name" id="name" required placeholder="Name *" />
                            </fieldset>
                            <fieldset class="w-100">
                                <input type="email" name="email" id="email" required placeholder="Email *" />
                            </fieldset>
                        </div>
                        <div class="mb_15">
                            <textarea placeholder="Message" name="message" id="message" required cols="30"
                                rows="10"></textarea>
                        </div>
                        <div class="send-wrap">
                            <button type="submit"
                                class="tf-btn radius-3 btn-fill animate-hover-btn justify-content-center">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- /form -->
         

@endsection


@section('scripts')

@endsection