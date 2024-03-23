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
          <h6 class="page-title">Table Page</h6>
        </div>
        <div class="col-lg-6 col-sm-6 text-sm-right mt-sm-0 mt-3">
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="card b-radius--10 ">
            <div class="card-body">
              <form>
                <div class="table-responsive">
                  <table class="table table--light style--two" width="100%">
                    <thead>
                      <tr>
                        <th>表示しない</th>
                        <th>表示しない</th>
                        <th>表示しない</th>
                        <th>表示しない</th>
                        <th>表示しない</th>
                      </tr>
                    </thead>
                    <tbody class="list">
                      <tr class="table-search-form">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                          <input type="text" name="" class="form-control table-input" value="">
                        </td>
                        <td>
                          <div class="custom-control custom-checkbox form-check-primary">
                            <input type="checkbox" name="top_category" value="1" class="custom-control-input" id="top_category">
                            <label class="custom-control-label" for="top_category"></label>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div><!-- body-wrapper end -->
  </div>


  @include('Admin.layouts.commonjs')

</body>
</html>
