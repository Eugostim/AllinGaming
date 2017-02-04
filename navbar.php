<!--old nav-->

<!--<nav class="container-fluid nav-underline">-->
<!--    <a href="#"><div class="container-fluid nav-item-active col-md-offset-1 col-md-1"><h3>Home</h3></div></a>-->
<!--    <a href="#"><div class="container-fluid nav-item-unactive col-md-1"><h3>News</h3></div></a>-->
<!--    <a href="#"><div class="container-fluid nav-item-unactive col-md-1"><h3>Media</h3></div></a>-->
<!---->
<!--    <div class="container-fluid col-md-offset-9">-->
<!--        <img src="assets/site/logotemp.png">-->
<!--    </div>-->
<!--</nav>-->


<nav class="navbar navbar-default">
    <div class="container-fluid " style="background-color: #fff">
        <!-- Logotipo -->
        <div class="navbar-header" style="height: 70px">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="assets/site/logotemp.png"></a>
        </div>

        <!--links-->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <!-- Links da direita -->
            <ul class="nav navbar-nav">
                <li class="active"><a href="feed.php"><h3>Home</h3><span class="sr-only">(current)</span></a></li>
                <li><a href="news.php"><h3>News</h3></a></li>
                <li><a href="media.php"><h3>Media</h3></a></li>
                <li><a href="profile.php"><h3>Profile</h3></a></li>
            </ul>

            <!-- Links da esquerda-->
            <ul class="nav navbar-nav navbar-right">
<!--                <li><a href="search.php"><h3>Search</h3></a></li>-->
<!--                <li style="margin-right: 30rem; margin-top: 2rem">-->
<!--                    <input type="text" class="form-control" style="margin-right: 20rem" placeholder="Search something">-->
<!--                        <span class="glyphicon glyphicon-search"></span>-->
<!--                </li>-->
                <form class="navbar-form navbar-left"  role="search" action="search.php?" method="get">
                    <div class="form-group" style="margin-right: 1rem; margin-top: 1rem">
                        <div class="input-group">

                            <input type="text" class="form-control" placeholder="Search something" name="search_queue" id="search_queue" >
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-search"></span>
                            </div>
                            <input type="hidden" hidden="hidden" name="search_type" id="search_type" value="1">
                        </div>
                    </div>
                </form>
            </ul>

        </div>
    </div>
</nav>