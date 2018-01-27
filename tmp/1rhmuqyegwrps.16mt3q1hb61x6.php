<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>

<?php echo $this->render('views/includes/navbar.html',NULL,get_defined_vars(),0); ?>

<!-- CONTENT -->
    <div class="container-fluid h-100 p-5">
        <div class="row h-100 p-5 dating-soft-border">
            <div class="col-6 p-4 px-5 dating-content">
                
                <div class="container-fluid h-100">
                
                <!-- INTRO -->
                    <div class="row mb-3">
                        <h1 class="mx-auto bold text-center">
                            My Dating Website
                        </h1>
                        <p class="mx-auto">
                            Welcome to the web's most successful dating
                            website. At <span class="bold">My Dating Website</span>
                            you'll meet other like-minded individuals. We have
                            the highest success rate of couples on the web. User's 
                            are matched by interest and location. Find out why so 
                            many others have found love on our site!
                        </p>
                    </div>
                <!-- END INTRO -->
                
                <!-- QUOTES -->
                    <div class="row mb-3">
                        <h4 class="mx-auto bold text-center">
                            Hear what our users are saying about us.    
                        </h4>
                        <div class="dating-quotes container-fluid p-2 px-5 pt-3">
                            <blockquote class="mx-auto">
                                "I met the love of my life after only 
                                a month!"
                                <cite>-&nbsp;Andrea</cite>
                            </blockquote>
                            <blockquote class="mx-auto">
                                "It was so easy to set up a profile
                                and start meeting people. I didn't realize 
                                how many others were looking for love in
                                my area."
                                <cite>-&nbsp;John Smith</cite>
                            </blockquote>
                            <blockquote class="mx-auto">
                                "Just try it! You'll never be the same!"
                                <cite>-&nbsp;Sarah</cite>
                            </blockquote>
                        </div>
                    </div>
                <!-- END QUOTES -->

                <!-- BUTTON -->
                    <div class="row">
                        <button class="btn btn-primary mx-auto create-btn">
                            Create a Profile!
                        </button>
                    </div>
                <!-- END BUTTON -->

                </div>
                
            </div>
            <div class="col-6 h-100">
                
                <div id="dating-home-pic" class="rounded"></div>
            
            </div>
        </div>
    </div>
<!-- END CONTENT -->

</body>
</html>
