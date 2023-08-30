<?php include 'header.php'; 
include 'nav.php'; 
include '../../../conn.php'; 
?>
<style>
.btn-primary {
    color: #fff;
    background-color: #00487a !important;
    border-color: #00487a !important;
}

.selected-image-container {
    text-align: center;
}

#selected-image {
    max-width: 100%;
    max-height: 200px;
    border-radius: 50px;
}

.logo-thumbnail {
    max-width: 100px;
    max-height: 100px;
    border-radius: 50px;
}
</style>


<div class="main-content">
    <div class="page-content">

        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Halls Details</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Tab panes -->
                            <div class="tab-content p-3">
                                <div class="tab-pane active" id="all-order" role="tabpanel">
                                    <form>
                                        <div class="row">
                                            <div class="col-xl col-sm-6">
                                            </div>
                                            <div class="col-xl col-sm-6">
                                            </div>
                                            <div class="col-xl col-sm-6">
                                            </div>
                                            <div class="col-xl col-sm-6">
                                            </div>
                                            <div class="col-xl col-sm-6">
                                            </div>
                                            <div class="col-xl col-sm-6 align-self-end">
                                                <div class="mb-3">
                                                    <button type="button" id="openModal"
                                                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                                        data-bs-toggle="modal" data-bs-target=".hallModal"><i
                                                            class="mdi mdi-plus me-1"></i> Add New Hall</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="table-responsive mt-2">
                                        <table class="table table-hover datatable dt-responsive nowrap" id="tblHall"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Hall Name</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Location</th>
                                                    <th scope="col">Caapcity</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Photo</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                // Select query
                $sql = "SELECT * FROM halls WHERE 1";
                $result = mysqli_query($conn, $sql);

                // Check if the query was successful
                if ($result) {
                    // Check if there are any rows returned
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $hall_id = $row['hall_id'];
                            $type = $row['hall_type'];
                            $price = $row['hallPrice'];
                            $location = $row['location'];
                            $capacity = $row['capacity'];
                            $desc = $row['hall_desc'];
                            $date = $row['date'];
                            $photo = $row['hall_photo'];

                            // Display the data
                            echo "<tr>";
                            echo "<td>$hall_id</td>";
                            echo "<td>$type</td>";
                            echo "<td>$price</td>";
                            echo "<td>$location</td>";
                            echo "<td>$capacity</td>";
                            echo "<td>$desc</td>";
                            echo "<td>$date</td>";
                            
                            echo "<td><img src='../../../images/$photo' alt='Halls Logo' class='logo-thumbnail'></td>";
                            echo "<td>
                            
                            <li class='list-inline-item'>
                            <a href='#' class='text-success p-2 edit-btn' data-bs-toggle='modal' data-bs-target='.hallModal' data-id='$hall_id'><i class='bx bxs-edit-alt'></i></a>
                            </li>
                            <li class='list-inline-item'>
                            <a href='#' class='text-danger p-2 delete-btn' data-item-id='$hall_id'><i class='bx bxs-trash'></i></a>
                        </li></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No Halls found</td></tr>";
                    }
                } else {
                    echo "Error: " . mysqli_error($conn);
                }

                mysqli_close($conn);
            ?>


                                            </tbody>
                                        </table>
                                    </div>
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <!-- Modal -->
            <div class="modal fade hallModal" id="hallModal" tabindex="-1" role="dialog"
                aria-labelledby="hallModalLabel" aria-fffden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="hallModalarielabel">Halls</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                onclick="closeModal();"></button>
                        </div>
                        <div class="modal-body">

                            <form method="Post" id="hall_form" action="../../../apis/halls.php">
                                <div class="alert alert-danger" id="error"> </div>
                                <div class="alert alert-success" id="success"></div>
                                <input type="hidden" name="hall_id" id="hall_id">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="htype" class="form-label ">hall
                                                Type <span class='text-danger'>*</span></label>
                                            <input type="text" class="form-control" id="htype" name="htype"
                                                placeholder="Enter Hall address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="formrow-email-input" class="form-label">Hall location</label>
                                            <input type="text" class="form-control" id="hlocation" name="hlocation"
                                                placeholder="Enter Hall Location">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="formrow-email-input" class="form-label">Hall Capacity</label>
                                            <input type="text" class="form-control" id="hcapacity" name="hcapacity"
                                                placeholder="Hall Capacity....">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="formrow-email-input" class="form-label">Hall Price</label>
                                            <input type="text" class="form-control" id="hprice" name="hprice"
                                                placeholder="Hall Capacity....">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="formrow-email-input" class="form-label">Hall Description</label>
                                            <input type="text" class="form-control" id="hdesc" name="hdesc"
                                                placeholder="Hall Description....">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3">
                                        <label for="formrow-address-input" class="form-label">Hall Photo</label>
                                        <input type="file" class="form-control" id="hphoto" name="hphoto"
                                            placeholder="Enter Company Logo">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="modal-body">
                                        <div class="selected-image-container" id="img-selected">
                                            <img id=" selected-image" src="" alt="Perview Hall Photo">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="btnSubmit" class="btn btn-primary"
                                        data-bs-dismiss="modal">Save Changes</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                        onclick="closeModal();">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal -->
        </div><!-- container-fluid -->
    </div>
    <?php include 'footer.php'; ?>
    <!-- <script src="../../../js/halls.js"></script> -->

    <style>
    /* Custom styles for the table */
    .dataTables_wrapper {
        padding: 20px;
    }

    .dataTables_filter {
        float: right;
    }

    .dataTables_paginate {
        float: right;
    }
    </style>
    <!-- Include jQuery, Bootstrap, and DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

    <!-- Add this to your HTML file -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <script>
    $(document).ready(function() {

        $('#tblHall ').DataTable();
        $('.dataTables_length').addClass('bs-select');

        $('.delete-btn').click(function(e) {
            e.preventDefault();
            var itemId = $(this).data('item-id');
            deleteItem(itemId);
        });

        $("#error").css("display", "none");
        $("#success").css("display", "none");

    })

    $(document).ready(function() {
        $('.delete-btn').click(function(e) {
            e.preventDefault();
            var itemId = $(this).data('item-id');
            deleteItem(itemId);
        });



    })
    // $("#hall_form").submit(function(e) {
    //     e.preventDefault();
    //     $.ajax({
    //         url: "../../../apis/halls.php",
    //         data: new FormData($(this)[0]),
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         method: 'POST',
    //         type: 'POST',
    //         success: function(resp) {
    //             alert(resp)
    //             var res = jQuery.parseJSON(resp);
    //             if (res.status == 200) {
    //                 window.location.href = 'hall.php';
    //                 //    $("#success").css("display", "block");
    //                 //     $("#success").text(res.message);
    //             } else if (res.status == 404) {
    //                 //   $("#success").css("display", "none");
    //                 //    $("#error").css("display", "block");
    //                 //    $("#error").text(res.message);
    //             }

    //         }
    //     });


    // });

    $("#hall_form").submit(function(e) {
        e.preventDefault();
        if (!validateForm()) {
            showValidationErrorAlert();

        } else {
            $.ajax({
                url: "../../../apis/halls.php",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success: function(resp) {
                    var res = jQuery.parseJSON(resp);
                    if (res.status == 200) {
                        // Show success alert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: res.message,
                            timer: 2000, // Show success message for 2 seconds
                            timerProgressBar: true,
                            showConfirmButton: false
                        });
                        // Redirect after success
                        setTimeout(function() {
                            window.location.href = 'hall.php';
                        }, 2000);
                    } else if (res.status == 404) {
                        // Show error alert
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: res.message,
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred during submission.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });

    function validateForm() {
        const htype = $("#htype").val();
        const hlocation = $("#hlocation").val();
        const hcapacity = $("#hcapacity").val();
        const hprice = $("#hprice").val();
        const hdesc = $("#hdesc").val();
        const image = $("#hphoto").val();

        return htype && hlocation && hcapacity && hprice && hdesc && image;
    }

    function showValidationErrorAlert() {
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: 'All fields are required. Please fill out all the required fields.',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
        // return;
    }

    $(document).ready(function() {
        // When a file is selected, display the image
        $('#hphoto').change(function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#selected-image').attr('src', e.target.result);
                $("#img-selected").html(`
                        <img id=" selected-image" class="rounded-lg" src="${e.target.result}" alt="Perview Hall Photo" width="400" height="200">
                    `)
            }

            reader.readAsDataURL(file);
        });
    });

    function closeModal() {
        $("#img-selected").html(`
            <img id=" selected-image" class="rounded-lg" src="" alt="Perview Hall Photo" width="400" height="200">
        `)
        $("#hallModal").modal("show")

        $("#htype").val('')
        $("#hlocation").val('')
        $("#hcapacity").val('')
        $("#hprice").val('')
        $("#hdesc").val('')

    }

    $(document).ready(function() {
        $('.edit-btn').click(function() {
            var hallid = parseInt($(this).data('id'), 10);
            $.ajax({
                url: '../../../apis/halls/gethalls.php',
                type: 'POST',
                data: {
                    hallid: hallid
                },
                success: function(response) {
                    var hallData = JSON.parse(response);

                    // Set the values in the form
                    $('#htype').val(hallData.htype);
                    $('#hall_id').val(hallData.hid);
                    $('#hprice').val(hallData.hprice);
                    $('#hlocation').val(hallData.hlocation);
                    $('#hdesc').val(hallData.hdesc);
                    $('#hcapacity').val(hallData.hcapacity);

                    // Display the selected image filename
                    var filename = "../../" + hallData.hphoto.split('/').pop();
                    $('#hphoto').siblings('.file-label').text(filename);

                    // Set the image source
                    console.log(hallData)
                    $("#img-selected").html(`
                        <img id=" selected-image" class="rounded-lg" src="../../${hallData.hphoto}" alt="Perview Hall Photo" width="400" height="200">
                    `)
                    // $('#selected-image').attr('src', `../../${hallData.hphoto}`);
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while fetching data.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });



    function convertRelativePathToAbsolute(relativePath) {
        // Get the current URL
        var currentURL = window.location.href;

        // Extract the base URL from the current URL
        var baseURL = currentURL.substr(0, currentURL.lastIndexOf('/') + 1);

        // Combine the base URL and the relative path
        var absolutePath = baseURL + relativePath;

        return absolutePath;
    }

    // Usage example







    // function deleteItem(itemId) {
    //     $.ajax({
    //         url: '../../../apis/halls/delete.php',
    //         method: 'POST',
    //         data: { itemId: itemId },
    //         success: function(response) {
    //             window.location.href = 'hall.php';
    //             console.log(response);
    //             // Reload the page or update the UI as needed
    //         },
    //         error: function(xhr, status, error) {
    //             // Handle errors
    //             console.error(error);
    //         }
    //     });
    // }

    function deleteItem(itemId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, proceed with deletion
                $.ajax({
                    url: '../../../apis/halls/delete.php',
                    method: 'POST',
                    data: {
                        itemId: itemId
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'The item has been deleted.',
                            icon: 'success',
                            timer: 2000, // Show success message for 2 seconds
                            timerProgressBar: true,
                            showConfirmButton: false
                        });

                        // Redirect after deletion
                        setTimeout(function() {
                            window.location.href = 'hall.php';
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error(error);
                    }
                });
            }
        });
    }
    </script>