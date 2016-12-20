<div class="activation">
    <script>
        $('.carousel').carousel();
    </script>

    <div class="infoStatistic">
        <div class="part1">
            <h1><mark>Manage</mark> your page from </br> your place</h1>
            <div class="statisticPart clearElement">
                {{--<div class="statistic elementLeft">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    <div>Study the statistics of visits</div>
                </div>--}}
                <div class="statistic elementLeft">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                    <div>Edit the description and information about the services</div>
                </div>
                <div class="statistic elementLeft">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <div>Respond to user reviews</div>
                </div>
            </div>
            <button class="getButton" data-toggle="modal" data-target="#myModalMaster">get access</button>
        </div>
    </div>
    <div class="sliderAbout">
            <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel" data-slide-to="1"></li>
                    <li data-target="#carousel" data-slide-to="2"></li>
                    <li data-target="#carousel" data-slide-to="3"></li>
                    <li data-target="#carousel" data-slide-to="4"></li>
                </ol>
                <!-- Carousel items -->
                <div class="carousel-inner innerCustom">
                    <div class="active item myCustomItems">
                        </br></br>
                        <div class="deliveryItem">Leading online restaurants</br> catalog</div>
                        <img class="ItemLogo first" src="../images/logoBig.png">
                    </div>
                    <div class="item myCustomItems">
                        </br></br>
                        <div class="deliveryItem">We are the largest restaurant search</br> and advisory service in the US </div>
                        <div class="customText">Our users choose restaurants and bars where they </br>want to spend their money</div>
                        <img class="ItemLogo" src="../images/find.png">
                        {{--<div class="customTextSmall">Lorem ipsum dolor sit amet, consectetur </br>adipisicing elit. Omnis, quam?</div>--}}
                    </div>
                    <div class="item myCustomItems">
                        </br></br></br>
                        <div class="deliveryItem noBold">In search for restaurants</br><span class="bold"> 400.000</span></br> people daily visit <span class="markText">RestAdviser</span></div>
                        </br>
                        <div class="deliveryItem noBold">And they make <span class="bold">35.000</span> calls</div>
                        </br>

                    </div>
                    <div class="item myCustomItems">
                        </br></br>
                        <div class="deliveryItem">Your page on RestAdviser</div>
                        </br></br>
                        <div class="clearElement contentWithImage">
                            <div class="customTextSmall elementLeft textLeft">Your page is already on</br> <span class="markText">RestAdviser</span></br> and it is already working!
                                </br></br>Your customers already</br> visit your page
                            </div>
                            <img class="" src="../images/yourPage.png">
                        </div>
                    </div>
                    <div class="item myCustomItems">
                        </br></br>
                        <img class="ItemLogo" src="../images/graf.png">
                        </br></br>
                        <div class="deliveryItem noBold">We can increase the number of your</br> customers significantly</div>
                    </div>
                    <div class="item myCustomItems">
                        </br></br>
                        </br></br>
                        </br></br>
                        <div class="deliveryItem noBold">We are already working with</br> more than <span class="bold">10.000 </span>restaurants</div>
                    </div>
                    <div class="item myCustomItems">
                        </br></br>
                        </br></br>
                        <div class="deliveryItem noBold">
                            Become our partner</br>
                            Contact us by phone</br>
                            <span class="markText">+7 (495) 660-39-16</span></br>
                            Or using the feedback form
                        </div>
                    </div>
                </div>
                <!-- Carousel nav -->
                <a class="carousel-control left customLeft carouselControlCustom" href=".carousel" data-slide="prev" style="background: transparent">&lsaquo;</a>
                <a class="carousel-control right carouselControlCustom" href=".carousel" data-slide="next" style="background: transparent">&rsaquo;</a>
            </div>
    </div>
    <div class="videoAbout">
        <div class="videoM">
            <div class="videoPart">
                <video width="100%" height="100%" controls>
                    <source src="http://techslides.com/demos/sample-videos/small.mp4" type="video/mp4">
                    <source src="movie.ogg" type="video/ogg">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>

    </div>
    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="footerText" data-toggle="modal" data-target="#myModalLocation">add location
                    </div>
                    <div class="footerText" data-toggle="modal" data-target="#myModalMaster">register owner</div>
                    <div class="footerText"><a href="#forOrganization">For Restaurant</a></div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="footerText"><a href="#contacts">contacts</a></div>
                    <div class="footerText"><a href="#aboutProject">about project</a></div>
                    <div class="footerText" data-toggle="modal" data-target="#myModalLet">Noticed a Mistake - let us</div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 floating">
                    <img src="../images/logo.png">
                    <div class="footerExplane">
                        RestAdviser.com</br> All rights reserved.
                    </div>
                    <div class="footerSocial">
                        <a socialshare
                           socialshare-provider="facebook"
                           socialshare-type="share"
                           socialshare-text="Restadviser"
                           socialshare-title="Restadviser"
                           socialshare-media="http://restadviser.com/images/coverImages/cover1.png"
                           socialshare-url="<% lnk %>"
                           socialshare-via="129554920871527">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                        <a
                                socialshare
                                socialshare-provider="twitter"
                                socialshare-text="Restadviser"
                                {{--socialshare-hashtags="angularjs, angular-socialshare"--}}
                                socialshare-url="<%lnk%>">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                        </a>
                        <a
                                socialshare
                                socialshare-provider="linkedin"
                                socialshare-text="Restadviser"
                                {{--socialshare-hashtags="angularjs, angular-socialshare"--}}
                                socialshare-url="<%lnk%>">
                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                        </a>
                        <a
                                socialshare
                                socialshare-provider="google"
                                socialshare-text="Restadviser"
                                {{--socialshare-hashtags="angularjs, angular-socialshare"--}}
                                socialshare-url="<%lnk%>">
                            <i class="fa fa-google-plus" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>





<!--get access popup-->
<div class="modal fade" id="myModalGetAccess" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header popupHeader">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title capitalize">get access</h4>
            </div>
            <div class="modal-body accessPopup">
                <div class="buttonInputGroup">
                    <input type="text" placeholder="Type the name of your restaurant ...">
                    <button class="findButton">Find</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!---->