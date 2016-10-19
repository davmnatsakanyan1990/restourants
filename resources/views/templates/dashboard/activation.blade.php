<div class="activation">
    <script>
        $('.carousel').carousel();
    </script>

    <div class="infoStatistic">
        <div class="part1">
            <h1><mark>Manage</mark> your page from </br> your place</h1>
            <div class="statisticPart clearElement">
                <div class="statistic elementLeft">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    <div>Study the statistics of visits</div>
                </div>
                <div class="statistic elementLeft">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                    <div>Edit the description and information about the services</div>
                </div>
                <div class="statistic elementLeft">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <div>Respond to user reviews</div>
                </div>
            </div>
            <button class="getButton" data-toggle="modal" data-target="#myModalGetAccess">get access</button>
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
                    <li data-target="#carousel" data-slide-to="5"></li>
                </ol>
                <!-- Carousel items -->
                <div class="carousel-inner innerCustom">
                    <div class="active item myCustomItems">
                        <div class="deliveryItem">Delivery Service customers №1</div>
                        <img class="ItemLogo" src="../images/logoBig.png">

                    </div>
                    <div class="item myCustomItems">yes  i know this</div>
                    <div class="item myCustomItems">3</div>
                    <div class="item myCustomItems">4</div>
                    <div class="item myCustomItems">5</div>
                    <div class="item myCustomItems">6</div>
                </div>
                <!-- Carousel nav -->
                <a class="carousel-control left customLeft carouselControlCustom" href=".carousel" data-slide="prev" style="background: transparent">&lsaquo;</a>
                <a class="carousel-control right carouselControlCustom" href=".carousel" data-slide="next" style="background: transparent">&rsaquo;</a>
            </div>
    </div>
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