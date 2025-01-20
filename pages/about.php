<?php
include("../hf/pages.php");

?>

<!-- About Page Content Here -->
<section class="about">
    <h4 class="about_title">
        About <span>Us</span>
        <line></line>
    </h4>
    <div class="about_content">
        <div class="left">
            <div class="banner">
                <img src="../admin/assets/about.webp" alt="">
            </div>
        </div>
        <div class="right">
            Forever was born out of a passion for innovation and a desire to revolutionize the way people shop
            online.
            Our journey
            began with a simple idea: to provide a platform where customers can easily discover, explore, and
            purchase a
            wide range
            of products from the comfort of their homes.

            Since our inception, we've worked tirelessly to curate a diverse selection of high-quality products that
            cater to every
            taste and preference. From fashion and beauty to electronics and home essentials, we offer an extensive
            collection
            sourced from trusted brands and suppliers.
            <div class="auto_slogo">
                <h4>Our Mission</h4>
                <div class="paragraph-container">
                    <div class="paragraph active">"Your Journey Starts Here – Hassle-Free Bonafide Solutions!"</div>
                    <div class="paragraph">"Less Paperwork, More Travel – Get Certified Instantly!"</div>
                    <div class="paragraph">"One Click Away from Simplifying Your Commute!"</div>
                    <div class="paragraph">College Life Made Easier – Your Bonafide Certificate Awaits!</div>
                    <div class="paragraph">"Where Convenience Meets Your Travel Needs – Apply Now!"</div>
                    <div class="paragraph">"From Campus to Commute – Get Your Bonafide in No Time!"</div>
                    <div class="paragraph">"Your Ticket to Smooth Travel Begins with Us!"</div>
                    <div class="paragraph">"Say Goodbye to Stress, and Hello to Easy Travel Pass Applications!"
                    </div>
                    <div class="paragraph">"Travel Smarter, Not Harder – Bonafide Certificates Made Simple!"</div>
                    <div class="paragraph">"Empowering Students, One Certificate at a Time!"</div>
                </div>
            </div>
        </div>
    </div>

</section>

<div class="about_why">
    <h4>Why <span>Choose US</span>
        <line></line>
    </h4>
    <div class="why_content">
        <div class="features_box">
            <h4 class="box_title">
                Quality Assurance:
            </h4>
            <p>We meticulously select and vet each product to ensure it meets our stringent quality standards.</p>
        </div>
        <div class="features_box">
            <h4 class="box_title">
                Convenience:
            </h4>
            <p>With our user-friendly interface and hassle-free ordering process, shopping has never been easier.
            </p>
        </div>
        <div class="features_box">
            <h4 class="box_title">
                Exceptional Customer Service:
            </h4>
            <p>Our team of dedicated professionals is here to assist you the way, ensuring your satisfaction is our
                top priority.</p>
        </div>
    </div>
</div>

<!-- Footer Section -->


<!-- Javascript file links Here -->


<!-- Our Missions Script -->
<script>
    const paragraphs = document.querySelectorAll('.paragraph');
    let currentIndex = 0;

    function showNextParagraph() {
        paragraphs[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % paragraphs.length;
        paragraphs[currentIndex].classList.add('active');
    }

    // Change paragraph every 3 seconds
    setInterval(showNextParagraph, 3000);
</script>




<script src="../js/script.js"></script>

<?php

include("../hf/footer.php");

?>