@extends('admin.layouts.admin-master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    @include('admin.partials.top_widgets')

    <div class="row">

        <div class="col-md-12 col-sm-12 mt-0">
            <div class="x_panel sg-shadow">
                <div class="x_title">
                    <h2>{{ $title }}</h2>
                    <button id="addCategoryBtn" class="btn btn-sm btn-danger pull-right">
                        Add Category
                    </button>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" id="categoryTableDiv">
                    <table id="categoryDataTable" width="100%" style="font-size: 100%; width:100%;" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="font-size: 11px; width:50px;">CATEGORY</th>
                                <th style="font-size: 11px; width:15px; text-align:center;">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody id="categoryTbody">
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{$category->category_name}}</td>
                                    <td>
                                    <a href="#" class="edit_category btn btn-info btn-sm" data-category_id="{{$category->id}}"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="#" class="delete_category btn btn-danger btn-sm" data-category_id="{{$category->id}}"><i class="fa fa-remove"></i>
                                        <div class="spinner spinner-border spinner-border-sm" style="display: none;"></div>
                                        Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

      <!-- Modal - Add Product Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addCategoryForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                        <div class="form-group">
                            <label for="addCategory" class="control-label">Main Category</label>
                            <input type="text" name="addCategory" id="addCategory" class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">
                        <div class="spinner spinner-border spinner-border-sm"></div>
                        Add Category</button>
                </div>
              </div>
            </form>
        </div>
      </div>



        <!-- Modal - Edit Product Modal -->
        <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="editCategoryForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                            <div class="form-group">
                                <label for="editCategory" class="control-label">Main Category</label>
                                <input type="text" name="editCategory" id="editCategory" class="form-control">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">
                            <div class="spinner spinner-border spinner-border-sm"></div>
                            Update Category
                        </button>
                    </div>
                  </div>
                </form>
            </div>
          </div>
@endsection

@section('extra_script')
    <script>
        $(function(){

            function allSubCategories()
            {
                $("#categoryDataTable").DataTable();
            }
            allSubCategories();



            //============== Add Sub Category ====================
            function addCategory(){
                $("#addCategoryBtn").on('click', function(){
                    $("#addCategoryModal").modal('show');
                    $("#addCategoryForm div.spinner").hide();
                    $("#addCategoryForm").submit(function(e){
                        e.preventDefault();
                        var csrfToken = $("input[name=_token]");
                        var category = $("input[id=addCategory]");
                        $.ajax({
                            url: '/admin/category/add',
                            method: 'POST',
                            dataType: 'JSON',
                            data:{
                                '_token' : csrfToken.val(),
                                'category_name': category.val()
                            },
                            beforeSend: function(){
                                $("#addCategoryForm div.spinner").show();
                            },
                            complete: function(){
                                $("#addCategoryForm div.spinner").hide();
                            },
                            success: function(res){
                                console.log(res)
                                if(res.errors){
                                    $("span.error_msg").remove();
                                    $(`<span style="font-size:12px; color:red;" class="error_msg">${res.errors.category_name ? res.errors.category_name : ''}</span>`).insertBefore(category);
                                }

                                if(res.success){
                                    swal(res.success, {icon: "success"});
                                    window.location.reload();
                                }
                            }
                        });
                    });
                });
            }
            addCategory();


            //================ Update Product ==================

            function editCategory(){
                $("#categoryTbody").on('click', '.edit_category', function(e){
                    $("#editCategoryForm div.spinner").hide();
                    e.preventDefault();
                    var category_id = e.currentTarget.dataset.category_id;
                    $.ajax({
                        url: '/admin/category/edit/' + category_id,
                        method:'GET',
                        success: function(res){
                            $(`<input type="hidden" name="category_id" value="${res.category.id}">`)
                            .insertAfter($("input[name=_token]"));
                            $("input[id=editCategory]").val(res.category.category_name);
                        }
                    });
                    $("#editCategoryModal").modal('show');
                });
            }
            editCategory();
            //================ END OF uPDATE pRODUCT


            function updateCategory()
            {
                $("#editSubCategoryForm").submit(function(e){
                    e.preventDefault();
                    var category_id = $("input[name=category_id]").val();
                    var csrfToken = $("input[name=_token]");
                    var category = $("input[id=editCategory]");
                    $.ajax({
                        url: '/admin/category/update/' + category_id,
                        method: 'POST',
                        dataType: 'JSON',
                        data:{
                            '_token': csrfToken.val(),
                            'category_name' : category.val()
                        },
                        beforeSend: function(){
                            $("#editCategoryForm div.spinner").show();
                        },
                        complete: function(){
                            $("#editCategoryForm div.spinner").hide();
                        },
                        success: function(res){
                            if(res.errors){
                                $('span.error_msg').remove();
                                $(`<span class="error_msg" style="font-size:12px;color:red;">${res.errors.category_name ? res.errors.category_name : ''}</span>`).insertBefore(category);
                            }

                            if(res.success){
                                swal(res.success, {icon: "success"});
                                window.location.reload();
                            }
                        }
                    });
                });
            }
            updateCategory();


            // Delete Account
            function deleteCategory()
            {
                $("#categoryTbody").on('click', '.delete_category', function(e){
                    e.preventDefault();
                    var category_id = e.currentTarget.dataset.category_id;
                    swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: `/admin/category/delete/${category_id}`,
                            method: 'get',
                            beforeSend: function(){
                                e.currentTarget.children[0].style.display = 'none';
                                e.currentTarget.children[1].style.display = 'inline-block';
                            },
                            complete: function(){
                                e.currentTarget.children[0].style.display = 'inline-block';
                                e.currentTarget.children[1].style.display = 'none';
                            },
                            success:function(res){
                                if(res.success){
                                   swal(res.success, {icon: "success"})
                                   window.location.reload();
                                }
                            }
                        });
                    } else {
                        swal("Product deleting cancel");
                    }
                    });
                });
            }
            deleteCategory();
        });
    </script>
@endsection
