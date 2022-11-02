    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        <!-- Top Header Area -->
        <div class="top-header-area">
            <div class="container-fluid h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12 col-sm-4">
                        <!-- Logo Area -->
                        <div class="logo-area">
                            <a href="./"><img src="images/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-8">
                        <!-- Top Add Area -->
                        <div class="top-add-area text-right">
                            <a href="#"><img src="imgs/FINALCOPY.gif" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navbar Area -->
        <div class="videomag-main-menu" id="sticker">
            <div class="classy-nav-container breakpoint-off">
                <div class="container-fluid">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="videomagNav">

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="./">Home</a></li>
                                    <?php
                                        $navSelctQuery = mysqli_query($conn, "select * from navigation where parent = '0'");
                                        $rowCount=mysqli_num_rows($navSelctQuery);
                                        if($rowCount>=1)
                                        {
                                            while($navrow=mysqli_fetch_array($navSelctQuery))
                                            {
                                            $kids=checkKids($navrow['id']);
                                            if($kids == 1)
                                            {
                                    ?>
                                                <li>
                                                <a href="<?=getPageUrl($navrow['pageurl'])?>.html">
                                                <span><?=$navrow['linktext']?></span>
                                                </a>
                                                <ul class="dropdown">
                                    <?php
                                                    getKids($navrow['id']);
                                    ?>
                                                </ul>
                                                </li>
                                    <?php
                                            }
                                            else
                                            {
                                    ?>
                                            <li>
                                                <a  href="<?=getPageUrl($navrow['pageurl'])?>.html"><?=$navrow['linktext']?></a>
                                            </li>
                                    <?php
                                            }
                                            }
                                        }
                                    ?>
                                    <li>
                                </ul>
                            </div>
                            <!-- Nav End -->
                        </div>

                        <!-- Top Search Area -->
                        <div class="top-search-area">
                            <!-- <form action="#" method="post">
                                <input type="search" name="top-search" id="topSearch" placeholder="Search">
                                <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </form> -->
                            <a href="#search" class="searchicon" ><i class="fa fa-search" aria-hidden="true"></i></a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>