@include('Admin.layouts.header')
    <!-- page-wrapper start -->
    <div class="page-wrapper default-version">
    @include('Admin.layouts.left_sidebar')
<!-- sidebar end -->
        <!-- navbar-wrapper start -->
    @include('Admin.layouts.navber')
<!-- navbar-wrapper end -->

        <div class="body-wrapper">
            <div class="bodywrapper__inner">

                <div class="row align-items-center mb-30 justify-content-between">
    <div class="col-lg-6 col-sm-6">
        <h6 class="page-title">Dashboard</h6>
    </div>
    <div class="col-lg-6 col-sm-6 text-sm-right mt-sm-0 mt-3">
            </div>
</div>


    {{-- <div class="row mb-none-30">
        <div class="col-xl-4 col-md-6 mb-30">
            <div class="widget bb--3 border--dark b-radius--10 bg--white p-4 box--shadow2 has--link">
                <div class="widget__icon b-radius--rounded bg--dark"><i class="las la-cart-arrow-down"></i></div>
                <div class="widget__content">
                    <p class="text-uppercase text-muted">All Order</p>

                    <h1 class="text--dark font-weight-bold">
                        43
                    </h1>
                    <p class="mt-10 text-right">
                        <a class="btn btn-sm btn--dark" href="/admin/orders">View All                        </a>
                    </p>
                </div>
            </div><!-- widget end -->
        </div>

        <div class="col-xl-4 col-md-6 mb-30">
            <div class="widget bb--3 border--teal b-radius--10 bg--white p-4 box--shadow2 has--link">
                <div class="widget__icon b-radius--rounded bg--teal">
                    <i class="las la-shopping-cart"></i>
                </div>
                <div class="widget__content">
                    <p class="text-uppercase text-muted">Total Sale</p>

                    <h1 class="text--teal font-weight-bold">
                        $7,043.83
                    </h1>
                    <p class="mt-10 text-right">
                        <a class="btn btn-sm bg--teal text-white" href="/admin/payment">View All                        </a>
                    </p>
                </div>
            </div><!-- widget end -->
        </div>

        <div class="col-xl-4 col-md-6 mb-30">
            <div class="widget bb--3 border--light-blue b-radius--10 bg--white p-4 box--shadow2 has--link">
                <div class="widget__icon b-radius--rounded bg--light-blue">
                    <i class="las la-tshirt"></i>
                </div>
                <div class="widget__content">
                    <p class="text-uppercase text-muted">Total Product</p>
                    <h1 class="text--light-blue font-weight-bold">
                        34
                    </h1>
                    <p class="mt-10 text-right">
                        <a class="btn btn-sm bg--light-blue text-white" href="/admin/product/all">View All                        </a>
                    </p>
                </div>
            </div><!-- widget end -->
        </div>

        <div class="col-xl-4 col-md-6 mb-30">
            <div class="widget bb--3 border--cyan b-radius--10 bg--white p-4 box--shadow2 has--link">
                <div class="widget__icon b-radius--rounded bg--cyan">
                    <i class="las la-users"></i>
                </div>

                <div class="widget__content">
                    <p class="text-uppercase text-muted">Total Customer</p>
                    <h1 class="text--cyan font-weight-bold">112</h1>

                    <p class="mt-10 text-right">
                        <a class="btn btn-sm bg--cyan text--white" href="/admin/customers">
                            View All                        </a>
                    </p>
                </div>
            </div><!-- widget-two end -->
        </div>


        <div class="col-xl-4 col-md-6 mb-30">
            <div class="widget bb--3 border--success b-radius--10 bg--white p-4 box--shadow2 has--link">
                <div class="widget__icon b-radius--rounded bg--success">
                    <i class="las la-user-check"></i>
                </div>
                <div class="widget__content">
                    <p class="text-uppercase text-muted">Active Customers</p>
                    <h1 class="text--success font-weight-bold">
                        112
                    </h1>
                    <p class="mt-10 text-right">
                        <a class="btn btn-sm btn--success" href="/admin/customers/active">View All                        </a>
                    </p>
                </div>
            </div><!-- widget end -->
        </div>

        <div class="col-xl-4 col-md-6 mb-30">
            <div class="widget bb--3 border--deep-purple b-radius--10 bg--white p-4 box--shadow2 has--link">
                <div class="widget__icon b-radius--rounded bg--deep-purple">
                    <i class="las la-thumbs-up"></i>
                </div>
                <div class="widget__content">
                    <p class="text-uppercase text-muted">Total Subscriber</p>
                    <h1 class="text--deep-purple font-weight-bold">
                        6
                    </h1>
                    <p class="mt-10 text-right">
                        <a class="btn btn-sm bg--deep-purple text--white" href="/admin/promotion/subscriber">View All                        </a>
                    </p>
                </div>
            </div><!-- widget end -->
        </div>


        <div class="col-xl-4 mb-30">
            <div class="widget-two box--shadow2 b-radius--5 bg--white">
              <i class="icon-7 overlay-icon text text--11"></i>
              <div class="widget-two__icon b-radius--5 bg--11">
                <i class="las la-money-bill"></i>
              </div>
              <div class="widget-two__content">
                <h2>$0.00</h2>
                <p>Sale Amount In Last 7 Days</p>
              </div>
            </div><!-- widget-two end -->
        </div>

        <div class="col-xl-4 mb-30">
            <div class="widget-two box--shadow2 b-radius--5 bg--white">
              <i class="icon-15 overlay-icon text text--dark"></i>
              <div class="widget-two__icon b-radius--5 bg--15">
                <i class="las la-money-bill"></i>
              </div>
              <div class="widget-two__content">
                <h2>$0.00</h2>
                <p>Sale Amount In Last 15 Days</p>
              </div>
            </div><!-- widget-two end -->
        </div>

        <div class="col-xl-4 mb-30">
            <div class="widget-two box--shadow2 b-radius--5 bg--white">
              <i class="icon-30 overlay-icon text text--danger"></i>
              <div class="widget-two__icon b-radius--5 bg--5">
                <i class="las la-money-bill"></i>
              </div>
              <div class="widget-two__content">
                <h2>$555.40</h2>
                <p>Sale Amount In Last 30 Days</p>
              </div>
            </div><!-- widget-two end -->
        </div>

    </div><!-- row end-->

    <div class="row mt-50 mb-none-30">
        <div class="col-xl-6 col-lg-12 mb-30">
            <div class="card min-height-500">
                <div class="card-body">
                    <h5 class="card-title">Monthly Sales Report</h5>
                    <div id="apex-bar-chart"> </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12 mb-30">
            <div class="card min-height-500">
                <div class="card-body">
                    <h5 class="card-title">Top Selling Products</h5>

                        <div class="d-flex flex-wrap single-product mt-30">
                            <a href="/product/details/10/venturini-mens-shoe" data-toggle="tooltip" data-placement="bottom" title="View As Customer" class="col-md-2 text-center"><img src="/assets/images/product/thumb_602bb9d15f0921613478353.jpeg" alt="image"></a>

                            <div class="col-md-10 mt-md-0 mt-3">
                                <a href="/admin/product/edit/10/venturini-mens-shoe" data-toggle="tooltip" data-placement="top" title="Edit" class="text--blue font-weight-bold d-inline-block mb-2">VENTURINI Men&#039;s Shoe</a>
                                <p class="float-right">14 sales</p>
                                <p>Apex footwear brings you an exclusive range of shoes, slippers, sandals and clothing for men, women,...</p>
                                <p class="font-weight-bold">

                                                                            <span class="ml-2">$72.23</span>
                                                                    </p>
                            </div>
                        </div><!-- media end-->

                        <div class="d-flex flex-wrap single-product mt-30">
                            <a href="/product/details/2/slim-trapered-rip-jeans" data-toggle="tooltip" data-placement="bottom" title="View As Customer" class="col-md-2 text-center"><img src="/assets/images/product/thumb_602a6a82776391613392514.jpg" alt="image"></a>

                            <div class="col-md-10 mt-md-0 mt-3">
                                <a href="/admin/product/edit/2/slim-trapered-rip-jeans" data-toggle="tooltip" data-placement="top" title="Edit" class="text--blue font-weight-bold d-inline-block mb-2">Slim Trapered Rip Jeans</a>
                                <p class="float-right">11 sales</p>
                                <p>Washing Instructions	Machine wash warm at 40C. Do not bleach. Tumble dry normal low heat. Iron low h...</p>
                                <p class="font-weight-bold">

                                                                            <span class="ml-2">$30.00</span>
                                                                    </p>
                            </div>
                        </div><!-- media end-->

                        <div class="d-flex flex-wrap single-product mt-30">
                            <a href="/product/details/18/puma-pink-ladies-dresses" data-toggle="tooltip" data-placement="bottom" title="View As Customer" class="col-md-2 text-center"><img src="/assets/images/product/thumb_60252fb1c5e8d1613049777.jpg" alt="image"></a>

                            <div class="col-md-10 mt-md-0 mt-3">
                                <a href="/admin/product/edit/18/puma-pink-ladies-dresses" data-toggle="tooltip" data-placement="top" title="Edit" class="text--blue font-weight-bold d-inline-block mb-2">Puma Pink ladies dresses</a>
                                <p class="float-right">11 sales</p>
                                <p>PUMA was founded in Germany by the Dassler brothers back in 1924, and the brand began to garner atte...</p>
                                <p class="font-weight-bold">

                                                                            <span class="ml-2">$45.30</span>
                                                                    </p>
                            </div>
                        </div><!-- media end-->
                                    </div>
            </div>
        </div>
    </div><!-- row end -->


    <div class="row mb-none-30 mt-5">
        <div class="col-xl-6 col-lg-12 mb-30">
            <div class="card ">
                <div class="card-header">
                    <h6 class="card-title mb-0">Latest Customers</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Order</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                                            <tr>
                                    <td data-label="Customer">
                                        <div class="user">
                                            <div class="thumb">
                                                <a href="/assets/images/avatar.png" class="image-popup">
                                                    <img src="/assets/images/avatar.png" alt="image">
                                                </a>
                                            </div>
                                            <span class="name">mmm mmm</span>
                                        </div>
                                    </td>

                                    <td data-label="Username"><a href="/admin/customer/detail/120">pet1976</a></td>
                                    <td data-label="Email"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="2d4a5f484e485b444e455d48596d544c454242034e4240">[email&#160;protected]</a></td>
                                    <td data-label="Order">1</td>
                                    <td data-label="Action">
                                        <a href="/admin/customer/detail/120" class="icon-btn" data-toggle="tooltip" data-original-title="Details">
                                            <i class="las la-desktop text--shadow"></i>
                                        </a>
                                    </td>
                                </tr>
                                                            <tr>
                                    <td data-label="Customer">
                                        <div class="user">
                                            <div class="thumb">
                                                <a href="/assets/images/avatar.png" class="image-popup">
                                                    <img src="/assets/images/avatar.png" alt="image">
                                                </a>
                                            </div>
                                            <span class="name">elmorshedy company</span>
                                        </div>
                                    </td>

                                    <td data-label="Username"><a href="/admin/customer/detail/119">kamalradwan9</a></td>
                                    <td data-label="Email"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="5f343e323e33002d3e3b283e316e6d6c1f37302b323e3633713c3032">[email&#160;protected]</a></td>
                                    <td data-label="Order">0</td>
                                    <td data-label="Action">
                                        <a href="/admin/customer/detail/119" class="icon-btn" data-toggle="tooltip" data-original-title="Details">
                                            <i class="las la-desktop text--shadow"></i>
                                        </a>
                                    </td>
                                </tr>
                                                            <tr>
                                    <td data-label="Customer">
                                        <div class="user">
                                            <div class="thumb">
                                                <a href="/assets/images/avatar.png" class="image-popup">
                                                    <img src="/assets/images/avatar.png" alt="image">
                                                </a>
                                            </div>
                                            <span class="name">mukesh Kumar</span>
                                        </div>
                                    </td>

                                    <td data-label="Username"><a href="/admin/customer/detail/118">superadmin</a></td>
                                    <td data-label="Email"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="7e130b151b0d16141f15161f0c141f0a3e19131f1712501d1113">[email&#160;protected]</a></td>
                                    <td data-label="Order">0</td>
                                    <td data-label="Action">
                                        <a href="/admin/customer/detail/118" class="icon-btn" data-toggle="tooltip" data-original-title="Details">
                                            <i class="las la-desktop text--shadow"></i>
                                        </a>
                                    </td>
                                </tr>
                                                            <tr>
                                    <td data-label="Customer">
                                        <div class="user">
                                            <div class="thumb">
                                                <a href="/assets/images/avatar.png" class="image-popup">
                                                    <img src="/assets/images/avatar.png" alt="image">
                                                </a>
                                            </div>
                                            <span class="name">Mohammed Hamza</span>
                                        </div>
                                    </td>

                                    <td data-label="Username"><a href="/admin/customer/detail/117">hamza10</a></td>
                                    <td data-label="Email"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="026f6b6a6d663b3231333342686f72636c762c616d6f">[email&#160;protected]</a></td>
                                    <td data-label="Order">0</td>
                                    <td data-label="Action">
                                        <a href="/admin/customer/detail/117" class="icon-btn" data-toggle="tooltip" data-original-title="Details">
                                            <i class="las la-desktop text--shadow"></i>
                                        </a>
                                    </td>
                                </tr>
                                                            <tr>
                                    <td data-label="Customer">
                                        <div class="user">
                                            <div class="thumb">
                                                <a href="/assets/images/avatar.png" class="image-popup">
                                                    <img src="/assets/images/avatar.png" alt="image">
                                                </a>
                                            </div>
                                            <span class="name">Gom Gomer</span>
                                        </div>
                                    </td>

                                    <td data-label="Username"><a href="/admin/customer/detail/116">gogomer</a></td>
                                    <td data-label="Email"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="3f52464c5a4d565e5311585a7f58525e5653115c5052">[email&#160;protected]</a></td>
                                    <td data-label="Order">3</td>
                                    <td data-label="Action">
                                        <a href="/admin/customer/detail/116" class="icon-btn" data-toggle="tooltip" data-original-title="Details">
                                            <i class="las la-desktop text--shadow"></i>
                                        </a>
                                    </td>
                                </tr>
                                                            <tr>
                                    <td data-label="Customer">
                                        <div class="user">
                                            <div class="thumb">
                                                <a href="/assets/images/avatar.png" class="image-popup">
                                                    <img src="/assets/images/avatar.png" alt="image">
                                                </a>
                                            </div>
                                            <span class="name">aer rea</span>
                                        </div>
                                    </td>

                                    <td data-label="Username"><a href="/admin/customer/detail/115">aerrea</a></td>
                                    <td data-label="Email"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="6706021515020627000a060e0b4904080a">[email&#160;protected]</a></td>
                                    <td data-label="Order">1</td>
                                    <td data-label="Action">
                                        <a href="/admin/customer/detail/115" class="icon-btn" data-toggle="tooltip" data-original-title="Details">
                                            <i class="las la-desktop text--shadow"></i>
                                        </a>
                                    </td>
                                </tr>

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div><!-- card end -->
        </div>

        <div class="col-xl-6 mb-30">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Latest Orders</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Order Id</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Shipping Charge</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                                                <tr>
                                    <td data-label="Customer">
                                        <div class="user">
                                            <div class="thumb">
                                                <a href="/assets/images/avatar.png" class="image-popup">
                                                    <img src="/assets/images/avatar.png" alt="image">
                                                </a>
                                            </div>
                                            <span class="name">mmm mmm</span>
                                        </div>
                                    </td>
                                    <td data-label="Order Id">2VT59OT4WCN2</td>
                                    <td data-label="Amount">35</td>
                                    <td data-label="Shipping Charge">2.00</td>
                                    <td>
                                        <a href="/admin/order/details/117" class="icon-btn" data-toggle="tooltip" title="" data-original-title="Details">
                                            <i class="las la-desktop text--shadow"></i>
                                        </a>
                                    </td>
                                </tr>
                                                                <tr>
                                    <td data-label="Customer">
                                        <div class="user">
                                            <div class="thumb">
                                                <a href="/assets/images/avatar.png" class="image-popup">
                                                    <img src="/assets/images/avatar.png" alt="image">
                                                </a>
                                            </div>
                                            <span class="name">Gom Gomer</span>
                                        </div>
                                    </td>
                                    <td data-label="Order Id">DRTB862NTHJ1</td>
                                    <td data-label="Amount">499</td>
                                    <td data-label="Shipping Charge">10.00</td>
                                    <td>
                                        <a href="/admin/order/details/116" class="icon-btn" data-toggle="tooltip" title="" data-original-title="Details">
                                            <i class="las la-desktop text--shadow"></i>
                                        </a>
                                    </td>
                                </tr>
                                                                <tr>
                                    <td data-label="Customer">
                                        <div class="user">
                                            <div class="thumb">
                                                <a href="/assets/images/avatar.png" class="image-popup">
                                                    <img src="/assets/images/avatar.png" alt="image">
                                                </a>
                                            </div>
                                            <span class="name">Gom Gomer</span>
                                        </div>
                                    </td>
                                    <td data-label="Order Id">PZ9OZYCE1MTD</td>
                                    <td data-label="Amount">499</td>
                                    <td data-label="Shipping Charge">10.00</td>
                                    <td>
                                        <a href="/admin/order/details/115" class="icon-btn" data-toggle="tooltip" title="" data-original-title="Details">
                                            <i class="las la-desktop text--shadow"></i>
                                        </a>
                                    </td>
                                </tr>
                                                                <tr>
                                    <td data-label="Customer">
                                        <div class="user">
                                            <div class="thumb">
                                                <a href="/assets/images/avatar.png" class="image-popup">
                                                    <img src="/assets/images/avatar.png" alt="image">
                                                </a>
                                            </div>
                                            <span class="name">Gom Gomer</span>
                                        </div>
                                    </td>
                                    <td data-label="Order Id">TTSBT4RB59KV</td>
                                    <td data-label="Amount">499</td>
                                    <td data-label="Shipping Charge">10.00</td>
                                    <td>
                                        <a href="/admin/order/details/114" class="icon-btn" data-toggle="tooltip" title="" data-original-title="Details">
                                            <i class="las la-desktop text--shadow"></i>
                                        </a>
                                    </td>
                                </tr>
                                                                <tr>
                                    <td data-label="Customer">
                                        <div class="user">
                                            <div class="thumb">
                                                <a href="/assets/images/avatar.png" class="image-popup">
                                                    <img src="/assets/images/avatar.png" alt="image">
                                                </a>
                                            </div>
                                            <span class="name">aer rea</span>
                                        </div>
                                    </td>
                                    <td data-label="Order Id">FO3YAGR4Y2GF</td>
                                    <td data-label="Amount">35</td>
                                    <td data-label="Shipping Charge">10.00</td>
                                    <td>
                                        <a href="/admin/order/details/113" class="icon-btn" data-toggle="tooltip" title="" data-original-title="Details">
                                            <i class="las la-desktop text--shadow"></i>
                                        </a>
                                    </td>
                                </tr>
                                                                <tr>
                                    <td data-label="Customer">
                                        <div class="user">
                                            <div class="thumb">
                                                <a href="/assets/images/avatar.png" class="image-popup">
                                                    <img src="/assets/images/avatar.png" alt="image">
                                                </a>
                                            </div>
                                            <span class="name">shuvo bhowmik</span>
                                        </div>
                                    </td>
                                    <td data-label="Order Id">JSUJJN18VV5Y</td>
                                    <td data-label="Amount">580.3</td>
                                    <td data-label="Shipping Charge">10.00</td>
                                    <td>
                                        <a href="/admin/order/details/112" class="icon-btn" data-toggle="tooltip" title="" data-original-title="Details">
                                            <i class="las la-desktop text--shadow"></i>
                                        </a>
                                    </td>
                                </tr>
                                                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--card end-->


    </div>

    <div class="row mb-none-30 mt-5">
        <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <h5 class="card-title">Login By Browser</h5>
                    <canvas id="userBrowserChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Login By OS</h5>
                    <canvas id="userOsChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Login By Country</h5>
                    <canvas id="userCountryChart"></canvas>
                </div>
            </div>
        </div>
    </div> --}}



            </div><!-- bodywrapper__inner end -->
        </div><!-- body-wrapper end -->
    </div>






@include('Admin.layouts.commonjs')


<script type="text/javascript">
    (function($){
        "use strict";
        bkLib.onDomLoaded(function() {
            $( ".nicEdit" ).each(function( index ) {
                $(this).attr("id","nicEditor"+index);
                new nicEditor({fullPanel : true}).panelInstance('nicEditor'+index,{hasPanel : true});
            });
        });
    })(jQuery);
</script>


    <script src="/assets/admin/js/vendor/apexcharts.min.js"></script>
    <script src="/assets/admin/js/vendor/chart.js.2.8.0.js"></script>
    <script>
        "use strict";
        (function($){
            $('.image-popup').magnificPopup({
                type: 'image'
            });
        })(jQuery)
        // apex-bar-chart js
        var options = {
            series: [{
                name: 'Total Sale',
                data: [518.799999999999954525264911353588104248046875,578.16480000000001382431946694850921630859375,1460,3931.46999999999979991116560995578765869140625,555.3999999999999772626324556767940521240234375,0]            }],
            chart: {
                type: 'bar',
                height: 400,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '50%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ["January","February","March","April","May","June"],
            },
            yaxis: {
                title: {
                    text: "$",
                    style: {
                        color: '#7c97bb'
                    }
                }
            },
            grid: {
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "$" + val + " "
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#apex-bar-chart"), options);
        chart.render();

        var ctx = document.getElementById('userBrowserChart');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Firefox","Chrome","Safari","Handheld Browser"],
                datasets: [{
                    data: [4,63,1,3],
                    backgroundColor: [
                        '#ff7675',
                        '#6c5ce7',
                        '#ffa62b',
                        '#ffeaa7',
                        '#D980FA',
                        '#fccbcb',
                        '#45aaf2',
                        '#05dfd7',
                        '#FF00F6',
                        '#1e90ff',
                        '#2ed573',
                        '#eccc68',
                        '#ff5200',
                        '#cd84f1',
                        '#7efff5',
                        '#7158e2',
                        '#fff200',
                        '#ff9ff3',
                        '#08ffc8',
                        '#3742fa',
                        '#1089ff',
                        '#70FF61',
                        '#bf9fee',
                        '#574b90'
                    ],
                    borderColor: [
                        'rgba(231, 80, 90, 0.75)'
                    ],
                    borderWidth: 0,

                }]
            },
            options: {
                aspectRatio: 1,
                responsive: true,
                maintainAspectRatio: true,
                elements: {
                    line: {
                        tension: 0 // disables bezier curves
                    }
                },
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }]
                },
                legend: {
                    display: false,
                }
            }
        });

        var ctx = document.getElementById('userOsChart');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Windows 10","Mac OS X","Linux","Windows 7","Android"],
                datasets: [{
                    data: [59,6,2,1,3],
                    backgroundColor: [
                        '#ff7675',
                        '#6c5ce7',
                        '#ffa62b',
                        '#ffeaa7',
                        '#D980FA',
                        '#fccbcb',
                        '#45aaf2',
                        '#05dfd7',
                        '#FF00F6',
                        '#1e90ff',
                        '#2ed573',
                        '#eccc68',
                        '#ff5200',
                        '#cd84f1',
                        '#7efff5',
                        '#7158e2',
                        '#fff200',
                        '#ff9ff3',
                        '#08ffc8',
                        '#3742fa',
                        '#1089ff',
                        '#70FF61',
                        '#bf9fee',
                        '#574b90'
                    ],
                    borderColor: [
                        'rgba(0, 0, 0, 0.05)'
                    ],
                    borderWidth: 0,

                }]
            },
            options: {
                aspectRatio: 1,
                responsive: true,
                elements: {
                    line: {
                        tension: 0 // disables bezier curves
                    }
                },
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }]
                },
                legend: {
                    display: false,
                }
            },
        });


        // Donut chart
        var ctx = document.getElementById('userCountryChart');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["India","Bangladesh","Georgia","Thailand","United States"],
                datasets: [{
                    data: [19,16,6,5,5],
                    backgroundColor: [
                        '#ff7675',
                        '#6c5ce7',
                        '#ffa62b',
                        '#ffeaa7',
                        '#D980FA',
                        '#fccbcb',
                        '#45aaf2',
                        '#05dfd7',
                        '#FF00F6',
                        '#1e90ff',
                        '#2ed573',
                        '#eccc68',
                        '#ff5200',
                        '#cd84f1',
                        '#7efff5',
                        '#7158e2',
                        '#fff200',
                        '#ff9ff3',
                        '#08ffc8',
                        '#3742fa',
                        '#1089ff',
                        '#70FF61',
                        '#bf9fee',
                        '#574b90'
                    ],
                    borderColor: [
                        'rgba(231, 80, 90, 0.75)'
                    ],
                    borderWidth: 0,

                }]
            },
            options: {
                aspectRatio: 1,
                responsive: true,
                elements: {
                    line: {
                        tension: 0 // disables bezier curves
                    }
                },
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }]
                },
                legend: {
                    display: false,
                }
            }
        });

    </script>


</body>
</html>
