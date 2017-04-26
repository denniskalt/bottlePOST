<div class="container-fluid wrapper">
    <div class="row">
        <div class="col-lg-12">

        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 widget widget-weather">
            <div class="inner">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div id="card" class="weather">
                                <div class="city-selected">
                                    <article>
                                        <div class="info">
                                            <div class="city"><?php echo $this->_['user'][0]->name; ?></div>
                                            <div class="night"><?php echo $this->_['tageszeit']; ?> - <?php echo $this->_['datacalc']; ?></div>
                                            <div class="temp"><?php echo $this->_['temperature']; ?> <span class="temp">°C</span></div>
                                            <div class="wind">
                                                <svg version="1.1" id="wind" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                     viewBox="0 0 300.492 300.492" style="enable-background:new 0 0 300.492 300.492;" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <path style="fill:#FFFFFF;" d="M287.166,100.421c-9.502-13.217-24.046-23.034-39.868-26.945
                                                                c-5.309-1.365-10.845-2.061-16.453-2.061c-11.531,0-22.257,3.035-30.981,8.746c-14.076,8.86-23.709,23.91-25.759,40.157
                                                                c-2.698,16.644,4.357,34.315,17.519,43.959c7.555,5.716,17.47,8.991,27.201,8.991c7.332,0,14.109-1.811,19.575-5.216
                                                                c14.936-8.991,21.495-28.577,14.626-43.665c-3.525-7.669-10.427-13.647-18.455-15.975c-2.361-0.696-4.754-1.082-7.131-1.164
                                                                l-0.288,5.434c1.974,0.141,3.916,0.544,5.782,1.202c6.288,2.143,11.536,7.093,14.044,13.288c1.256,2.975,1.893,6.211,1.822,9.355
                                                                c-0.071,3.421-0.658,6.565-1.855,9.861c-2.366,6.222-6.967,11.667-12.678,14.968c-10.269,6.233-26.624,4.329-37.171-4.172
                                                                c-10.405-8.278-15.529-21.87-13.364-35.528c1.8-13.413,9.85-25.71,21.56-32.912c5.553-3.514,12.069-5.803,18.868-6.636
                                                                c2.823-0.359,6.619-0.413,10.285-0.131c3.497,0.31,7.033,0.903,10.231,1.713c13.358,3.437,25.623,11.863,33.668,23.154
                                                                c8.365,11.324,12.325,24.96,11.438,39.477c-0.587,14.098-5.423,28.305-13.619,40.021c-8.159,11.759-19.907,21.354-33.108,27.027
                                                                c-6.059,2.654-13.07,4.574-20.832,5.695c-4.803,0.68-9.959,0.8-16.203,0.892l-176.09,2.339l-29.817,1.164l0.109,5.439
                                                                l199.015,0.131c2.295,0,4.596,0,6.88,0.022l4.253,0.027c3.835,0,8.376-0.071,12.988-0.593c8.36-1.033,16.263-3.111,23.464-6.168
                                                                c14.925-6.206,28.283-16.905,37.606-30.127c9.426-13.206,15.072-29.36,15.893-45.438
                                                                C301.476,130.293,296.679,113.399,287.166,100.421z"/>
                                                        </g>
                                                        <g>
                                                            <path style="fill:#FFFFFF;" d="M106.617,209.839c0.664-0.027,1.463-0.038,2.23-0.038l5.445,0.065
                                                                c1.528,0.027,2.959,0.049,4.395,0.049c2.801,0,6.511-0.076,10.438-0.647c7.626-1.246,14.849-4.471,20.864-9.312
                                                                c12.374-9.752,18.874-25.999,16.562-41.391c-2.371-15.648-15.953-28.697-31.547-30.35c-8.539-1.05-16.421,0.979-22.404,5.619
                                                                c-6.451,4.824-10.688,12.091-11.612,19.842c-1.229,8.077,1.806,16.589,7.664,21.637c5.803,5.287,15.431,7.43,22.387,5.037
                                                                c5.102-1.702,9.42-5.798,11.563-10.971l-4.928-2.284c-1.817,3.519-5.096,6.124-8.762,6.957c-1.218,0.277-2.317,0.408-3.367,0.408
                                                                c-4.329,0-8.762-1.866-11.591-4.89c-3.835-4.003-5.249-9.11-4.096-14.762c1.044-5.08,4.308-10.106,8.496-13.124
                                                                c4.449-3.176,9.284-4.286,15.349-3.405c11.123,1.441,20.603,10.943,22.077,22.229c1.996,11.335-2.877,24.013-12.173,31.585
                                                                c-4.585,3.867-10.193,6.494-16.236,7.604c-2.469,0.479-4.922,0.571-7.647,0.642l-104.506,2.752
                                                                C10.264,203.524,5.134,203.9,0,204.275l0.19,5.434L106.617,209.839z"/>
                                                        </g>
                                                    </g>
                                                </g>
                                                <span><?php echo $this->_['wind']; ?> km/h</span>
                                            </div>
                                        </div>
                                        <div class="icon">
                                            <i class="wi <?php echo $this->_['weather']; ?>"></i>
                                        </div>
                                    </article>
                                    <figure style="background-image: url(images/country/de.jpg);"></figure>
                                    <!--<div class="day">
                                        <p class="date">24.04.2017</p>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 widget widget-post">
            <div class="inner">
             <div class="card-container manual-flip">
                <div class="card">
                    <div class="front">
                        <div class="cover">
                            <img src="images/bg/way.jpg" />
                        </div>
                        <div class="user">
                            <img class="img-circle" src="images/user/default-0.jpg"/>
                        </div>
                        <div class="content">
                            <div class="main">
                                <form>
                                    <textarea class="form-control" rows="3" id="posting" name="posting" maxlength="160"></textarea>
                                    <span id="count_message" class="characters-remaining">160 Zeichen verbleibend</span>
                                    <button class="btn btn-info btn-post" type="submit">Status posten</button>
                                </form>
                                <div class="clear"></div>

                            </div>
                            <!--<div class="footer">
                                <a class="btn btn-simple" href="profile.php">
                                    <i class="fa fa-mail-forward"></i> Zum Profil
                                </a>
                            </div>-->
                        </div>
                        </div> <!-- end front panel -->
                    </div> <!-- end card -->
                </div> <!-- end card-container -->
            </div> <!-- end col sm 3 -->
        </div>
        <div class="col-lg-4 widget widget-stats">
            <div class="inner">
             <div class="card-container manual-flip">
                <div class="card">
                    <div class="front">
                        <div class="content">
                            <div class="main">
                                <h3 class="name">Max Mustermann</h3>
                                <p class="profession">@tester</p>
                                <div class="stats-container">
                                    <div class="stats">
                                        <h4>235</h4>
                                        <p>
                                            folgen Dir
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>114</h4>
                                        <p>
                                            folgst Du
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>35</h4>
                                        <p>
                                            Muschelpoints
                                        </p>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <!--<p class="text-center">"Hier werden später Erinnerungen angezeigt."</p>-->
                            </div>
                            <div class="footer">
                                <a class="btn btn-simple" href="profile.php">
                                    <i class="fa fa-mail-forward"></i> Zum Profil
                                </a>
                            </div>
                        </div>
                        </div> <!-- end front panel -->
                    </div> <!-- end card -->
                </div> <!-- end card-container -->
            </div> <!-- end col sm 3 -->
        </div>
    </div>
    <div class="row">
    <div class="col-lg-5 widget col-lg-offset-3">
        <div class="inner">
            <div class="[ panel panel-default ] panel-google-plus">
                <!--<div class="dropdown">
                    <span class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <span class="[ glyphicon glyphicon-chevron-down ]"></span>
                    </span>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                    </ul>
                </div>-->
                <div class="panel-google-plus-tags">
                    <ul>
                        <li><a href="">~Millennials</a></li>
                        <li><a href="">~Generation</a></li>
                        <li><a href="">~Test</a></li>
                    </ul>
                </div>
                <div class="panel-heading">
                    <img class="circle pull-left" src="images/user/default-2.jpg" alt="" />
                    <h3><a href="">Lukas Bosse</a></h3>
                    <h5><span>vor 2 Stunden</span> </h5>
                </div>
                <div class="panel-body">
                    <p>Lorem Ipsum Dolor Sit amet.</p>
                </div>
                <div class="panel-footer">
                    <button type="button" class="[ btn btn-default ]">+1</button>
                    <button type="button" class="[ btn btn-default ]">-1</button>
                    <!--<button type="button" class="[ btn btn-default ]">
                        <span class="[ glyphicon glyphicon-share-alt ]"></span>
                    </button>-->
                    <div class="input-placeholder">Kommentiere...</div>
                </div>
                <div class="panel-google-plus-comment">
                    <img class="img-circle" src="images/user/default-0.jpg" alt="" />
                    <div class="panel-google-plus-textarea">
                        <textarea rows="4" class="form-control"></textarea>
                        <button type="submit" class="[ btn btn-info disabled ]">Kommentar abschicken</button>
                        <button type="reset" class="[ btn btn-default ]">Schließen</button>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        </div>
            <div class="col-lg-5 widget col-lg-offset-3">
        <div class="inner">
            <div class="[ panel panel-default ] panel-google-plus">
                <div class="panel-google-plus-tags">
                    <ul>
                        <li><a href="">~Millennials</a></li>
                        <li><a href="">~Generation</a></li>
                        <li><a href="">~Test</a></li>
                    </ul>
                </div>
                <div class="panel-heading">
                    <img class="circle pull-left" src="images/user/default-2.jpg" alt="" />
                    <h3><a href="">Lukas Bosse</a></h3>
                    <h5><span>vor 2 Stunden</span> </h5>
                </div>
                <div class="panel-body">
                    <p>Lorem Ipsum Dolor Sit amet.</p>
                </div>
                <div class="panel-footer">
                    <button type="button" class="[ btn btn-default ]">+1</button>
                    <button type="button" class="[ btn btn-default ]">-1</button>
                    <div class="input-placeholder">Kommentiere...</div>
                </div>
                <div class="panel-google-plus-comment">
                    <img class="img-circle" src="images/user/default-0.jpg" alt="" />
                    <div class="panel-google-plus-textarea">
                        <textarea rows="4" class="form-control"></textarea>
                        <button type="submit" class="[ btn btn-info disabled ]">Kommentar abschicken</button>
                        <button type="reset" class="[ btn btn-default ]">Schließen</button>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<div class="clear"></div>













