<!-- jQuery library -->
<script data-cfasync="false" src="{{ asset('assets/admin/js/email-decode.min.js') }}"></script><script src="{{ asset('assets/admin/js/vendor/jquery-3.5.1.min.js') }}"></script>
<!-- bootstrap js -->
<script src="{{ asset('assets/admin/js/vendor/bootstrap.bundle.min.js') }}"></script>

<!-- slimscroll js for custom scrollbar -->
<script src="{{ asset('assets/admin/js/vendor/jquery.slimscroll.min.js') }}"></script>
<!-- custom select box js -->
<script src="{{ asset('assets/admin/js/vendor/jquery.nice-select.min.js') }}"></script>


<!-- iziToast -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/iziToast.min.css') }}">
    <script src="{{ asset('assets/admin/js/iziToast.min.js') }}"></script>


        <script>
        "use strict";
        function notify(status, message) {
            if(typeof message == 'string'){
                iziToast[status]({
                    message: message,
                    position: "topRight"
                });
            }else{
                $.each(message, function(i, val) {
                    iziToast[status]({
                        message: val,
                        position: "topRight"
                    });
                });
            }

        }

        function notifyOne(status, message) {
             iziToast[status]({
                 message: message,
                 position: "topRight"
             });
        }

        var numericFields = document.getElementsByClassName("form-number");

        var numberize = function() {
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
        };

        for (var i = 0; i < numericFields.length; i++) {
            numericFields[i].addEventListener('input', numberize);
        }

        function refresh()
        {
            var elems = document.getElementsByClassName('table-input');
            for(var i = 0; i < elems.length; i++)
            {
                elems[i].value = '';
            }
            document.getElementById('sort_column').value = '';
            document.getElementById('sort_dir').value = '';
            document.getElementById('tableForm').submit();
        }

        function sort(column, dir)
        {
            document.getElementById('sort_column').value = column;
            document.getElementById('sort_dir').value = dir;
            document.getElementById('tableForm').submit();
        }

        var commaFields = document.getElementsByClassName("commafy");
        for (var i = 0; i < commaFields.length; i++) 
        {
            commaFields[i].innerText = numberWithCommas(commaFields[i].innerText)
        }
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    </script>

<script src="{{ asset('assets/admin/js/nicEdit.js') }}"></script>

<!-- code preview js -->
<!-- seldct 2 js -->
<script src="{{ asset('assets/admin/js/vendor/select2.min.js') }}"></script>
<!-- data-table js -->
<script src="{{ asset('assets/admin/js/vendor/datatables.min.js') }}"></script>
<!-- Magnigfic js -->
<script src="{{ asset('assets/admin/js/jquery.magnific-popup.min.js') }}"></script>
<!-- main js -->
<script src="{{ asset('assets/admin/js/app.js') }}"></script>

<script src="{{ asset('assets/admin/js/image-uploader.min.js') }}"></script>
<script src="{{ asset('assets/admin/ckeditor/ckeditor.js') }}"></script>
